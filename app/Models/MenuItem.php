<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class MenuItem extends Model
{
    public const CACHE_KEY = 'header_menu_items';

    protected $fillable = [
        'parent_id',
        'title',
        'route_name',
        'url_fragment',
        'custom_url',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function activeChildren(): HasMany
    {
        return $this->children()->where('is_active', true);
    }

    public function resolvedUrl(): string
    {
        if ($this->route_name && Route::has($this->route_name)) {
            $url = route($this->route_name);

            if ($this->url_fragment) {
                $url .= '#'.ltrim($this->url_fragment, '#');
            }

            return $url;
        }

        return $this->custom_url ?? '#';
    }

    public function isDropdown(): bool
    {
        return $this->relationLoaded('activeChildren')
            ? $this->activeChildren->isNotEmpty()
            : $this->activeChildren()->exists();
    }

    public function activeClass(string $currentPage): string
    {
        if ($this->route_name && $this->route_name === $currentPage) {
            return 'active';
        }

        if ($this->isDropdown()) {
            $children = $this->relationLoaded('activeChildren')
                ? $this->activeChildren
                : $this->activeChildren()->get();

            foreach ($children as $child) {
                if ($child->route_name === $currentPage) {
                    return 'active';
                }
            }
        }

        return '';
    }

    public static function headerTree(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::query()
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->with(['activeChildren' => fn ($query) => $query->orderBy('sort_order')])
                ->get();
        });
    }

    public static function adminTree(): Collection
    {
        return static::query()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->with(['children' => fn ($query) => $query->orderBy('sort_order')])
            ->get();
    }

    public static function refreshCache(): Collection
    {
        Cache::forget(self::CACHE_KEY);

        return static::headerTree();
    }
}
