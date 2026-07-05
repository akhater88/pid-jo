<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class GalleryImage extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The attributes that are translatable.
     */
    public array $translatable = ['title', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'show_in_footer',
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
            'description' => 'array',
            'show_in_footer' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->format('webp');

        $this->addMediaConversion('card')
            ->width(800)
            ->format('webp');

        $this->addMediaConversion('hero')
            ->width(1920)
            ->format('webp');

        $this->addMediaConversion('medium')
            ->width(800)
            ->format('webp');

        $this->addMediaConversion('large')
            ->width(1920)
            ->format('webp');
    }

    /**
     * Scope a query to only include published gallery images.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include footer gallery images.
     */
    public function scopeFooter(Builder $query): Builder
    {
        return $query->where('show_in_footer', true);
    }

    /**
     * Scope a query to order by sort_order then created_at.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Check if the gallery image is published.
     */
    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }
}
