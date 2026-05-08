<?php

namespace App\Support;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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
            ->map(fn (array $product) => $this->enrichProduct($product));
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
                $selectedOptionData = $this->selectedOptionData($product, $selectedOption);
                $unitPrice = $selectedOptionData['price'] ?? $product['price'];

                return [
                    'key' => $key,
                    'slug' => $slug,
                    'product' => $product,
                    'selected_option' => $selectedOption,
                    'selected_option_label' => $selectedOptionData['label'] ?? null,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'unit_price_formatted' => $this->money($unitPrice),
                    'line_total' => round($unitPrice * $quantity, 2),
                    'line_total_formatted' => $this->money($unitPrice * $quantity),
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
        $categorySlug = $product->category?->slug ?? 'menu';

        return $this->enrichProduct([
            'id' => $product->id,
            'slug' => $product->slug,
            'sku' => $product->sku,
            'name' => $product->name,
            'category' => $categorySlug,
            'category_name' => $product->category?->name ?? Str::headline(str_replace('-', ' ', $categorySlug)),
            'price' => (float) $product->price,
            'compare_price' => $product->compare_price !== null ? (float) $product->compare_price : null,
            'image' => $product->image,
            'gallery' => $product->gallery ?? [$product->image],
            'badge' => $product->badge,
            'featured' => (bool) $product->featured,
            'rating' => (float) $product->rating,
            'review_count' => (int) $product->review_count,
            'options' => $product->options ?? [],
            'description' => $product->description,
            'short_description' => $product->short_description,
        ]);
    }

    private function enrichProduct(array $product): array
    {
        $categorySlug = $product['category'] ?? 'menu';
        $image = $product['image'] ?? null;
        $gallery = collect($product['gallery'] ?? [$image])
            ->filter()
            ->values()
            ->all();
        $price = isset($product['price']) ? round((float) $product['price'], 2) : 0.0;
        $comparePrice = array_key_exists('compare_price', $product) && $product['compare_price'] !== null
            ? round((float) $product['compare_price'], 2)
            : null;
        $options = $this->normalizeOptions($product['options'] ?? [], $price);
        $optionPrices = collect($options)
            ->pluck('price')
            ->filter(fn ($optionPrice) => $optionPrice !== null)
            ->map(fn ($optionPrice) => round((float) $optionPrice, 2))
            ->values();

        if ($optionPrices->isNotEmpty()) {
            $price = (float) $optionPrices->min();
        }

        $priceMax = $optionPrices->isNotEmpty()
            ? (float) $optionPrices->max()
            : $price;
        $hasVariablePricing = $optionPrices->unique()->count() > 1;

        return [
            'id' => $product['id'] ?? null,
            'slug' => $product['slug'],
            'sku' => $product['sku'] ?? null,
            'name' => $product['name'],
            'category' => $categorySlug,
            'category_name' => $product['category_name'] ?? Str::headline(str_replace('-', ' ', $categorySlug)),
            'price' => $price,
            'price_max' => $priceMax,
            'compare_price' => $comparePrice,
            'image' => $image ?: ($gallery[0] ?? ''),
            'gallery' => $gallery ?: [$image],
            'badge' => $product['badge'] ?? null,
            'featured' => (bool) ($product['featured'] ?? false),
            'rating' => isset($product['rating']) ? (float) $product['rating'] : 5.0,
            'review_count' => (int) ($product['review_count'] ?? 0),
            'options' => $options,
            'default_option' => $options[0]['value'] ?? null,
            'has_variable_pricing' => $hasVariablePricing,
            'description' => $product['description'] ?? '',
            'short_description' => $product['short_description'] ?? '',
            'price_formatted' => $this->money($price),
            'price_display' => $hasVariablePricing ? 'From '.$this->money($price) : $this->money($price),
            'compare_price_formatted' => $comparePrice !== null ? $this->money($comparePrice) : null,
        ];
    }

    private function normalizeOptions(array $options, float $fallbackPrice): array
    {
        return collect($options)
            ->map(function ($option) use ($fallbackPrice) {
                if (is_array($option)) {
                    $label = trim((string) ($option['label'] ?? $option['value'] ?? $option['name'] ?? ''));
                    $value = trim((string) ($option['value'] ?? $label));
                    $price = array_key_exists('price', $option) && $option['price'] !== null
                        ? round((float) $option['price'], 2)
                        : $fallbackPrice;
                    $explicitPrice = array_key_exists('price', $option) && $option['price'] !== null;
                } else {
                    $label = trim((string) $option);
                    $value = $label;
                    $price = $fallbackPrice;
                    $explicitPrice = false;
                }

                if ($label === '') {
                    return null;
                }

                return [
                    'label' => $label,
                    'value' => $value !== '' ? $value : $label,
                    'price' => $price,
                    'price_formatted' => $this->money($price),
                    'display' => $explicitPrice ? $label.' - '.$this->money($price) : $label,
                ];
            })
            ->filter()
            ->values()
            ->all();
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
        if (empty($product['options'])) {
            return null;
        }

        return $this->selectedOptionData($product, $selectedOption)['value'] ?? null;
    }

    private function selectedOptionData(array $product, ?string $selectedOption): ?array
    {
        if (empty($product['options'])) {
            return null;
        }

        $optionValue = blank($selectedOption)
            ? ($product['default_option'] ?? null)
            : $selectedOption;

        $matchedOption = collect($product['options'])->first(function (array $option) use ($optionValue) {
            return strcasecmp((string) $option['value'], (string) $optionValue) === 0
                || strcasecmp((string) $option['label'], (string) $optionValue) === 0;
        });

        if ($matchedOption) {
            return $matchedOption;
        }

        return $product['options'][0] ?? null;
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
