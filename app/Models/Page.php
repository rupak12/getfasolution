<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'route_name',
        'is_group',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_group' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public static function tree(): \Illuminate\Database\Eloquent\Collection
    {
        return static::query()
            ->with(['children.sections', 'children.children.sections', 'sections'])
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();
    }

    public function sectionSchema(string $key): ?array
    {
        return config("page_sections.sections.{$this->slug}.{$key}");
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function editorSectionCount(): int
    {
        return match ($this->slug) {
            'contact-us', 'faq' => 2,
            'our-services' => 4,
            default => $this->sections->count(),
        };
    }

    public function breadcrumb(): array
    {
        $trail = collect([$this]);
        $current = $this;

        while ($current->parent_id) {
            $current = static::query()->find($current->parent_id);

            if ($current === null) {
                break;
            }

            $trail->prepend($current);
        }

        return $trail->all();
    }
}
