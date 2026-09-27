<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'key',
        'content',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function schema(): ?array
    {
        return $this->page?->sectionSchema($this->key);
    }

    public function label(): string
    {
        return $this->schema()['label'] ?? ucwords(str_replace('_', ' ', $this->key));
    }

    public function mergedContent(): array
    {
        $defaults = $this->schema()['defaults'] ?? [];

        return array_replace_recursive($defaults, $this->content ?? []);
    }
}
