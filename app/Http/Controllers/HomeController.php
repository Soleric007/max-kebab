<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Support\Storefront;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly Storefront $storefront)
    {
    }

    public function index(): View
    {
        $categories = $this->storefront->categories();

        return view('pages.home', [
            'showCta' => false,
            'heroSlides' => $this->storefront->heroSlides(),
            'categories' => $categories,
            'featuredProducts' => $this->storefront->featuredProducts(),
            'menuSections' => $categories
                ->mapWithKeys(fn (array $category) => [$category['slug'] => $this->repeatForCarousel($this->storefront->productsByCategory($category['slug']), 5)]),
            'reviews' => $this->storefront->reviews(),
            'combos' => $this->comboSelections(),
            'orderSteps' => $this->orderSteps(),
            'ingredientHighlights' => $this->ingredientHighlights(),
        ]);
    }

    public function menu(): View
    {
        $categories = $this->storefront->categories();

        return view('pages.menu', [
            'showCta' => false,
            'categories' => $categories,
            'menuSections' => $categories
                ->mapWithKeys(fn (array $category) => [$category['slug'] => $this->storefront->productsByCategory($category['slug'])]),
            'orderSteps' => $this->orderSteps(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'reviews' => $this->storefront->reviews(),
            'featuredProducts' => $this->storefront->featuredProducts(4),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
            'terms' => ['accepted'],
        ]);

        ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Thanks for reaching out. Max Kebab will get back to you shortly.');
    }

    private function repeatForCarousel(Collection $products, int $minimum): Collection
    {
        $products = $products->values();

        if ($products->isEmpty() || $products->count() >= $minimum) {
            return $products;
        }

        $expanded = collect();

        while ($expanded->count() < $minimum) {
            $expanded = $expanded->concat($products);
        }

        return $expanded->take($minimum)->values();
    }

    private function comboSelections(): Collection
    {
        $combos = $this->storefront->productsByCategory('meal-deals')->values();

        if ($combos->count() >= 4) {
            return $combos->take(4);
        }

        $pool = $combos
            ->concat($this->storefront->featuredProducts())
            ->concat($this->storefront->products())
            ->unique('slug')
            ->values();

        if ($pool->isEmpty()) {
            return collect();
        }

        $filled = collect();

        while ($filled->count() < 4) {
            $filled = $filled->concat($pool);
        }

        return $filled->take(4)->values();
    }

    private function orderSteps(): array
    {
        return [
            [
                'title' => 'Choose',
                'description' => 'Pick your wrap, grill, burger, wings, or feast box from the Max Kebab menu.',
            ],
            [
                'title' => 'Order',
                'description' => 'Add your favourites to basket and place a dine-in, takeaway, or delivery order in minutes.',
            ],
            [
                'title' => 'Enjoy',
                'description' => 'Enjoy it fresh with us, collect it hot, or have it delivered while it is at its best.',
            ],
        ];
    }

    private function ingredientHighlights(): array
    {
        return [
            'left' => [
                [
                    'title' => 'Fresh',
                    'accent' => 'Flatbread',
                    'description' => 'Warm, soft bread that holds every layer together without taking over the flavour.',
                ],
                [
                    'title' => 'Crisp',
                    'accent' => 'Salad',
                    'description' => 'Lettuce, onions, and fresh vegetables cut daily to keep every bite balanced and bright.',
                ],
                [
                    'title' => 'House',
                    'accent' => 'Sauces',
                    'description' => 'Creamy garlic, chilli, and signature sauces that bring the Max Kebab finish to every order.',
                ],
            ],
            'right' => [
                [
                    'title' => 'Chargrilled',
                    'accent' => 'Meat',
                    'description' => 'Juicy doner, shish, chicken, and kofte cooked for depth, colour, and proper texture.',
                ],
                [
                    'title' => 'Fresh',
                    'accent' => 'Lettuce',
                    'description' => 'Cool crunch that lifts the heavier flavours and keeps wraps and boxes feeling clean.',
                ],
                [
                    'title' => 'Pure',
                    'accent' => 'Cheese',
                    'description' => 'Melted cheese where it matters, especially on burgers, loaded fries, and feast-style boxes.',
                ],
            ],
        ];
    }
}
