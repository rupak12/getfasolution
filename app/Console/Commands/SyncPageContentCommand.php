<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\PageSection;
use App\Services\PageContentImporter;
use App\Services\PageContentService;
use Illuminate\Console\Command;

class SyncPageContentCommand extends Command
{
    protected $signature = 'pages:sync-content {--force : Overwrite existing section content with config defaults}';

    protected $description = 'Sync page section content from config defaults into the database';

    public function handle(PageContentService $pageContent, PageContentImporter $importer): int
    {
        $sectionsConfig = config('page_sections.sections', []);
        $synced = 0;

        foreach ($sectionsConfig as $pageSlug => $sections) {
            $page = Page::query()->where('slug', $pageSlug)->first();

            if ($page === null) {
                $this->warn("Page not found: {$pageSlug}");

                continue;
            }

            $sortOrder = 0;

            foreach ($sections as $key => $schema) {
                $defaults = $schema['defaults'] ?? [];
                $existing = PageSection::query()
                    ->where('page_id', $page->id)
                    ->where('key', $key)
                    ->first();

                $content = $defaults;

                if ($existing !== null && ! $this->option('force')) {
                    $content = ($existing->content !== null && $existing->content !== [])
                        ? $existing->content
                        : $defaults;
                }

                PageSection::query()->updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'key' => $key,
                    ],
                    [
                        'content' => $content,
                        'sort_order' => $sortOrder++,
                        'is_active' => true,
                    ]
                );

                $synced++;
            }

            $pageContent->refresh($pageSlug);
        }

        $imported = $importer->importAll($this->option('force'));

        $this->info("Synced {$synced} sections to the database.");
        $this->info("Imported content for {$imported} sections from Blade templates.");

        return self::SUCCESS;
    }
}
