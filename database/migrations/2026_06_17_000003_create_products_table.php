<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type');
            $table->string('location');
            $table->string('price')->default('Sur demande');
            $table->string('surface');
            $table->string('beds', 50);
            $table->string('baths', 50);
            $table->string('hero_image')->nullable();
            $table->string('card_image')->nullable();
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->text('summary');
            $table->text('description_1');
            $table->text('description_2');
            $table->string('amenities_title')->default('Atouts du produit');
            $table->text('amenities_text');
            $table->json('amenities');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
