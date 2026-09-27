<?php

namespace App\Console\Commands;

use App\Services\PageContentImporter;
use Illuminate\Console\Command;

class ImportPageContentCommand extends Command
{
    protected $signature = 'pages:import-content {--force : Overwrite existing section content}';

    protected $description = 'Import page section content from Blade templates into the database';

    public function handle(PageContentImporter $importer): int
    {
        $count = $importer->importAll($this->option('force'));

        $this->info("Imported content for {$count} sections.");

        return self::SUCCESS;
    }
}
