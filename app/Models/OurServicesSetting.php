<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class OurServicesSetting extends Model
{
    public const CACHE_KEY = 'our_services.settings';

    protected $fillable = [
        'banner_label',
        'banner_title',
        'core_section_title',
        'core_section_intro',
        'why_section_title',
        'why_cta_button_text',
        'why_cta_button_route',
    ];

    public static function current(): self
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            $settings = static::query()->first();

            if ($settings === null) {
                $defaults = (require config_path('page_defaults/our_services_seed.php'))['settings'];
                $settings = static::query()->create($defaults);
            }

            return $settings;
        });
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
