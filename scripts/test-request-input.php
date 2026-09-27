<?php

require __DIR__.'/../vendor/autoload.php';

$r = Illuminate\Http\Request::create('/', 'POST', [
    'content' => [
        'title' => 'SIM',
        'paragraph_1' => 'p1',
    ],
]);

echo 'content[title]: ';
var_export($r->input('content[title]'));
echo PHP_EOL;

echo 'content.title: ';
var_export($r->input('content.title'));
echo PHP_EOL;

echo 'full content: ';
var_export($r->input('content'));
