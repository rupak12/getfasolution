<?php

namespace App\Data;

class WebinarCatalog
{
    /** @return list<array<string, mixed>> */
    public static function defaults(): array
    {
        static $items = null;

        if ($items === null) {
            $path = __DIR__.'/webinars.php';
            $items = is_file($path) ? require $path : [];
        }

        return $items;
    }

    /** @return list<array<string, mixed>> */
    public static function items(): array
    {
        $sessions = page_content('webinar', 'sessions') ?? [];
        $items = $sessions['items'] ?? [];

        if (! is_array($items)) {
            $items = [];
        }

        $normalized = [];

        foreach ($items as $row) {
            if (! is_array($row)) {
                continue;
            }

            $title = trim((string) ($row['title'] ?? ''));

            if ($title === '') {
                continue;
            }

            $slug = trim((string) ($row['slug'] ?? ''));

            if ($slug === '') {
                $slug = str($title)->slug()->toString();
            }

            $normalized[] = [
                'slug' => $slug,
                'title' => $title,
                'summary' => trim((string) ($row['summary'] ?? '')),
                'image' => $row['image'] ?? '',
                'video_url' => trim((string) ($row['video_url'] ?? '')),
            ];
        }

        if ($normalized !== []) {
            return $normalized;
        }

        return self::defaults();
    }

    public static function find(string $slug): ?array
    {
        foreach (self::items() as $item) {
            if (($item['slug'] ?? '') === $slug) {
                return $item;
            }
        }

        return null;
    }
}
