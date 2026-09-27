<?php

use App\Models\Page;
use App\Models\PageSection;
use App\Services\PageContentService;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $pages = [
            [
                'slug' => 'contact-us',
                'title' => 'Contact Us',
                'route_name' => 'contact-us',
            ],
            [
                'slug' => 'faq',
                'title' => 'FAQ',
                'route_name' => 'faq',
            ],
        ];

        $careers = Page::query()->where('slug', 'careers')->first();
        $baseOrder = $careers !== null ? $careers->sort_order + 1 : 50;

        foreach ($pages as $index => $pageData) {
            $page = Page::query()->updateOrCreate(
                ['slug' => $pageData['slug']],
                [
                    'parent_id' => null,
                    'title' => $pageData['title'],
                    'route_name' => $pageData['route_name'],
                    'is_group' => false,
                    'sort_order' => $baseOrder + $index,
                    'is_active' => true,
                ]
            );

            $sections = config("page_sections.sections.{$pageData['slug']}", []);
            $sortOrder = 0;

            foreach ($sections as $key => $schema) {
                $defaults = $schema['defaults'] ?? [];
                $existing = PageSection::query()
                    ->where('page_id', $page->id)
                    ->where('key', $key)
                    ->first();

                PageSection::query()->updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'key' => $key,
                    ],
                    [
                        'content' => ($existing === null || empty($existing->content)) && $defaults !== []
                            ? $defaults
                            : ($existing?->content ?? $defaults),
                        'sort_order' => $sortOrder++,
                        'is_active' => true,
                    ]
                );
            }

            app(PageContentService::class)->refresh($pageData['slug']);
        }
    }

    public function down(): void
    {
        foreach (['contact-us', 'faq'] as $slug) {
            $page = Page::query()->where('slug', $slug)->first();

            if ($page === null) {
                continue;
            }

            PageSection::query()->where('page_id', $page->id)->delete();
            $page->delete();
            app(PageContentService::class)->refresh($slug);
        }
    }
};
