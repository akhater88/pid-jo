<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = ['title', 'slug', 'blocks', 'seo_title', 'seo_description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'blocks',
        'seo_title',
        'seo_description',
        'published_at',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'array',
            'slug' => 'array',
            'blocks' => 'array',
            'seo_title' => 'array',
            'seo_description' => 'array',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include published pages.
     *
     * @param  Builder<Page>  $query
     * @return Builder<Page>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to order by sort_order then created_at.
     *
     * @param  Builder<Page>  $query
     * @return Builder<Page>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Get the rendered blocks for the current locale.
     *
     * @return array<int, array{type: string, data: array<string, mixed>}>
     */
    public function getRenderedBlocks(): array
    {
        return $this->getTranslation('blocks', app()->getLocale(), false) ?? [];
    }

    /**
     * Check if the page is published.
     */
    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }
}
