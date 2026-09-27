<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$who = page_content('careers', 'who') ?? [];
echo json_encode($who, JSON_PRETTY_PRINT).PHP_EOL;
