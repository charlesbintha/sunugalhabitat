<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        foreach (array_values(config('products.items', [])) as $index => $product) {
            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'title' => $product['title'],
                    'type' => $product['type'],
                    'location' => $product['location'],
                    'price' => $product['price'],
                    'surface' => $product['surface'],
                    'beds' => $product['beds'],
                    'baths' => $product['baths'],
                    'hero_image' => $product['hero_image'],
                    'card_image' => $product['card_image'],
                    'gallery_image_1' => $product['gallery_image_1'],
                    'gallery_image_2' => $product['gallery_image_2'],
                    'summary' => $product['summary'],
                    'description_1' => $product['description_1'],
                    'description_2' => $product['description_2'],
                    'amenities_title' => $product['amenities_title'],
                    'amenities_text' => $product['amenities_text'],
                    'amenities' => $product['amenities'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }
    }
}
