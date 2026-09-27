<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FaqItem extends Model
{
    public const CACHE_KEY = 'faq.items';

    protected $fillable = [
        'sort_order',
        'question',
        'answer',
        'bullets',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public static function activeOrdered(): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
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
