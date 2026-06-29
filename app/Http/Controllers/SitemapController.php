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

        $xml = $this->buildSitemapXml($urls->all());

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    protected function buildSitemapXml(array $urls): string
    {
        $lines = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
        ];

        foreach ($urls as $url) {
            $lines[] = '  <url>';
            $lines[] = '    <loc>'.$this->escapeXml($url['loc']).'</loc>';
            $lines[] = '    <lastmod>'.$this->escapeXml($url['lastmod']).'</lastmod>';
            $lines[] = '    <changefreq>'.$this->escapeXml($url['changefreq']).'</changefreq>';
            $lines[] = '    <priority>'.$this->escapeXml($url['priority']).'</priority>';
            $lines[] = '  </url>';
        }

        $lines[] = '</urlset>';

        return implode("\n", $lines);
    }

    protected function escapeXml(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
