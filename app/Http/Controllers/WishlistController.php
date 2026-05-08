<?php

namespace App\Http\Controllers;

use App\Support\Storefront;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function __construct(private readonly Storefront $storefront)
    {
    }

    public function index(): View
    {
        return view('pages.wishlist', [
            'wishlistItems' => $this->storefront->wishlistItems(),
        ]);
    }

    public function store(string $slug): RedirectResponse
    {
        abort_unless($this->storefront->addToWishlist($slug), 404);

        return back()->with('success', 'Item added to your wishlist.');
    }

    public function destroy(string $slug): RedirectResponse
    {
        $this->storefront->removeFromWishlist($slug);

        return back()->with('success', 'Item removed from your wishlist.');
    }
}
