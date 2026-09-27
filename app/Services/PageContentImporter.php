<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;
use DOMDocument;
use DOMXPath;

class PageContentImporter
{
    public function importAll(bool $overwrite = false): int
    {
        $extractors = config('page_section_extractors', []);
        $sectionsConfig = config('page_sections.sections', []);
        $imported = 0;

        foreach ($sectionsConfig as $pageSlug => $sections) {
            $page = Page::query()->where('slug', $pageSlug)->first();

            if ($page === null) {
                continue;
            }

            $bladePath = resource_path("views/pages/{$pageSlug}.blade.php");

            foreach ($sections as $key => $schema) {
                $section = PageSection::query()
                    ->where('page_id', $page->id)
                    ->where('key', $key)
                    ->first();

                if ($section === null) {
                    continue;
                }

                $hasContent = $this->hasStoredContent($section->content);
                $needsReset = $this->needsStructureReset($section->content ?? [], $schema);

                if ($hasContent && ! $overwrite && ! $needsReset) {
                    continue;
                }

                $defaults = $schema['defaults'] ?? [];
                $extracted = $this->extractSection($pageSlug, $key, $bladePath, $schema);

                if ($extracted === null && $defaults === []) {
                    continue;
                }

                $content = array_replace_recursive($defaults, $extracted ?? []);

                if ($content === []) {
                    continue;
                }

                $section->update(['content' => $content]);
                $imported++;
            }

            app(PageContentService::class)->refresh($pageSlug);
        }

        return $imported;
    }

    public function extractSection(string $pageSlug, string $sectionKey, string $bladePath, array $schema): ?array
    {
        if ($sectionKey === 'team' && $pageSlug === 'team') {
            return $this->extractTeamSection();
        }

        if ($pageSlug === 'our-partnership') {
            $fromFile = (require config_path('page_defaults/our_partnership.php'))[$sectionKey] ?? null;

            if ($fromFile !== null) {
                return $fromFile;
            }
        }

        if (! is_file($bladePath)) {
            return null;
        }

        $extractors = config("page_section_extractors.{$pageSlug}.{$sectionKey}");

        if ($extractors === null) {
            return null;
        }

        if (($extractors['type'] ?? '') === 'faq') {
            return $this->extractFaqFromBlade($bladePath, $extractors['section']);
        }

        $html = $this->extractSectionHtml($bladePath, $extractors['section']);

        if ($html === '') {
            return null;
        }

        $targetHtml = $html;

        if (! empty($extractors['content_selector'])) {
            $targetHtml = $this->extractByClass($html, ltrim($extractors['content_selector'], '.')) ?: $html;
        }

        return $this->parseContentBlock($targetHtml, $schema['fields'] ?? []);
    }

    private function extractTeamSection(): array
    {
        $members = [];

        foreach (config('team.members', []) as $member) {
            $members[] = [
                'name' => $member['name'] ?? '',
                'title' => $member['title'] ?? '',
                'image' => $member['image'] ?? '',
                'slug' => $member['slug'] ?? '',
            ];
        }

        return [
            'title' => 'Meet Our Leadership Team',
            'content' => '<p>Our experienced leadership team brings decades of higher education financial aid expertise to every partnership.</p>',
            'members' => $members,
        ];
    }

    private function extractSectionHtml(string $bladePath, string $sectionClass): string
    {
        $content = file_get_contents($bladePath);

        $pattern = '/<section[^>]*class="[^"]*\b'.preg_quote($sectionClass, '/').'\b[^"]*"[^>]*>(.*?)<\/section>/s';

        if (! preg_match($pattern, $content, $matches)) {
            return '';
        }

        return $this->stripBladeSyntax($matches[1]);
    }

    private function stripBladeSyntax(string $html): string
    {
        $html = preg_replace('/@csrf/', '', $html);
        $html = preg_replace('/@foreach[^@]+@endforeach/s', '', $html);
        $html = preg_replace('/@if[^@]+@endif/s', '', $html);
        $html = preg_replace('/@include[^)]+\)/', '', $html);
        $html = preg_replace('/\{\{[^}]+\}\}/', '', $html);
        $html = preg_replace('/\{!![^!]+!!\}/', '', $html);
        $html = preg_replace('/@php[^@]+@endphp/s', '', $html);

        return $html;
    }

    private function extractByClass(string $html, string $className): string
    {
        $pattern = '/<div[^>]*class="[^"]*\b'.preg_quote($className, '/').'\b[^"]*"[^>]*>(.*?)<\/div>/s';

        return preg_match($pattern, $html, $matches) ? $matches[1] : '';
    }

    private function parseContentBlock(string $html, array $fields): array
    {
        $data = [];
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8"><div id="root">'.$html.'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $root = $dom->getElementById('root');

        if ($root === null) {
            return $data;
        }

        if ($this->hasField($fields, 'title')) {
            $h = $xpath->query('.//h1|.//h2|.//h3', $root)->item(0);
            if ($h !== null) {
                $data['title'] = trim($h->textContent);
            }
        }

        if ($this->hasField($fields, 'content')) {
            $paragraphs = $xpath->query('.//p|.//ul|.//li', $root);
            $parts = [];

            foreach ($paragraphs as $node) {
                $parts[] = $dom->saveHTML($node);
            }

            if ($parts === []) {
                $inner = $this->innerHtml($dom, $root);
                $inner = preg_replace('/<h[1-6][^>]*>.*?<\/h[1-6]>/s', '', $inner);
                $inner = trim($inner);

                if ($inner !== '') {
                    $data['content'] = $inner;
                }
            } else {
                $data['content'] = implode("\n", $parts);
            }
        }

        if ($this->hasField($fields, 'image')) {
            $img = $xpath->query('.//img', $root)->item(0);

            if ($img !== null) {
                $src = $img->getAttribute('src');
                $data['image'] = $this->normalizeImagePath($src);
            }
        }

        if ($this->hasField($fields, 'button_text')) {
            $link = $xpath->query('.//a[contains(@class,"btn-green")]', $root)->item(0);

            if ($link !== null) {
                $data['button_text'] = trim($link->textContent);
            }
        }

        return array_filter($data, fn ($value) => $value !== null && $value !== '');
    }

    private function extractFaqFromBlade(string $bladePath, string $sectionClass): ?array
    {
        $html = $this->extractSectionHtml($bladePath, $sectionClass);

        if ($html === '') {
            return null;
        }

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8"><div id="root">'.$html.'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $root = $dom->getElementById('root');

        if ($root === null) {
            return null;
        }

        $data = [];
        $titleNode = $xpath->query('.//h1|.//h2', $root)->item(0);

        if ($titleNode !== null) {
            $data['title'] = trim($titleNode->textContent);
        }

        $items = [];

        foreach ($xpath->query('.//div[contains(@class,"faq-item")]', $root) as $item) {
            $question = $xpath->query('.//button[contains(@class,"faq-question")]//span', $item)->item(0);
            $answer = $xpath->query('.//div[contains(@class,"faq-answer")]', $item)->item(0);

            if ($question === null) {
                continue;
            }

            $items[] = [
                'question' => trim($question->textContent),
                'answer' => $answer !== null ? $this->innerHtml($dom, $answer) : '',
            ];
        }

        if ($items !== []) {
            $data['items'] = $items;
        }

        return $data === [] ? null : $data;
    }

    private function innerHtml(DOMDocument $dom, \DOMNode $node): string
    {
        $html = '';

        foreach ($node->childNodes as $child) {
            $html .= $dom->saveHTML($child);
        }

        return trim($html);
    }

    private function hasField(array $fields, string $name): bool
    {
        return array_key_exists($name, $fields);
    }

    private function normalizeImagePath(string $src): string
    {
        $src = trim($src);

        if ($src === '') {
            return '';
        }

        if (str_contains($src, 'media_asset')) {
            if (preg_match("/media_asset\('([^']+)'\)/", $src, $m)) {
                return $m[1];
            }
        }

        return ltrim($src, '/');
    }

    public function needsStructureReset(array $content, array $schema): bool
    {
        $fields = $schema['fields'] ?? [];

        foreach ($fields as $fieldKey => $field) {
            if (($field['type'] ?? '') === 'repeater' && ! isset($content[$fieldKey])) {
                if (isset($content['content']) || isset($content['title'])) {
                    return true;
                }
            }
        }

        if (isset($fields['paragraph_1']) && isset($content['content']) && ! isset($content['paragraph_1'])) {
            return true;
        }

        return false;
    }

    private function hasStoredContent(?array $content): bool
    {
        if ($content === null || $content === []) {
            return false;
        }

        foreach ($content as $value) {
            if (is_array($value) && $value !== []) {
                return true;
            }

            if (! is_array($value) && $value !== null && $value !== '') {
                return true;
            }
        }

        return false;
    }
}
