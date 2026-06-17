<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(ProductCatalog $catalog): View
    {
        return view('index', [
            'products' => $catalog->featured(),
        ]);
    }
}
