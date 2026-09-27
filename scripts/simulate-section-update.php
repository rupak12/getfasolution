<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$page = App\Models\Page::where('slug', 'home')->first();
$section = App\Models\PageSection::where('page_id', $page->id)->where('key', 'intro')->first();
$schema = $section->schema();
$fields = $schema['fields'] ?? [];

$controller = app(App\Http\Controllers\Admin\PagesSettingsController::class);
$ref = new ReflectionClass($controller);

$sectionContent = $ref->getMethod('sectionContent');
$sectionContent->setAccessible(true);
$collect = $ref->getMethod('collectFieldValues');
$collect->setAccessible(true);

$storedSectionContent = $ref->getMethod('storedSectionContent');
$storedSectionContent->setAccessible(true);
$existing = $storedSectionContent->invoke($controller, $section, $schema);

$request = Illuminate\Http\Request::create('/fake', 'PUT', [
    'content' => [
        'title' => 'Real People. Real Expertise.SIMULATED',
        'paragraph_1' => $existing['paragraph_1'] ?? '',
        'paragraph_2' => '',
        'paragraph_3' => '',
        'button_text' => $existing['button_text'] ?? '',
        'button_route' => $existing['button_route'] ?? '',
    ],
]);

$content = $collect->invoke($controller, $request, $fields, $existing, 'home', 'intro');
$content = app(App\Services\PageContentNormalizer::class)->forStorage($content, $fields);

$section->update(['content' => $content]);
app(App\Services\PageContentService::class)->refresh('home');

echo 'Saved title: '.$section->fresh()->content['title'].PHP_EOL;
echo 'Cached: '.app(App\Services\PageContentService::class)->get('home', 'intro', 'title').PHP_EOL;
