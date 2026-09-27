<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Services\PageContentImporter;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $tree = config('page_sections.tree', []);
        $sectionsConfig = config('page_sections.sections', []);

        $this->seedTree($tree);

        foreach ($sectionsConfig as $pageSlug => $sections) {
            $page = Page::query()->where('slug', $pageSlug)->first();

            if ($page === null) {
                continue;
            }

            $sortOrder = 0;

            foreach ($sections as $key => $schema) {
                $section = PageSection::query()->where('page_id', $page->id)->where('key', $key)->first();

                $defaults = $schema['defaults'] ?? [];

                PageSection::query()->updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'key' => $key,
                    ],
                    [
                        'content' => ($section === null || empty($section->content)) && $defaults !== []
                            ? $defaults
                            : ($section?->content ?? $defaults),
                        'sort_order' => $sortOrder,
                        'is_active' => true,
                    ]
                );

                $sortOrder++;
            }
        }

        app(PageContentImporter::class)->importAll(false);
    }

    private function seedTree(array $nodes, ?int $parentId = null): void
    {
        foreach ($nodes as $index => $node) {
            $page = Page::query()->updateOrCreate(
                ['slug' => $node['slug']],
                [
                    'parent_id' => $parentId,
                    'title' => $node['title'],
                    'route_name' => $node['route_name'] ?? null,
                    'is_group' => (bool) ($node['is_group'] ?? false),
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );

            if (! empty($node['children'])) {
                $this->seedTree($node['children'], $page->id);
            }
        }
    }
}
