<?php

namespace App\Http\Controllers;

use App\Support\Storefront;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly Storefront $storefront)
    {
    }

    public function index(): View
    {
        return view('pages.cart', [
            'cartItems' => $this->storefront->cartItems(),
            'subtotal' => $this->storefront->cartSubtotal(),
            'subtotalFormatted' => $this->storefront->money($this->storefront->cartSubtotal()),
        ]);
    }

    public function store(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:20'],
            'option' => ['nullable', 'string', 'max:80'],
        ]);

        abort_unless($this->storefront->addToCart($slug, (int) ($validated['quantity'] ?? 1), $validated['option'] ?? null), 404);

        return back()->with('success', 'Item added to your order basket.');
    }

    public function update(Request $request, string $lineItem): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        abort_unless($this->storefront->updateCart($lineItem, (int) $validated['quantity']), 404);

        return back()->with('success', 'Basket updated.');
    }

    public function destroy(string $lineItem): RedirectResponse
    {
        $this->storefront->removeFromCart($lineItem);

        return back()->with('success', 'Item removed from your basket.');
    }
}
