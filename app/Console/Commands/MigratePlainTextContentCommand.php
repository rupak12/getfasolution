<?php

namespace App\Console\Commands;

use App\Models\PageSection;
use App\Services\PageContentNormalizer;
use App\Services\PageContentService;
use Illuminate\Console\Command;

class MigratePlainTextContentCommand extends Command
{
    protected $signature = 'pages:migrate-plain-text';

    protected $description = 'Convert stored HTML content to plain text paragraph fields in the database';

    public function handle(PageContentNormalizer $normalizer, PageContentService $pageContent): int
    {
        $sectionsConfig = config('page_sections.sections', []);
        $migrated = 0;
        $pages = [];

        foreach (PageSection::query()->with('page')->get() as $section) {
            $schema = $sectionsConfig[$section->page->slug][$section->key] ?? null;

            if ($schema === null) {
                continue;
            }

            $fields = $schema['fields'] ?? [];
            $original = $section->content ?? [];
            $content = $normalizer->forStorage(
                $normalizer->forAdmin(
                    array_replace_recursive($schema['defaults'] ?? [], $original),
                    $fields
                ),
                $fields
            );

            if (isset($fields['paragraph_1'], $content['content'])) {
                unset($content['content']);
            }

            if ($content === $original) {
                continue;
            }

            $section->update(['content' => $content]);
            $pages[$section->page->slug] = true;
            $migrated++;
        }

        foreach (array_keys($pages) as $slug) {
            $pageContent->refresh($slug);
        }

        $this->info("Migrated {$migrated} sections to plain text.");

        return self::SUCCESS;
    }
}
