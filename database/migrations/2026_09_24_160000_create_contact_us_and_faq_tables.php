<?php

use App\Models\ContactUsSetting;
use App\Models\ContactUsSocialCard;
use App\Models\FaqItem;
use App\Models\FaqSetting;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_us_settings', function (Blueprint $table) {
            $table->id();
            $table->string('banner_label')->nullable();
            $table->string('banner_title')->nullable();
            $table->string('submit_button_text')->default('Submit');
            $table->string('placeholder_first_name')->nullable();
            $table->string('placeholder_last_name')->nullable();
            $table->string('placeholder_email')->nullable();
            $table->string('placeholder_phone')->nullable();
            $table->string('placeholder_job_title')->nullable();
            $table->string('placeholder_institution')->nullable();
            $table->string('placeholder_message')->nullable();
            $table->string('social_section_title')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_us_social_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('faq_settings', function (Blueprint $table) {
            $table->id();
            $table->string('banner_label')->nullable();
            $table->string('banner_title')->nullable();
            $table->string('intro_title')->nullable();
            $table->text('intro_paragraph')->nullable();
            $table->string('intro_button_text')->nullable();
            $table->string('intro_button_route')->nullable();
            $table->timestamps();
        });

        Schema::create('faq_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('question');
            $table->text('answer')->nullable();
            $table->text('bullets')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->migrateFromPageSections();

        foreach (['contact-us', 'faq'] as $slug) {
            $page = Page::query()->where('slug', $slug)->first();

            if ($page !== null) {
                PageSection::query()->where('page_id', $page->id)->delete();
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_items');
        Schema::dropIfExists('faq_settings');
        Schema::dropIfExists('contact_us_social_cards');
        Schema::dropIfExists('contact_us_settings');
    }

    private function migrateFromPageSections(): void
    {
        $contactFormDefaults = require config_path('page_defaults/contact_us_form.php');
        $contactSocialDefaults = require config_path('page_defaults/contact_us_social.php');
        $faqIntroDefaults = require config_path('page_defaults/faq_intro.php');
        $faqItemsDefaults = require config_path('page_defaults/faq_page_items.php');

        $contactBanner = $this->sectionContent('contact-us', 'banner') ?? [
            'label' => 'FA Solutions',
            'title' => 'Send Us A Message',
        ];
        $contactForm = $this->sectionContent('contact-us', 'form') ?? $contactFormDefaults;
        $contactSocial = $this->sectionContent('contact-us', 'social') ?? $contactSocialDefaults;

        ContactUsSetting::query()->create([
            'banner_label' => $contactBanner['label'] ?? 'FA Solutions',
            'banner_title' => $contactBanner['title'] ?? 'Send Us A Message',
            'submit_button_text' => $contactForm['submit_button_text'] ?? 'Submit',
            'placeholder_first_name' => $contactForm['placeholder_first_name'] ?? null,
            'placeholder_last_name' => $contactForm['placeholder_last_name'] ?? null,
            'placeholder_email' => $contactForm['placeholder_email'] ?? null,
            'placeholder_phone' => $contactForm['placeholder_phone'] ?? null,
            'placeholder_job_title' => $contactForm['placeholder_job_title'] ?? null,
            'placeholder_institution' => $contactForm['placeholder_institution'] ?? null,
            'placeholder_message' => $contactForm['placeholder_message'] ?? null,
            'social_section_title' => $contactSocial['title'] ?? 'Stay Connected',
        ]);

        foreach ($contactSocial['items'] ?? [] as $index => $card) {
            ContactUsSocialCard::query()->create([
                'sort_order' => $index,
                'image' => $card['image'] ?? null,
                'title' => $card['title'] ?? null,
                'url' => $card['url'] ?? null,
                'is_active' => true,
            ]);
        }

        $faqBanner = $this->sectionContent('faq', 'banner') ?? [
            'label' => 'FA Solutions',
            'title' => 'Frequently Asked Questions',
        ];
        $faqIntro = $this->sectionContent('faq', 'intro') ?? $faqIntroDefaults;
        $faqItems = $this->sectionContent('faq', 'items') ?? $faqItemsDefaults;

        FaqSetting::query()->create([
            'banner_label' => $faqBanner['label'] ?? 'FA Solutions',
            'banner_title' => $faqBanner['title'] ?? 'Frequently Asked Questions',
            'intro_title' => $faqIntro['title'] ?? null,
            'intro_paragraph' => $faqIntro['paragraph_1'] ?? null,
            'intro_button_text' => $faqIntro['button_text'] ?? null,
            'intro_button_route' => $faqIntro['button_route'] ?? null,
        ]);

        foreach ($faqItems['items'] ?? [] as $index => $item) {
            FaqItem::query()->create([
                'sort_order' => $index,
                'question' => $item['question'] ?? '',
                'answer' => $item['answer'] ?? null,
                'bullets' => $item['bullets'] ?? null,
                'is_active' => true,
            ]);
        }
    }

    private function sectionContent(string $pageSlug, string $key): ?array
    {
        $page = Page::query()->where('slug', $pageSlug)->first();

        if ($page === null) {
            return null;
        }

        $section = PageSection::query()
            ->where('page_id', $page->id)
            ->where('key', $key)
            ->first();

        $content = $section?->content;

        return is_array($content) && $content !== [] ? $content : null;
    }
};
