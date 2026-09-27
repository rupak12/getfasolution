<?php

namespace Database\Seeders;

use App\Models\PageSeo;
use Illuminate\Database\Seeder;

class PageSeoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('page_seo.entries', []) as $entry) {
            PageSeo::query()->firstOrCreate(
                ['route_key' => $entry['route']],
                array_merge(
                    config('page_seo.base_defaults', []),
                    $entry['defaults'] ?? []
                )
            );
        }
    }
}
