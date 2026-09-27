<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$section = App\Models\PageSection::query()
    ->where('key', 'intro')
    ->whereHas('page', fn ($q) => $q->where('slug', 'home'))
    ->first();

echo "DB content keys: ".implode(', ', array_keys($section?->content ?? [])).PHP_EOL;
echo json_encode($section?->content, JSON_PRETTY_PRINT).PHP_EOL;
echo "Cached title: ".app(App\Services\PageContentService::class)->get('home', 'intro', 'title').PHP_EOL;
