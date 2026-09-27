<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hubspot_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_enabled')->default(false);
            $table->string('portal_id')->nullable();
            $table->uuid('contact_form_guid')->nullable();
            $table->uuid('newsletter_form_guid')->nullable();
            $table->text('private_app_access_token')->nullable();
            $table->timestamp('connection_verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hubspot_settings');
    }
};
