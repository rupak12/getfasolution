<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FaqSetting extends Model
{
    public const CACHE_KEY = 'faq.settings';

    protected $fillable = [
        'banner_label',
        'banner_title',
        'intro_title',
        'intro_paragraph',
        'intro_button_text',
        'intro_button_route',
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
        $intro = require config_path('page_defaults/faq_intro.php');

        return [
            'banner_label' => 'FA Solutions',
            'banner_title' => 'Frequently Asked Questions',
            'intro_title' => $intro['title'] ?? null,
            'intro_paragraph' => $intro['paragraph_1'] ?? null,
            'intro_button_text' => $intro['button_text'] ?? null,
            'intro_button_route' => $intro['button_route'] ?? null,
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
