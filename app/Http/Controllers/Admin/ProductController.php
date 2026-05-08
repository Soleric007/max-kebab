<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), fn ($query) => $query->where('category_id', $request->integer('category')))
            ->when($request->filled('status'), fn ($query) => $query->where('is_active', $request->string('status')->toString() === 'active'))
            ->ordered()
            ->get();

        return view('admin.pages.products.index', [
            'products' => $products,
            'categories' => Category::query()->ordered()->get(),
            'filters' => $request->only(['search', 'category', 'status']),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.products.create', [
            'product' => new Product(),
            'categories' => Category::query()->ordered()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        Product::create($this->payload($validated, $request));

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('admin.pages.products.edit', [
            'product' => $product,
            'categories' => Category::query()->ordered()->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateProduct($request, $product);
        $payload = $this->payload($validated, $request, $product);
        $managedAssets = $this->managedAssets($product);

        $product->update($payload);
        $this->deleteManagedAssets($managedAssets->diff($this->managedAssetsFromPayload($payload)));

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteManagedAssets($this->managedAssets($product));
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product?->id)],
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('products', 'sku')->ignore($product?->id)],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'badge' => ['nullable', 'string', 'max:80'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
            'short_description' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'gallery_input' => ['nullable', 'string', 'max:4000'],
            'gallery_files' => ['nullable', 'array', 'max:8'],
            'gallery_files.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'options_input' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validator->after(function ($validator) use ($request, $product) {
            $manualImage = trim((string) $request->input('image'));

            if ($request->hasFile('image_file') || filled($manualImage) || filled($product?->image)) {
                return;
            }

            $validator->errors()->add('image', 'Please upload a main image or enter an asset path.');
        });

        return $validator->validate();
    }

    private function payload(array $validated, Request $request, ?Product $product = null): array
    {
        $slug = $validated['slug'] ?: $this->uniqueSlug($validated['name'], $product);
        $sku = $validated['sku'] ?: $this->uniqueSku($product);
        $primaryImage = $this->resolvePrimaryImage($validated, $request, $product);
        $uploadedGallery = collect($request->file('gallery_files', []))
            ->map(fn (UploadedFile $file) => $this->storeUploadedImage($file));
        $gallery = collect([$primaryImage])
            ->filter()
            ->concat($uploadedGallery)
            ->concat($this->parseList($validated['gallery_input'] ?? null))
            ->unique()
            ->values();

        return [
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $sku,
            'price' => $validated['price'],
            'compare_price' => $validated['compare_price'] ?? null,
            'image' => $primaryImage,
            'gallery' => $gallery->isNotEmpty() ? $gallery->all() : [$primaryImage],
            'badge' => $validated['badge'] ?? null,
            'featured' => $request->boolean('featured'),
            'rating' => $validated['rating'] ?? 5,
            'review_count' => $validated['review_count'] ?? 0,
            'options' => $this->parseList($validated['options_input'] ?? null)->all(),
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];
    }

    private function parseList(?string $value): Collection
    {
        return collect(preg_split('/[\r\n,]+/', (string) $value))
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->values();
    }

    private function resolvePrimaryImage(array $validated, Request $request, ?Product $product = null): string
    {
        if ($request->hasFile('image_file')) {
            return $this->storeUploadedImage($request->file('image_file'));
        }

        $manualImage = trim((string) ($validated['image'] ?? ''));

        if ($manualImage !== '') {
            return $manualImage;
        }

        return (string) $product?->image;
    }

    private function storeUploadedImage(UploadedFile $file): string
    {
        $directory = public_path('assets/images/uploads/products');
        File::ensureDirectoryExists($directory);

        $filename = Str::lower((string) Str::ulid()).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'assets/images/uploads/products/'.$filename;
    }

    private function managedAssets(Product $product): Collection
    {
        return collect([$product->image])
            ->concat($product->gallery ?? [])
            ->filter()
            ->unique()
            ->values();
    }

    private function managedAssetsFromPayload(array $payload): Collection
    {
        return collect([$payload['image'] ?? null])
            ->concat($payload['gallery'] ?? [])
            ->filter()
            ->unique()
            ->values();
    }

    private function deleteManagedAssets(Collection $paths): void
    {
        $paths
            ->filter(fn (string $path) => Str::startsWith($path, 'assets/images/uploads/products/'))
            ->each(function (string $path) {
                $absolutePath = public_path($path);

                if (File::exists($absolutePath)) {
                    File::delete($absolutePath);
                }
            });
    }

    private function uniqueSlug(string $name, ?Product $product = null): string
    {
        $base = Str::slug($name) ?: 'max-kebab-item';
        $slug = $base;
        $counter = 1;

        while (
            Product::query()
                ->when($product, fn ($query) => $query->where('id', '!=', $product->id))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    private function uniqueSku(?Product $product = null): string
    {
        do {
            $sku = 'MK-'.Str::upper(Str::random(6));
        } while (
            Product::query()
                ->when($product, fn ($query) => $query->where('id', '!=', $product->id))
                ->where('sku', $sku)
                ->exists()
        );

        return $sku;
    }
}
