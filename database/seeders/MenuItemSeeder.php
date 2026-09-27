<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::query()->delete();

        $menus = [
            ['title' => 'Home', 'route_name' => 'home'],
            [
                'title' => 'About',
                'custom_url' => '#',
                'children' => [
                    ['title' => 'Who We Are', 'route_name' => 'who-we-are'],
                    ['title' => 'Leadership Team', 'route_name' => 'team'],
                    ['title' => 'Current Clients', 'route_name' => 'who-we-are', 'url_fragment' => 'current-clients'],
                    ['title' => 'Frequently Asked Questions', 'route_name' => 'who-we-are', 'url_fragment' => 'faqs'],
                    ['title' => 'Careers', 'route_name' => 'careers'],
                    ['title' => 'Our Partnership', 'route_name' => 'our-partnership'],
                    ['title' => 'Get Started', 'route_name' => 'get-started'],
                ],
            ],
            [
                'title' => 'Our Services',
                'custom_url' => '#',
                'children' => [
                    ['title' => 'Financial Aid Processing & Compliance', 'route_name' => 'financial-aid-processing'],
                    ['title' => 'Financial Aid Staffing', 'route_name' => 'financial-aid-staffing'],
                    ['title' => 'Student Outreach & Communication', 'route_name' => 'student-outreach-communication'],
                    ['title' => 'Financial Aid Consulting & Operational Strategy', 'route_name' => 'financial-aid-consulting'],
                    ['title' => 'Get Started', 'route_name' => 'get-started'],
                ],
            ],
            ['title' => 'Testimonials', 'route_name' => 'testimonials'],
            [
                'title' => 'Resources',
                'custom_url' => '#',
                'children' => [
                    ['title' => 'Case Studies', 'route_name' => 'case-studies'],
                    ['title' => "FAQ's", 'route_name' => 'faq'],
                    ['title' => 'Blogs', 'route_name' => 'blogs'],
                    ['title' => 'Fed-Updates', 'route_name' => 'fed-updates'],
                    ['title' => 'Knowledge Nuggets', 'route_name' => 'knowledge-nuggets'],
                    ['title' => 'White Paper Report', 'route_name' => 'white-paper-report'],
                    ['title' => 'Events', 'route_name' => 'webinar'],
                    ['title' => 'Financial Aid Regulatory and Compliance Checklist', 'route_name' => 'financial-aid-regulatory-and-compliance-checklist'],
                ],
            ],
            ['title' => 'Get Started', 'route_name' => 'get-started'],
        ];

        foreach ($menus as $index => $menu) {
            $this->createItem($menu, null, $index + 1);
        }

        MenuItem::refreshCache();
    }

    private function createItem(array $data, ?int $parentId, int $sortOrder): void
    {
        $children = $data['children'] ?? [];
        unset($data['children']);

        $item = MenuItem::create([
            ...$data,
            'parent_id' => $parentId,
            'sort_order' => $sortOrder,
            'is_active' => true,
        ]);

        foreach ($children as $childIndex => $child) {
            $this->createItem($child, $item->id, $childIndex + 1);
        }
    }
}
