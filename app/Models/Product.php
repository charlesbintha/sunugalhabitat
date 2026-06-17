<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'type',
        'location',
        'price',
        'surface',
        'beds',
        'baths',
        'hero_image',
        'card_image',
        'gallery_image_1',
        'gallery_image_2',
        'summary',
        'description_1',
        'description_2',
        'amenities_title',
        'amenities_text',
        'amenities',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'amenities' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    public function toPublicArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'type' => $this->type,
            'location' => $this->location,
            'price' => $this->price,
            'surface' => $this->surface,
            'beds' => $this->beds,
            'baths' => $this->baths,
            'hero_image' => $this->hero_image,
            'card_image' => $this->card_image,
            'gallery_image_1' => $this->gallery_image_1,
            'gallery_image_2' => $this->gallery_image_2,
            'summary' => $this->summary,
            'description_1' => $this->description_1,
            'description_2' => $this->description_2,
            'amenities_title' => $this->amenities_title,
            'amenities_text' => $this->amenities_text,
            'amenities' => $this->amenities ?? [],
        ];
    }
}
