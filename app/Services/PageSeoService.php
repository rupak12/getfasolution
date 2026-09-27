<?php

namespace App\Services;

use App\Models\PageSeo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class PageSeoService
{
    public function entryForSlug(string $slug): ?array
    {
        foreach (config('page_seo.entries', []) as $entry) {
            if ($entry['slug'] === $slug) {
                return $entry;
            }
        }

        return null;
    }

    public function resolve(?string $routeKey = null, array $context = []): array
    {
        $routeKey = $routeKey ?? Route::currentRouteName();

        if ($routeKey === null) {
            return $this->blankResolved();
        }

        return Cache::rememberForever($this->cacheKey($routeKey, $context), function () use ($routeKey, $context) {
            return $this->buildResolved($routeKey, $context);
        });
    }

    public function resolveForAdmin(string $slug): array
    {
        $entry = $this->entryForSlug($slug);

        if ($entry === null) {
            abort(404);
        }

        $routeKey = $entry['route'];
        $stored = PageSeo::query()->where('route_key', $routeKey)->first();
        $merged = $this->mergeEntry($entry, $stored?->toArray() ?? []);

        return [
            'entry' => $entry,
            'stored' => $stored,
            'values' => $merged,
            'resolved' => $this->buildResolved($routeKey, [], $merged),
        ];
    }

    public function refresh(string $routeKey): void
    {
        Cache::forget($this->cacheKey($routeKey, []));

        if ($routeKey === 'team.member') {
            foreach (array_keys(config('team.members', [])) as $slug) {
                Cache::forget($this->cacheKey($routeKey, ['member' => ['slug' => $slug]]));
            }
        }
    }

    public function refreshAll(): void
    {
        foreach (config('page_seo.entries', []) as $entry) {
            $this->refresh($entry['route']);
        }
    }

    private function buildResolved(string $routeKey, array $context, ?array $merged = null): array
    {
        $article = config("resource_articles.articles.{$routeKey}");

        if (is_array($article)) {
            return $this->resolvedFromResourceArticle($article, $routeKey);
        }

        $entry = $this->entryForRoute($routeKey);

        if ($entry === null) {
            return $this->blankResolved();
        }

        if ($merged === null) {
            $stored = PageSeo::query()->where('route_key', $routeKey)->first();
            $merged = $this->mergeEntry($entry, $stored?->toArray() ?? []);
        }

        $replacements = $this->replacements($context);

        $metaTitle = $this->applyReplacements($merged['meta_title'] ?? '', $replacements);
        $metaDescription = $this->applyReplacements($merged['meta_description'] ?? '', $replacements);
        $ogTitle = $this->applyReplacements($merged['og_title'] ?: $metaTitle, $replacements);
        $ogDescription = $this->applyReplacements($merged['og_description'] ?: $metaDescription, $replacements);
        $twitterTitle = $this->applyReplacements($merged['twitter_title'] ?: $ogTitle, $replacements);
        $twitterDescription = $this->applyReplacements($merged['twitter_description'] ?: $ogDescription, $replacements);

        $canonical = trim((string) ($merged['canonical_url'] ?? ''));

        if ($canonical === '' && Route::has($routeKey)) {
            $canonical = route($routeKey, $this->routeParameters($routeKey, $context));
        }

        $ogImage = $merged['og_image'] ?? null;
        $twitterImage = $merged['twitter_image'] ?: $ogImage;

        return [
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => trim((string) ($merged['meta_keywords'] ?? '')),
            'meta_robots' => $merged['meta_robots'] ?? config('page_seo.base_defaults.meta_robots'),
            'canonical_url' => $canonical,
            'og_title' => $ogTitle,
            'og_description' => $ogDescription,
            'og_image' => $ogImage,
            'og_image_url' => $this->imageUrl($ogImage),
            'og_type' => $merged['og_type'] ?? config('page_seo.base_defaults.og_type'),
            'twitter_card' => $merged['twitter_card'] ?? config('page_seo.base_defaults.twitter_card'),
            'twitter_title' => $twitterTitle,
            'twitter_description' => $twitterDescription,
            'twitter_image' => $twitterImage,
            'twitter_image_url' => $this->imageUrl($twitterImage),
        ];
    }

    private function mergeEntry(array $entry, array $stored): array
    {
        $defaults = array_merge(
            config('page_seo.base_defaults', []),
            $entry['defaults'] ?? []
        );

        unset($stored['id'], $stored['route_key'], $stored['created_at'], $stored['updated_at']);

        $merged = array_replace($defaults, array_filter($stored, fn ($value) => $value !== null && $value !== ''));

        foreach (['og_title', 'og_description', 'twitter_title', 'twitter_description', 'twitter_image'] as $field) {
            if (! isset($merged[$field])) {
                $merged[$field] = '';
            }
        }

        return $merged;
    }

    private function entryForRoute(string $routeKey): ?array
    {
        foreach (config('page_seo.entries', []) as $entry) {
            if ($entry['route'] === $routeKey) {
                return $entry;
            }
        }

        return null;
    }

    /** @return array<string, string> */
    private function replacements(array $context): array
    {
        $memberName = $context['member']['name'] ?? '';

        return [
            '{member_name}' => $memberName,
            '{site_name}' => (string) config('app.name', 'FA Solutions'),
        ];
    }

    private function applyReplacements(string $value, array $replacements): string
    {
        return str_replace(array_keys($replacements), array_values($replacements), $value);
    }

    private function routeParameters(string $routeKey, array $context): array
    {
        if ($routeKey === 'team.member' && isset($context['member']['slug'])) {
            return ['slug' => $context['member']['slug']];
        }

        return [];
    }

    private function imageUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return media_asset($path);
    }

    private function cacheKey(string $routeKey, array $context): string
    {
        $memberSlug = $context['member']['slug'] ?? '';

        return 'page_seo.'.$routeKey.'.'.$memberSlug;
    }

    private function resolvedFromResourceArticle(array $article, string $routeKey): array
    {
        $description = $article['intro']
            ?? ($article['paragraphs'][0] ?? '')
            ?? ($article['sections'][0]['body'] ?? '');

        $metaTitle = $article['meta_title'] ?? ($article['title'].' | FA Solutions');

        return [
            'meta_title' => $metaTitle,
            'meta_description' => mb_substr(strip_tags((string) $description), 0, 500),
            'meta_keywords' => '',
            'meta_robots' => config('page_seo.base_defaults.meta_robots', 'index, follow'),
            'canonical_url' => route($routeKey),
            'og_title' => $metaTitle,
            'og_description' => mb_substr(strip_tags((string) $description), 0, 500),
            'og_image' => $article['image'] ?? null,
            'og_image_url' => $this->imageUrl($article['image'] ?? null),
            'og_type' => 'article',
            'twitter_card' => config('page_seo.base_defaults.twitter_card', 'summary_large_image'),
            'twitter_title' => $metaTitle,
            'twitter_description' => mb_substr(strip_tags((string) $description), 0, 500),
            'twitter_image' => $article['image'] ?? null,
            'twitter_image_url' => $this->imageUrl($article['image'] ?? null),
        ];
    }

    private function blankResolved(): array
    {
        return [
            'meta_title' => 'FA Solutions',
            'meta_description' => '',
            'meta_keywords' => '',
            'meta_robots' => 'index, follow',
            'canonical_url' => url('/'),
            'og_title' => 'FA Solutions',
            'og_description' => '',
            'og_image' => null,
            'og_image_url' => null,
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'FA Solutions',
            'twitter_description' => '',
            'twitter_image' => null,
            'twitter_image_url' => null,
        ];
    }
}
