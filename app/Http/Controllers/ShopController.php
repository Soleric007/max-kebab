<?php

namespace App\Http\Controllers;

use App\Support\Storefront;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function __construct(private readonly Storefront $storefront)
    {
    }

    public function index(Request $request): View
    {
        $products = $this->storefront->products();

        if ($request->filled('category')) {
            $products = $products->where('category', $request->string('category')->toString());
        }

        if ($request->filled('search')) {
            $search = strtolower($request->string('search')->toString());
            $products = $products->filter(function (array $product) use ($search) {
                return str_contains(strtolower($product['name']), $search)
                    || str_contains(strtolower($product['category_name']), $search)
                    || str_contains(strtolower($product['description']), $search);
            });
        }

        $sort = $request->string('sort', 'popular')->toString();

        $products = (match ($sort) {
            'lowtohigh' => $products->sortBy('price'),
            'hightolow' => $products->sortByDesc('price'),
            default => $products->sortByDesc('featured')->sortByDesc('rating'),
        })->values();

        return view('pages.shop', [
            'showCta' => false,
            'products' => $products,
            'categories' => $this->storefront->categories(),
            'popularProducts' => $this->storefront->popularProducts(),
            'filters' => $request->only(['category', 'search', 'sort']),
        ]);
    }

    public function show(string $slug): View
    {
        $product = $this->storefront->findProduct($slug);

        abort_if(! $product, 404);

        return view('pages.product', [
            'product' => $product,
            'relatedProducts' => $this->storefront->relatedProducts($slug),
            'reviews' => $this->storefront->reviews()->take(3),
        ]);
    }
}
