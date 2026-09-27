<?php

use App\Models\OurServicesCard;
use App\Models\OurServicesSetting;
use App\Models\OurServicesWhyItem;
use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_services_settings', function (Blueprint $table) {
            $table->id();
            $table->string('banner_label')->nullable();
            $table->string('banner_title')->nullable();
            $table->string('core_section_title')->nullable();
            $table->text('core_section_intro')->nullable();
            $table->string('why_section_title')->nullable();
            $table->string('why_cta_button_text')->nullable();
            $table->string('why_cta_button_route')->nullable();
            $table->timestamps();
        });

        Schema::create('our_services_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('title')->nullable();
            $table->text('intro')->nullable();
            $table->text('bullets')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_route')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('our_services_why_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->seedContent();
        $this->registerPageEditorEntry();
    }

    public function down(): void
    {
        Page::query()->where('slug', 'our-services')->delete();

        Schema::dropIfExists('our_services_why_items');
        Schema::dropIfExists('our_services_cards');
        Schema::dropIfExists('our_services_settings');
    }

    private function seedContent(): void
    {
        $seed = require config_path('page_defaults/our_services_seed.php');

        OurServicesSetting::query()->create($seed['settings']);

        foreach ($seed['cards'] as $index => $card) {
            OurServicesCard::query()->create([
                ...$card,
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }

        foreach ($seed['why_items'] as $index => $item) {
            OurServicesWhyItem::query()->create([
                ...$item,
                'sort_order' => $index,
                'is_active' => true,
            ]);
        }
    }

    private function registerPageEditorEntry(): void
    {
        $faqPage = Page::query()->where('slug', 'faq')->first();
        $sortOrder = $faqPage !== null ? $faqPage->sort_order + 1 : 60;

        Page::query()->updateOrCreate(
            ['slug' => 'our-services'],
            [
                'parent_id' => null,
                'title' => 'Our Services',
                'route_name' => 'our-services',
                'is_group' => false,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]
        );
    }
};
