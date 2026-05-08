<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class StorefrontSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect(config('maxkebab.categories', []));
        $products = collect(config('maxkebab.products', []));

        $categoryMap = $categories->mapWithKeys(function (array $category, int $index) {
            $model = Category::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'icon' => $category['icon'] ?? null,
                    'description' => $category['description'] ?? null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );

            return [$category['slug'] => $model->id];
        });

        $products->each(function (array $product, int $index) use ($categoryMap) {
            $categoryId = $categoryMap->get($product['category']);

            if (! $categoryId) {
                return;
            }

            Product::updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'category_id' => $categoryId,
                    'name' => $product['name'],
                    'sku' => $product['sku'],
                    'price' => $product['price'],
                    'compare_price' => $product['compare_price'] ?? null,
                    'image' => $product['image'],
                    'gallery' => $product['gallery'] ?? [$product['image']],
                    'badge' => $product['badge'] ?? null,
                    'featured' => (bool) ($product['featured'] ?? false),
                    'rating' => $product['rating'] ?? 5,
                    'review_count' => $product['review_count'] ?? 0,
                    'options' => $product['options'] ?? [],
                    'description' => $product['description'],
                    'short_description' => $product['short_description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        });

        if ($categories->isNotEmpty()) {
            Category::query()
                ->whereNotIn('slug', $categories->pluck('slug'))
                ->update(['is_active' => false]);
        }

        if ($products->isNotEmpty()) {
            Product::query()
                ->whereNotIn('slug', $products->pluck('slug'))
                ->update(['is_active' => false]);
        }
    }
}
