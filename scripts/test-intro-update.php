<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$section = App\Models\PageSection::query()
    ->where('key', 'intro')
    ->whereHas('page', fn ($q) => $q->where('slug', 'home'))
    ->first();

$content = $section->content;
$content['title'] = 'Real People. Real Expertise.demo';
$section->update(['content' => $content]);

app(App\Services\PageContentService::class)->refresh('home');

echo 'DB: '.$section->fresh()->content['title'].PHP_EOL;
echo 'Cache: '.app(App\Services\PageContentService::class)->get('home', 'intro', 'title').PHP_EOL;
