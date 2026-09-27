<?php

$bannerFields = [
    'label' => ['type' => 'text', 'label' => 'Banner Label'],
    'title' => ['type' => 'text', 'label' => 'Banner Title'],
];

$contentBlockFields = [
    'title' => ['type' => 'text', 'label' => 'Section Title'],
    'paragraph_1' => ['type' => 'textarea', 'label' => 'Paragraph 1'],
    'paragraph_2' => ['type' => 'textarea', 'label' => 'Paragraph 2'],
    'paragraph_3' => ['type' => 'textarea', 'label' => 'Paragraph 3'],
    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
    'image' => ['type' => 'image', 'label' => 'Image'],
];

$ourPartnershipDefaults = require __DIR__.'/page_defaults/our_partnership.php';

return [
    'tree' => [
        [
            'slug' => 'home',
            'title' => 'Home',
            'route_name' => 'home',
        ],
        [
            'slug' => 'about',
            'title' => 'About',
            'is_group' => true,
            'children' => [
                ['slug' => 'who-we-are', 'title' => 'Who We Are', 'route_name' => 'who-we-are'],
                ['slug' => 'team', 'title' => 'Leadership Team', 'route_name' => 'team'],
                ['slug' => 'our-partnership', 'title' => 'Our Partnership', 'route_name' => 'our-partnership'],
            ],
        ],
        [
            'slug' => 'services',
            'title' => 'Services',
            'is_group' => true,
            'children' => [
                ['slug' => 'financial-aid-processing', 'title' => 'Financial Aid Processing', 'route_name' => 'financial-aid-processing'],
                ['slug' => 'financial-aid-staffing', 'title' => 'Financial Aid Staffing', 'route_name' => 'financial-aid-staffing'],
                ['slug' => 'student-outreach-communication', 'title' => 'Student Outreach', 'route_name' => 'student-outreach-communication'],
                ['slug' => 'financial-aid-consulting', 'title' => 'Financial Aid Consulting', 'route_name' => 'financial-aid-consulting'],
            ],
        ],
        [
            'slug' => 'resources',
            'title' => 'Resources',
            'is_group' => true,
            'children' => [
                ['slug' => 'get-started', 'title' => 'Get Started', 'route_name' => 'get-started'],
                ['slug' => 'testimonials', 'title' => 'Testimonials', 'route_name' => 'testimonials'],
                ['slug' => 'case-studies', 'title' => 'Case Studies', 'route_name' => 'case-studies'],
                ['slug' => 'blogs', 'title' => 'Blogs', 'route_name' => 'blogs'],
                ['slug' => 'fed-updates', 'title' => 'Fed Updates', 'route_name' => 'fed-updates'],
                ['slug' => 'knowledge-nuggets', 'title' => 'Knowledge Nuggets', 'route_name' => 'knowledge-nuggets'],
                ['slug' => 'white-paper-report', 'title' => 'White Paper Report', 'route_name' => 'white-paper-report'],
                ['slug' => 'webinar', 'title' => 'Events / Webinar', 'route_name' => 'webinar'],
                ['slug' => 'financial-aid-regulatory-and-compliance-checklist', 'title' => 'Compliance Checklist', 'route_name' => 'financial-aid-regulatory-and-compliance-checklist'],
            ],
        ],
        [
            'slug' => 'careers',
            'title' => 'Careers',
            'route_name' => 'careers',
        ],
        [
            'slug' => 'contact-us',
            'title' => 'Contact Us',
            'route_name' => 'contact-us',
        ],
        [
            'slug' => 'faq',
            'title' => 'FAQ',
            'route_name' => 'faq',
        ],
        [
            'slug' => 'our-services',
            'title' => 'Our Services',
            'route_name' => 'our-services',
        ],
    ],

    'sections' => [
        'home' => [
            'hero' => [
                'label' => 'Hero Section',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Main Title'],
                    'subtitle' => ['type' => 'text', 'label' => 'Subtitle'],
                    'paragraph_1' => ['type' => 'textarea', 'label' => 'Paragraph 1'],
                    'paragraph_2' => ['type' => 'textarea', 'label' => 'Paragraph 2'],
                    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                    'image_1' => ['type' => 'image', 'label' => 'Hero Image 1'],
                    'image_1_alt' => ['type' => 'text', 'label' => 'Hero Image 1 Alt'],
                    'image_2' => ['type' => 'image', 'label' => 'Hero Image 2'],
                    'image_2_alt' => ['type' => 'text', 'label' => 'Hero Image 2 Alt'],
                ],
                'defaults' => require __DIR__.'/page_defaults/home_hero.php',
            ],
            'intro' => [
                'label' => 'Real People Section',
                'fields' => $contentBlockFields,
                'defaults' => [
                    'title' => 'Real People. Real Expertise.',
                    'paragraph_1' => 'FA Solutions partners with colleges as an extension to their team to strengthen financial aid operations and navigate compliance with confidence. Powered by experienced, full-time higher education financial aid professionals, we deliver consistent, reliable results institutions and students can depend on.',
                    'button_text' => 'Meet Our Team',
                    'button_route' => 'who-we-are',
                    'image' => null,
                ],
            ],
            'difference' => [
                'label' => 'Our Difference & Contact Form',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Difference Title'],
                    'form_title' => ['type' => 'text', 'label' => 'Contact Form Title'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'Difference Items',
                        'fields' => [
                            'icon' => ['type' => 'image', 'label' => 'Icon'],
                            'title' => ['type' => 'text', 'label' => 'Title'],
                            'content' => ['type' => 'textarea', 'label' => 'Description'],
                        ],
                    ],
                ],
                'defaults' => require __DIR__.'/page_defaults/home_difference.php',
            ],
            'why' => [
                'label' => 'Why FA Solutions',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Title'],
                    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'Why Items',
                        'fields' => [
                            'title' => ['type' => 'text', 'label' => 'Title'],
                            'content' => ['type' => 'textarea', 'label' => 'Description'],
                        ],
                    ],
                ],
                'defaults' => require __DIR__.'/page_defaults/home_why.php',
            ],
            'services' => [
                'label' => 'Our Services',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Title'],
                    'cards' => [
                        'type' => 'repeater',
                        'label' => 'Service Cards',
                        'fields' => [
                            'image' => ['type' => 'image', 'label' => 'Image'],
                            'image_alt' => ['type' => 'text', 'label' => 'Image Alt'],
                            'title' => ['type' => 'text', 'label' => 'Title'],
                            'intro' => ['type' => 'textarea', 'label' => 'Intro Text'],
                            'bullets' => ['type' => 'textarea', 'label' => 'Bullet Points (one per line)'],
                            'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                            'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                        ],
                    ],
                ],
                'defaults' => require __DIR__.'/page_defaults/home_services.php',
            ],
            'success' => [
                'label' => 'Client Success Stories',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Title'],
                    'subtitle' => ['type' => 'text', 'label' => 'Subtitle'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'Success Stories',
                        'fields' => [
                            'content' => ['type' => 'textarea', 'label' => 'Story'],
                        ],
                    ],
                    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                ],
                'defaults' => require __DIR__.'/page_defaults/home_success.php',
            ],
            'image_gallery' => [
                'label' => 'Success Images',
                'fields' => [
                    'image_1' => ['type' => 'image', 'label' => 'Large Image'],
                    'image_1_alt' => ['type' => 'text', 'label' => 'Large Image Alt'],
                    'image_2' => ['type' => 'image', 'label' => 'Small Image'],
                    'image_2_alt' => ['type' => 'text', 'label' => 'Small Image Alt'],
                ],
                'defaults' => [
                    'image_1' => 'images/c-success-1.jpg',
                    'image_1_alt' => 'Students collaborating in a campus setting',
                    'image_2' => 'images/c-success-2.jpg',
                    'image_2_alt' => 'Students working together on financial aid',
                ],
            ],
            'faq' => [
                'label' => 'FAQ Section',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Title'],
                    'image' => ['type' => 'image', 'label' => 'FAQ Image'],
                    'image_alt' => ['type' => 'text', 'label' => 'Image Alt'],
                    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'FAQ Items',
                        'fields' => [
                            'question' => ['type' => 'text', 'label' => 'Question'],
                            'answer' => ['type' => 'textarea', 'label' => 'Answer'],
                        ],
                    ],
                ],
                'defaults' => require __DIR__.'/page_defaults/home_faq.php',
            ],
        ],

        'who-we-are' => [
            'banner' => [
                'label' => 'Page Banner',
                'fields' => $bannerFields,
                'defaults' => ['label' => 'About Us', 'title' => 'Who We Are'],
            ],
            'about_partner' => ['label' => 'Your Financial Aid Partner', 'fields' => $contentBlockFields, 'defaults' => require __DIR__.'/page_defaults/who_we_are_about_partner.php'],
            'about_believe' => ['label' => 'What We Believe', 'fields' => $contentBlockFields, 'defaults' => require __DIR__.'/page_defaults/who_we_are_about_believe.php'],
            'clients' => ['label' => 'Current Clients', 'fields' => ['title' => ['type' => 'text', 'label' => 'Title'], 'paragraph_1' => ['type' => 'textarea', 'label' => 'Description']], 'defaults' => require __DIR__.'/page_defaults/who_we_are_clients.php'],
            'faq' => ['label' => 'FAQ Section', 'fields' => ['title' => ['type' => 'text', 'label' => 'Title'], 'image' => ['type' => 'image', 'label' => 'FAQ Image'], 'items' => ['type' => 'repeater', 'label' => 'FAQ Items', 'fields' => ['question' => ['type' => 'text', 'label' => 'Question'], 'answer' => ['type' => 'textarea', 'label' => 'Answer']]]], 'defaults' => require __DIR__.'/page_defaults/who_we_are_faq.php'],
        ],

        'team' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Meet Our', 'title' => 'Leadership Team']],
            'team' => [
                'label' => 'Team Section',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Title'],
                    'content' => ['type' => 'textarea', 'label' => 'Intro Content'],
                    'members' => [
                        'type' => 'repeater',
                        'label' => 'Team Members',
                        'fields' => [
                            'name' => ['type' => 'text', 'label' => 'Name'],
                            'title' => ['type' => 'text', 'label' => 'Job Title'],
                            'image' => ['type' => 'image', 'label' => 'Photo'],
                            'slug' => ['type' => 'text', 'label' => 'Profile Slug'],
                        ],
                    ],
                ],
                'defaults' => [],
            ],
        ],

        'our-partnership' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Our', 'title' => 'Trusted Partners']],
            'partner_logos' => [
                'label' => 'Partner Logos',
                'description' => 'Upload each partner logo. You will see the current image and can replace it anytime.',
                'fields' => [
                    'logos' => [
                        'type' => 'repeater',
                        'label' => 'Partner Logos',
                        'fields' => [
                            'image' => ['type' => 'image', 'label' => 'Logo Image'],
                            'alt' => ['type' => 'text', 'label' => 'Company Name'],
                        ],
                    ],
                ],
                'defaults' => $ourPartnershipDefaults['partner_logos'],
            ],
            'partner_impact' => [
                'label' => 'Partner Impact',
                'description' => 'Left side text and right side partner card image.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Heading'],
                    'paragraph_1' => ['type' => 'textarea', 'label' => 'First Paragraph'],
                    'paragraph_2' => ['type' => 'textarea', 'label' => 'Second Paragraph'],
                    'card_image' => ['type' => 'image', 'label' => 'Partner Card Image (right side)'],
                    'card_link_route' => ['type' => 'route', 'label' => 'Card Link (when clicked)'],
                ],
                'defaults' => $ourPartnershipDefaults['partner_impact'],
            ],
            'partner_commitment' => [
                'label' => 'Our Commitment',
                'description' => 'Commitment points and contact form area heading.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Heading'],
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'Commitment Points',
                        'fields' => [
                            'title' => ['type' => 'text', 'label' => 'Point Title'],
                            'description' => ['type' => 'textarea', 'label' => 'Description'],
                        ],
                    ],
                    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                ],
                'defaults' => $ourPartnershipDefaults['partner_commitment'],
            ],
        ],

        'get-started' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Get Started With', 'title' => 'FA Solutions']],
            'started' => [
                'label' => 'Get Started Form',
                'description' => 'Left column: intro, newsletter label, and two action buttons. Right column: contact form title and disclaimer.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Main Heading'],
                    'paragraph_1' => ['type' => 'textarea', 'label' => 'Intro Paragraph'],
                    'newsletter_label' => ['type' => 'text', 'label' => 'Newsletter Label'],
                    'button_1_text' => ['type' => 'text', 'label' => 'Button 1 Label'],
                    'button_1_route' => ['type' => 'route', 'label' => 'Button 1 Page Link'],
                    'button_1_url' => ['type' => 'url', 'label' => 'Button 1 Custom URL'],
                    'button_2_text' => ['type' => 'text', 'label' => 'Button 2 Label'],
                    'button_2_route' => ['type' => 'route', 'label' => 'Button 2 Page Link'],
                    'button_2_url' => ['type' => 'url', 'label' => 'Button 2 Custom URL'],
                    'contact_form_title' => ['type' => 'text', 'label' => 'Contact Form Heading'],
                    'recaptcha_notice' => ['type' => 'textarea', 'label' => 'Contact Form Disclaimer'],
                ],
                'defaults' => require __DIR__.'/page_defaults/get_started_started.php',
            ],
            'started_follow' => ['label' => 'Follow Up Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'killers' => ['label' => 'Silent Killers Section', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'financial-aid-processing' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Our Services', 'title' => 'Financial Aid Processing & Compliance']],
            'intro' => ['label' => 'Service Intro', 'fields' => $contentBlockFields, 'defaults' => []],
            'simplify' => ['label' => 'Simplify Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'cases' => ['label' => 'Use Cases', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'financial-aid-staffing' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Our Services', 'title' => 'Financial Aid Staffing']],
            'intro' => ['label' => 'Service Intro', 'fields' => $contentBlockFields, 'defaults' => []],
            'why' => ['label' => 'Why Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'cases' => ['label' => 'Use Cases', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'student-outreach-communication' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Our Services', 'title' => 'Student Outreach & Communication']],
            'intro' => ['label' => 'Service Intro', 'fields' => $contentBlockFields, 'defaults' => []],
            'simplify' => ['label' => 'Simplify Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'cases' => ['label' => 'Use Cases', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'financial-aid-consulting' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Our Services', 'title' => 'Financial Aid Consulting & Operational Strategy']],
            'intro' => ['label' => 'Service Intro', 'fields' => $contentBlockFields, 'defaults' => []],
            'simplify' => ['label' => 'Simplify Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'cases' => ['label' => 'Use Cases', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'testimonials' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'FA Solutions', 'title' => 'Our Testimonials']],
            'testimonials' => ['label' => 'Testimonials', 'fields' => $contentBlockFields, 'defaults' => []],
            'silent_killers' => ['label' => 'Silent Killers', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'case-studies' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Case Studies', 'title' => 'Solving Challenges, Driving Results']],
            'main' => ['label' => 'Case Studies Content', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'blogs' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Resources', 'title' => 'Our Blogs']],
            'main' => ['label' => 'Blogs Content', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'fed-updates' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Resources', 'title' => 'Fed-Updates']],
            'main' => ['label' => 'Fed Updates Content', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'knowledge-nuggets' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'FAFSA Simplification', 'title' => 'Knowledge Nuggets']],
            'main' => ['label' => 'Knowledge Nuggets Content', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'white-paper-report' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Resources', 'title' => 'White Paper Reports']],
            'main' => ['label' => 'White Papers Content', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'webinar' => [
            'banner' => [
                'label' => 'Page Banner',
                'fields' => array_merge($bannerFields, [
                    'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                    'button_route' => ['type' => 'route', 'label' => 'Button Link'],
                ]),
                'defaults' => [
                    'label' => 'Webinars',
                    'title' => 'Sign Up to Stay Informed for Upcoming Webinars',
                    'button_text' => 'Sign Up',
                    'button_route' => 'get-started',
                ],
            ],
            'main' => [
                'label' => 'Webinar Page Intro',
                'description' => 'Heading and intro text at the top of the /webinar listing page.',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Section Title'],
                    'paragraph_1' => ['type' => 'textarea', 'label' => 'Intro Paragraph'],
                ],
                'defaults' => [
                    'title' => 'Access our previous Webinar Recorded Sessions here!',
                    'paragraph_1' => 'We are both dependable and responsive to our school partners, with the mutual goal of enhancing the overall student experience.',
                ],
            ],
            'sessions' => [
                'label' => 'Webinar Sessions',
                'description' => 'Use the list below: click Edit on a webinar, update the fields, then Done editing. Click Save Section when finished.',
                'fields' => [
                    'items' => [
                        'type' => 'repeater',
                        'label' => 'Webinars',
                        'fields' => [
                            'slug' => ['type' => 'text', 'label' => 'URL Slug (unique, e.g. successful-strategies-to-manage-hcm2)'],
                            'title' => ['type' => 'text', 'label' => 'Title'],
                            'summary' => ['type' => 'textarea', 'label' => 'Summary'],
                            'image' => ['type' => 'image', 'label' => 'Thumbnail Image'],
                            'video_url' => ['type' => 'url', 'label' => 'Video URL (YouTube — opens after registration)'],
                        ],
                    ],
                ],
                'defaults' => require __DIR__.'/page_defaults/webinar_sessions.php',
            ],
        ],

        'financial-aid-regulatory-and-compliance-checklist' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'Resources', 'title' => 'Stay Compliant, Stay Updated!']],
            'checklist' => ['label' => 'Checklist Content', 'fields' => $contentBlockFields, 'defaults' => []],
        ],

        'careers' => [
            'banner' => ['label' => 'Page Banner', 'fields' => $bannerFields, 'defaults' => ['label' => 'FA Careers', 'title' => 'Careers']],
            'culture' => ['label' => 'Culture Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'who' => ['label' => 'Who We Hire', 'fields' => $contentBlockFields, 'defaults' => []],
            'growth' => ['label' => 'Growth Section', 'fields' => $contentBlockFields, 'defaults' => []],
            'jobs' => ['label' => 'Open Positions', 'fields' => $contentBlockFields, 'defaults' => []],
            'eeo' => ['label' => 'EEO Statement', 'fields' => $contentBlockFields, 'defaults' => []],
            'faq' => ['label' => 'Careers FAQ', 'fields' => ['title' => ['type' => 'text', 'label' => 'Title'], 'items' => ['type' => 'repeater', 'label' => 'FAQ Items', 'fields' => ['question' => ['type' => 'text', 'label' => 'Question'], 'answer' => ['type' => 'textarea', 'label' => 'Answer']]]], 'defaults' => []],
        ],
    ],
];
