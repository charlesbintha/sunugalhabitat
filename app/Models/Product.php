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
        'gallery_images',
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
            'gallery_images' => 'array',
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
        $heroImage = $this->hero_image ?: '/img/all-images/property/property-img4.png';
        $cardImage = $this->card_image ?: $heroImage;
        $galleryImages = $this->galleryImages();

        if ($galleryImages === []) {
            $galleryImages = [$heroImage];
        }

        $galleryImage1 = $galleryImages[0] ?? $heroImage;
        $galleryImage2 = $galleryImages[1] ?? $galleryImage1;

        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'type' => $this->type,
            'location' => $this->location,
            'price' => $this->price,
            'surface' => $this->surface ?: 'A confirmer',
            'beds' => $this->beds,
            'baths' => $this->baths ?: 'A confirmer',
            'hero_image' => $heroImage,
            'card_image' => $cardImage,
            'gallery_image_1' => $galleryImage1,
            'gallery_image_2' => $galleryImage2,
            'gallery_images' => $galleryImages,
            'summary' => $this->summary,
            'description_1' => $this->description_1,
            'description_2' => $this->description_2,
            'amenities_title' => $this->amenities_title,
            'amenities_text' => $this->amenities_text,
            'amenities' => $this->amenities ?? [],
        ];
    }

    public function galleryImages(): array
    {
        $galleryImages = collect($this->gallery_images ?? [])
            ->filter(fn ($image) => filled($image))
            ->values();

        if ($galleryImages->isEmpty()) {
            $galleryImages = collect([$this->gallery_image_1, $this->gallery_image_2])
                ->filter(fn ($image) => filled($image))
                ->unique()
                ->values();
        }

        return $galleryImages->all();
    }
}
