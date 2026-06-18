<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class ProductCatalog
{
    public function featured(int $limit = 4): Collection
    {
        return $this->all()->take($limit)->values();
    }

    public function all(): Collection
    {
        if ($this->shouldUseDatabase()) {
            return Product::query()
                ->active()
                ->ordered()
                ->get()
                ->map(fn (Product $product) => $product->toPublicArray())
                ->values();
        }

        return collect(config('products.items', []))
            ->values()
            ->map(fn (array $product) => $product);
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->all()->firstWhere('slug', $slug);
    }

    public function related(string $slug, int $limit = 3): Collection
    {
        return $this->all()
            ->reject(fn (array $product) => $product['slug'] === $slug)
            ->take($limit)
            ->values();
    }

    public function sitemapEntries(): Collection
    {
        if ($this->shouldUseDatabase()) {
            return Product::query()
                ->active()
                ->ordered()
                ->get(['slug', 'updated_at'])
                ->map(fn (Product $product) => [
                    'slug' => $product->slug,
                    'lastmod' => optional($product->updated_at)->toDateString() ?? now()->toDateString(),
                ])
                ->values();
        }

        $lastmod = now()->toDateString();

        return collect(config('products.items', []))
            ->map(fn (array $product) => [
                'slug' => $product['slug'],
                'lastmod' => $lastmod,
            ])
            ->values();
    }

    protected function shouldUseDatabase(): bool
    {
        return Schema::hasTable('products') && Product::query()->exists();
    }
}
