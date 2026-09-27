<?php

if (! function_exists('media_asset')) {
    /**
     * Generate a URL for a public asset, encoding special characters in path segments.
     * Required for filenames that contain "+" which browsers otherwise treat as spaces.
     */
    function media_asset(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        $path = ltrim(str_replace('\\', '/', $path), '/');
        $segments = array_map('rawurlencode', explode('/', $path));

        return asset(implode('/', $segments));
    }
}

if (! function_exists('page_content')) {
    /**
     * Get page section content from the database cache.
     *
     * @param  string  $pageSlug  Page slug (e.g. home, who-we-are)
     * @param  string|null  $path  Dot-notation path (e.g. hero.title)
     */
    function page_content(string $pageSlug, ?string $path = null, mixed $default = null): mixed
    {
        $service = app(\App\Services\PageContentService::class);

        if ($path === null) {
            return $service->forPage($pageSlug);
        }

        if (! str_contains($path, '.')) {
            return $service->get($pageSlug, $path, null, $default);
        }

        [$section, $field] = explode('.', $path, 2);

        return $service->get($pageSlug, $section, $field, $default);
    }
}

if (! function_exists('normalize_get_started_started')) {
    /** @param  array<string, mixed>  $content */
    function normalize_get_started_started(array $content): array
    {
        $defaults = config('page_sections.sections.get-started.started.defaults', []);
        $content = array_replace_recursive($defaults, $content);

        if (trim((string) ($content['newsletter_label'] ?? '')) === '' && ! empty($content['paragraph_3'])) {
            $content['newsletter_label'] = html_to_plain($content['paragraph_3']);
        }

        if (trim((string) ($content['recaptcha_notice'] ?? '')) === '' && ! empty($content['paragraph_2'])) {
            $content['recaptcha_notice'] = html_to_plain($content['paragraph_2']);
        }

        if (trim((string) ($content['button_1_text'] ?? '')) === '' && ! empty($content['button_text'])) {
            $content['button_1_text'] = $content['button_text'];
            $content['button_1_route'] = $content['button_route'] ?? ($content['button_1_route'] ?? null);
        }

        if (trim((string) ($content['button_2_text'] ?? '')) === '' && empty($content['button_2_route'])) {
            $content['button_2_text'] = 'See How We Can Help';
            $content['button_2_route'] = 'who-we-are';
        }

        return $content;
    }
}

if (! function_exists('page_button_url')) {
    /** @param  array<string, mixed>  $section */
    function page_button_url(array $section, string $prefix, string $fallback = '#'): string
    {
        $url = trim((string) ($section["{$prefix}_url"] ?? ''));

        if ($url !== '') {
            return $url;
        }

        return page_route_url($section["{$prefix}_route"] ?? null, $fallback);
    }
}

if (! function_exists('page_route_url')) {
    function page_route_url(?string $routeName, string $fallback = '#'): string
    {
        if ($routeName === null || $routeName === '') {
            return $fallback;
        }

        if (\Illuminate\Support\Facades\Route::has($routeName)) {
            return route($routeName);
        }

        return $fallback;
    }
}

if (! function_exists('page_image')) {
    function page_image(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return media_asset($path);
    }
}

if (! function_exists('html_to_plain')) {
    /** Convert stored HTML into plain text for admin textareas. */
    function html_to_plain(?string $value): string
    {
        if ($value === null || trim($value) === '') {
            return '';
        }

        if (! preg_match('/<[^>]+>/', $value)) {
            return trim($value);
        }

        $text = preg_replace('/<\/p>\s*<p[^>]*>/i', "\n\n", $value);
        $text = preg_replace('/<br\s*\/?>/i', "\n", $text);
        $text = preg_replace('/<\/li>\s*<li[^>]*>/i', "\n", $text);
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace("/[ \t]+\n/", "\n", preg_replace("/\n{3,}/", "\n\n", $text)));
    }
}

if (! function_exists('plain_text_sanitize')) {
    /** Store plain text only (no HTML tags). */
    function plain_text_sanitize(?string $value): string
    {
        return html_to_plain($value);
    }
}

if (! function_exists('page_html_to_paragraphs')) {
    /** @return list<string> */
    function page_html_to_paragraphs(?string $html): array
    {
        $plain = html_to_plain($html);

        if ($plain === '') {
            return [];
        }

        $parts = preg_split("/\r\n\r\n|\n\n/", $plain) ?: [];

        return array_values(array_filter(array_map('trim', $parts), fn ($p) => $p !== ''));
    }
}

if (! function_exists('page_section_paragraphs')) {
    /**
     * Get paragraph list from section data (paragraph_1/2/3 or legacy content field).
     *
     * @return list<string>
     */
    function page_section_paragraphs(array $section): array
    {
        $paragraphs = [];

        foreach (['paragraph_1', 'paragraph_2', 'paragraph_3', 'paragraph_4'] as $key) {
            if (! empty($section[$key])) {
                $paragraphs[] = html_to_plain($section[$key]);
            }
        }

        if ($paragraphs !== []) {
            return $paragraphs;
        }

        if (! empty($section['content'])) {
            return page_html_to_paragraphs($section['content']);
        }

        return [];
    }
}

if (! function_exists('page_bullet_lines')) {
    /** @return list<string> */
    function page_bullet_lines(?string $value): array
    {
        $plain = html_to_plain($value);

        if ($plain === '') {
            return [];
        }

        if (str_contains($value ?? '', '<li>')) {
            preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $value, $matches);

            return array_values(array_filter(array_map(fn ($item) => html_to_plain($item), $matches[1] ?? [])));
        }

        $lines = preg_split("/\r\n|\r|\n/", $plain) ?: [];

        return array_values(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));
    }
}
