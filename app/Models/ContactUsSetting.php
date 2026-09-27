<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContactUsSetting extends Model
{
    public const CACHE_KEY = 'contact_us.settings';

    protected $fillable = [
        'banner_label',
        'banner_title',
        'submit_button_text',
        'placeholder_first_name',
        'placeholder_last_name',
        'placeholder_email',
        'placeholder_phone',
        'placeholder_job_title',
        'placeholder_institution',
        'placeholder_message',
        'social_section_title',
    ];

    public static function current(): self
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            $settings = static::query()->first();

            if ($settings === null) {
                $settings = static::query()->create(static::defaults());
            }

            return $settings;
        });
    }

    public static function defaults(): array
    {
        $form = require config_path('page_defaults/contact_us_form.php');

        return [
            'banner_label' => 'FA Solutions',
            'banner_title' => 'Send Us A Message',
            'social_section_title' => 'Stay Connected',
            ...$form,
        ];
    }

    public static function refreshCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    protected static function booted(): void
    {
        static::saved(fn () => self::refreshCache());
        static::deleted(fn () => self::refreshCache());
    }
}
