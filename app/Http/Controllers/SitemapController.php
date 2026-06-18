<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(ProductCatalog $catalog): Response
    {
        $productEntries = $catalog->sitemapEntries();
        $catalogLastmod = $productEntries->max('lastmod') ?? now()->toDateString();

        $urls = collect([
            [
                'loc' => route('home'),
                'lastmod' => $catalogLastmod,
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('products.index'),
                'lastmod' => $catalogLastmod,
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'loc' => url('/pages/contact'),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
        ])->merge(
            $productEntries->map(fn (array $product) => [
                'loc' => route('products.show', $product['slug']),
                'lastmod' => $product['lastmod'],
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ])
        );

        $xml = view('seo.sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
