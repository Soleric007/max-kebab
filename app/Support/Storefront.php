<?php

namespace App\Support;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Throwable;

class Storefront
{
    private ?Collection $categoriesCache = null;

    private ?Collection $productsCache = null;

    public function brand(): array
    {
        return config('maxkebab.brand');
    }

    public function heroSlides(): Collection
    {
        return collect(config('maxkebab.hero_slides'));
    }

    public function categories(): Collection
    {
        if ($this->categoriesCache instanceof Collection) {
            return $this->categoriesCache;
        }

        if ($this->catalogTablesReady()) {
            return $this->categoriesCache = Category::query()
                ->active()
                ->ordered()
                ->withCount(['products as count' => fn ($query) => $query->where('is_active', true)])
                ->get()
                ->map(function (Category $category) {
                    return [
                        'id' => $category->id,
                        'slug' => $category->slug,
                        'name' => $category->name,
                        'icon' => $category->icon,
                        'description' => $category->description,
                        'count' => (int) $category->count,
                    ];
                });
        }

        $products = $this->products();

        return $this->categoriesCache = collect(config('maxkebab.categories', []))
            ->map(function (array $category) use ($products) {
                $category['count'] = $products->where('category', $category['slug'])->count();
                return $category;
            });
    }

    public function products(): Collection
    {
        if ($this->productsCache instanceof Collection) {
            return $this->productsCache;
        }

        if ($this->catalogTablesReady()) {
            return $this->productsCache = Product::query()
                ->with('category')
                ->active()
                ->ordered()
                ->get()
                ->map(fn (Product $product) => $this->mapProduct($product));
        }

        return $this->productsCache = collect(config('maxkebab.products', []))
            ->map(function (array $product) {
                $product['price_formatted'] = $this->money($product['price']);
                $product['compare_price_formatted'] = isset($product['compare_price'])
                    ? $this->money($product['compare_price'])
                    : null;

                return $product;
            });
    }

    public function featuredProducts(int $limit = 6): Collection
    {
        return $this->products()
            ->filter(fn (array $product) => ! empty($product['featured']))
            ->take($limit)
            ->values();
    }

    public function popularProducts(int $limit = 3): Collection
    {
        return $this->products()
            ->sortByDesc('review_count')
            ->sortByDesc('rating')
            ->take($limit)
            ->values();
    }

    public function productsByCategory(string $category): Collection
    {
        return $this->products()
            ->where('category', $category)
            ->values();
    }

    public function findProduct(string $slug): ?array
    {
        return $this->products()->firstWhere('slug', $slug);
    }

    public function relatedProducts(string $slug, int $limit = 6): Collection
    {
        $product = $this->findProduct($slug);

        if (! $product) {
            return collect();
        }

        return $this->products()
            ->where('category', $product['category'])
            ->where('slug', '!=', $slug)
            ->take($limit)
            ->values();
    }

    public function reviews(): Collection
    {
        return collect(config('maxkebab.reviews'));
    }

    public function cartItems(): Collection
    {
        return collect(Session::get('cart', []))
            ->map(function (array $item, string $key) {
                $slug = $item['slug'] ?? $this->cartSlug($key);
                $product = $this->findProduct($slug);

                if (! $product) {
                    return null;
                }

                $quantity = max(1, (int) ($item['quantity'] ?? 1));
                $selectedOption = $this->normalizeSelectedOption($product, $item['selected_option'] ?? null);

                return [
                    'key' => $key,
                    'slug' => $slug,
                    'product' => $product,
                    'selected_option' => $selectedOption,
                    'quantity' => $quantity,
                    'line_total' => round($product['price'] * $quantity, 2),
                    'line_total_formatted' => $this->money($product['price'] * $quantity),
                ];
            })
            ->filter()
            ->values();
    }

    public function cartCount(): int
    {
        return (int) $this->cartItems()->sum('quantity');
    }

    public function cartSubtotal(): float
    {
        return round((float) $this->cartItems()->sum('line_total'), 2);
    }

    public function wishlistItems(): Collection
    {
        return collect(Session::get('wishlist', []))
            ->map(fn (string $slug) => $this->findProduct($slug))
            ->filter()
            ->values();
    }

    public function wishlistCount(): int
    {
        return $this->wishlistItems()->count();
    }

    public function inWishlist(string $slug): bool
    {
        return in_array($slug, Session::get('wishlist', []), true);
    }

    public function addToCart(string $slug, int $quantity = 1, ?string $selectedOption = null): bool
    {
        $product = $this->findProduct($slug);

        if (! $product) {
            return false;
        }

        $selectedOption = $this->normalizeSelectedOption($product, $selectedOption);
        $cartKey = $this->cartKey($slug, $selectedOption);
        $cart = Session::get('cart', []);
        $currentQuantity = (int) ($cart[$cartKey]['quantity'] ?? 0);
        $cart[$cartKey] = [
            'slug' => $slug,
            'selected_option' => $selectedOption,
            'quantity' => max(1, $currentQuantity + $quantity),
        ];

        Session::put('cart', $cart);

        return true;
    }

    public function updateCart(string $key, int $quantity): bool
    {
        $cart = Session::get('cart', []);

        if (! array_key_exists($key, $cart)) {
            return false;
        }

        if ($quantity < 1) {
            return $this->removeFromCart($key);
        }

        $cart[$key]['quantity'] = $quantity;
        Session::put('cart', $cart);

        return true;
    }

    public function removeFromCart(string $key): bool
    {
        $cart = Session::get('cart', []);

        if (! array_key_exists($key, $cart)) {
            return false;
        }

        unset($cart[$key]);
        Session::put('cart', $cart);

        return true;
    }

    public function addToWishlist(string $slug): bool
    {
        $product = $this->findProduct($slug);

        if (! $product) {
            return false;
        }

        $wishlist = collect(Session::get('wishlist', []))
            ->push($slug)
            ->unique()
            ->values()
            ->all();

        Session::put('wishlist', $wishlist);

        return true;
    }

    public function removeFromWishlist(string $slug): bool
    {
        $wishlist = collect(Session::get('wishlist', []))
            ->reject(fn (string $item) => $item === $slug)
            ->values()
            ->all();

        Session::put('wishlist', $wishlist);

        return true;
    }

    public function clearCart(): void
    {
        Session::forget('cart');
    }

    public function money(float $amount): string
    {
        return '£'.number_format($amount, 2);
    }

    private function mapProduct(Product $product): array
    {
        $price = (float) $product->price;
        $comparePrice = $product->compare_price !== null ? (float) $product->compare_price : null;
        $categorySlug = $product->category?->slug ?? 'menu';

        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'sku' => $product->sku,
            'name' => $product->name,
            'category' => $categorySlug,
            'category_name' => $product->category?->name ?? Str::headline(str_replace('-', ' ', $categorySlug)),
            'price' => $price,
            'compare_price' => $comparePrice,
            'image' => $product->image,
            'gallery' => collect($product->gallery)->filter()->values()->all() ?: [$product->image],
            'badge' => $product->badge,
            'featured' => (bool) $product->featured,
            'rating' => (float) $product->rating,
            'review_count' => (int) $product->review_count,
            'options' => collect($product->options)->filter()->values()->all(),
            'description' => $product->description,
            'short_description' => $product->short_description,
            'price_formatted' => $this->money($price),
            'compare_price_formatted' => $comparePrice !== null ? $this->money($comparePrice) : null,
        ];
    }

    private function catalogTablesReady(): bool
    {
        try {
            return Schema::hasTable('categories')
                && Schema::hasTable('products')
                && Category::query()->exists()
                && Product::query()->exists();
        } catch (Throwable) {
            return false;
        }
    }

    private function normalizeSelectedOption(array $product, ?string $selectedOption): ?string
    {
        if (blank($selectedOption) || empty($product['options'])) {
            return null;
        }

        return collect($product['options'])
            ->first(fn (string $option) => strcasecmp($option, $selectedOption) === 0);
    }

    private function cartKey(string $slug, ?string $selectedOption): string
    {
        if (blank($selectedOption)) {
            return $slug;
        }

        return $slug.'~'.Str::slug($selectedOption);
    }

    private function cartSlug(string $key): string
    {
        return Str::before($key, '~');
    }
}
