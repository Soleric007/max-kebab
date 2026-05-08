<?php

namespace App\Http\Controllers;

use App\Support\Storefront;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class SitemapController extends Controller
{
    public function __invoke(Storefront $storefront): Response
    {
        $urls = collect([
            route('home'),
            route('menu'),
            route('shop.index'),
            route('about'),
            route('contact'),
        ])->merge(
            $storefront->products()->map(fn (array $product) => route('shop.show', $product['slug']))
        );

        $xml = $this->buildXml($urls);

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    private function buildXml(Collection $urls): string
    {
        $entries = $urls
            ->map(function (string $url) {
                $escaped = htmlspecialchars($url, ENT_XML1 | ENT_COMPAT, 'UTF-8');

                return "    <url>\n        <loc>{$escaped}</loc>\n    </url>";
            })
            ->implode("\n");

        return <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
{$entries}
</urlset>
XML;
    }
}
