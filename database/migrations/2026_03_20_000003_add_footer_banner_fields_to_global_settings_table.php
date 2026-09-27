<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->string('footer_cta_title')->nullable()->after('copyright_text');
            $table->text('footer_cta_text')->nullable()->after('footer_cta_title');
            $table->string('footer_newsletter_title')->nullable()->after('footer_cta_text');
            $table->text('footer_newsletter_text')->nullable()->after('footer_newsletter_title');
            $table->string('footer_newsletter_button_text')->nullable()->after('footer_newsletter_text');
        });
    }

    public function down(): void
    {
        Schema::table('global_settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_cta_title',
                'footer_cta_text',
                'footer_newsletter_title',
                'footer_newsletter_text',
                'footer_newsletter_button_text',
            ]);
        });
    }
};
