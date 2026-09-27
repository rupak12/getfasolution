<?php

namespace App\Services;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class PageContentService
{
    public function forPage(string $slug): array
    {
        return Cache::rememberForever($this->cacheKey($slug), function () use ($slug) {
            $page = Page::query()->where('slug', $slug)->first();

            if ($page === null) {
                return $this->fallbackFromConfig($slug);
            }

            $sections = [];

            foreach ($page->sections()->where('is_active', true)->get() as $section) {
                $dbContent = $section->content ?? [];
                $defaults = config("page_sections.sections.{$slug}.{$section->key}.defaults", []);

                $sections[$section->key] = $this->mergeSection($defaults, $dbContent);
            }

            return $sections;
        });
    }

    public function get(string $pageSlug, string $sectionKey, ?string $field = null, mixed $default = null): mixed
    {
        $section = $this->forPage($pageSlug)[$sectionKey] ?? [];

        if ($field === null) {
            return $section ?: $default;
        }

        return Arr::get($section, $field, $default);
    }

    public function refresh(string $slug): void
    {
        Cache::forget($this->cacheKey($slug));
    }

    public function refreshAll(): void
    {
        Page::query()->pluck('slug')->each(fn (string $slug) => $this->refresh($slug));
    }

    private function cacheKey(string $slug): string
    {
        return 'page_content.'.$slug;
    }

    private function mergeSection(array $defaults, array $stored): array
    {
        if ($stored === []) {
            return $defaults;
        }

        return array_replace_recursive($defaults, $stored);
    }

    private function fallbackFromConfig(string $slug): array
    {
        $sections = config("page_sections.sections.{$slug}", []);
        $content = [];

        foreach ($sections as $key => $schema) {
            $content[$key] = $schema['defaults'] ?? [];
        }

        return $content;
    }
}
