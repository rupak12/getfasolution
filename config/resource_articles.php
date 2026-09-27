<?php

$caseStudies = require __DIR__.'/resource_articles/case_studies.php';
$blogs = require __DIR__.'/resource_articles/blogs.php';
$fedUpdates = require __DIR__.'/resource_articles/fed_updates.php';
$whitePapers = require __DIR__.'/resource_articles/white_papers.php';
$knowledgeNuggets = require __DIR__.'/resource_articles/knowledge_nuggets.php';

return [
    'articles' => array_merge($caseStudies, $blogs, $fedUpdates, $whitePapers, $knowledgeNuggets),
];
