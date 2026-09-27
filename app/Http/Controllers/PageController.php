<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    private const PAGES = [
        'home' => 'pages.home',
        'who-we-are' => 'pages.who-we-are',
        'about-us' => 'pages.who-we-are',
        'our-services' => 'pages.our-services',
        'team' => 'pages.team',
        'our-partnership' => 'pages.our-partnership',
        'get-started' => 'pages.get-started',
        'contact-us' => 'pages.contact-us',
        'financial-aid-processing' => 'pages.financial-aid-processing',
        'financial-aid-staffing' => 'pages.financial-aid-staffing',
        'student-outreach-communication' => 'pages.student-outreach-communication',
        'financial-aid-consulting' => 'pages.financial-aid-consulting',
        'testimonials' => 'pages.testimonials',
        'case-studies' => 'pages.case-studies',
        'faq' => 'pages.faq',
        'blogs' => 'pages.blogs',
        'fed-updates' => 'pages.fed-updates',
        'knowledge-nuggets' => 'pages.knowledge-nuggets',
        'white-paper-report' => 'pages.white-paper-report',
        'webinar' => 'pages.webinar',
        'financial-aid-regulatory-and-compliance-checklist' => 'pages.financial-aid-regulatory-and-compliance-checklist',
        'careers' => 'pages.careers',
    ];

    public function show(string $page): View
    {
        abort_unless(isset(self::PAGES[$page]), 404);

        return view(self::PAGES[$page]);
    }
}
