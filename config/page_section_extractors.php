<?php

/**
 * Maps page sections to CSS classes in resources/views/pages/{slug}.blade.php
 */
return [
    'team' => [
        'team' => ['section' => 'team-section', 'title_selector' => null],
    ],
    'our-partnership' => [
        'partner_logos' => ['section' => 'partner-logos-section'],
        'partner_impact' => ['section' => 'partner-impact-section', 'content_selector' => '.partner-impact-copy'],
        'partner_commitment' => ['section' => 'partner-commitment-section', 'content_selector' => '.about-commitment-left'],
    ],
    'get-started' => [
        'started' => ['section' => 'started-section'],
        'started_follow' => ['section' => 'started-follow'],
        'killers' => ['section' => 'killers-section'],
    ],
    'financial-aid-processing' => [
        'intro' => ['section' => 'service-intro-section'],
        'simplify' => ['section' => 'service-simplify-section'],
        'cases' => ['section' => 'service-cases-section'],
    ],
    'financial-aid-staffing' => [
        'intro' => ['section' => 'service-intro-section'],
        'why' => ['section' => 'why-section'],
        'cases' => ['section' => 'service-cases-section'],
    ],
    'student-outreach-communication' => [
        'intro' => ['section' => 'service-intro-section'],
        'simplify' => ['section' => 'service-simplify-section'],
        'cases' => ['section' => 'service-cases-section'],
    ],
    'financial-aid-consulting' => [
        'intro' => ['section' => 'service-intro-section'],
        'simplify' => ['section' => 'service-simplify-section'],
        'cases' => ['section' => 'service-cases-section'],
    ],
    'testimonials' => [
        'testimonials' => ['section' => 'testimonials-section'],
        'silent_killers' => ['section' => 'silent-killers-section'],
    ],
    'case-studies' => [
        'main' => ['section' => 'cases-page-section'],
    ],
    'blogs' => [
        'main' => ['section' => 'blogs-section'],
    ],
    'fed-updates' => [
        'main' => ['section' => 'fed-updates-section'],
    ],
    'knowledge-nuggets' => [
        'main' => ['section' => 'nuggets-section'],
    ],
    'white-paper-report' => [
        'main' => ['section' => 'white-papers-section'],
    ],
    'webinar' => [
        'main' => ['section' => 'webinar-content'],
    ],
    'financial-aid-regulatory-and-compliance-checklist' => [
        'checklist' => ['section' => 'checklist-section'],
    ],
    'careers' => [
        'culture' => ['section' => 'careers-culture-section'],
        'who' => ['section' => 'careers-who-section'],
        'growth' => ['section' => 'careers-growth-section'],
        'jobs' => ['section' => 'careers-jobs-section'],
        'eeo' => ['section' => 'careers-eeo-section'],
        'faq' => ['section' => 'careers-faq-section', 'type' => 'faq'],
    ],
];
