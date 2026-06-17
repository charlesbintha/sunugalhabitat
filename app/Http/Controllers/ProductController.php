<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(ProductCatalog $catalog): View
    {
        return view('products.index', [
            'products' => $catalog->all(),
        ]);
    }

    public function show(string $slug, ProductCatalog $catalog): View
    {
        $product = $catalog->findBySlug($slug);
        abort_unless($product, 404);

        return view('products.show', [
            'product' => $product,
            'products' => $catalog->related($slug),
        ]);
    }
}
