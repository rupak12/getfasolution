<?php

$entries = [
    ['slug' => 'fed-updates-september-2026', 'date' => 'September 8, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter September 2026'],
    ['slug' => 'fed-updates-august-2026', 'date' => 'August 6, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter August 2026'],
    ['slug' => 'fed-updates-july-2026', 'date' => 'July 6, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter July 2026'],
    ['slug' => 'fed-updates-june-2026', 'date' => 'June 8, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter June 2026'],
    ['slug' => 'fed-updates-may-2026', 'date' => 'May 7, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter May 2026'],
    ['slug' => 'fed-updates-april-2026', 'date' => 'April 15, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter April 2026'],
    ['slug' => 'fed-updates-march-2026', 'date' => 'March 23, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter – March 2026'],
    ['slug' => 'fed-updates-february-2026', 'date' => 'February 9, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter February 2026'],
    ['slug' => 'fed-updates-january-2026', 'date' => 'January 12, 2026', 'title' => 'Fed-Updates Financial Aid Newsletter January 2026'],
    ['slug' => 'fed-updates-december-2025', 'date' => 'December 4, 2025', 'title' => 'Fed-Updates Financial Aid Newsletter December 2025'],
];

$articles = [];

foreach ($entries as $entry) {
    $articles[$entry['slug']] = [
        'title' => $entry['title'],
        'meta_title' => $entry['title'].' | FA Solutions',
        'category' => 'Fed Updates',
        'date' => $entry['date'],
        'parent_route' => 'fed-updates',
        'parent_label' => 'Back to Fed Updates',
        'intro' => $entry['title'],
    ];
}

return $articles;
