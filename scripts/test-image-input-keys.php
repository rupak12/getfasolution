<?php

require __DIR__.'/../vendor/autoload.php';

$r = Illuminate\Http\Request::create('/', 'POST', [
    'content' => [
        'image' => null,
        'image_remove' => '1',
    ],
]);

echo 'content.image_remove boolean: '.var_export($r->boolean('content.image_remove'), true).PHP_EOL;

$r2 = Illuminate\Http\Request::create('/', 'POST', [], [], [
    'content' => [
        'image_file' => Illuminate\Http\UploadedFile::fake()->image('x.jpg'),
    ],
]);

echo 'hasFile content.image_file: '.var_export($r2->hasFile('content.image_file'), true).PHP_EOL;
