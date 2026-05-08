<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Storefront;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(private readonly Storefront $storefront)
    {
    }

    public function index(): View|RedirectResponse
    {
        $cartItems = $this->storefront->cartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Your basket is empty. Add something delicious first.');
        }

        return view('pages.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $this->storefront->cartSubtotal(),
            'subtotalFormatted' => $this->storefront->money($this->storefront->cartSubtotal()),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $cartItems = $this->storefront->cartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Your basket is empty.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'order_type' => ['required', 'in:dine_in,takeaway,delivery'],
            'collection_time' => ['nullable', 'string', 'max:80'],
            'delivery_postcode' => ['nullable', 'string', 'max:30', 'required_if:order_type,delivery'],
            'delivery_address' => ['nullable', 'string', 'max:2000', 'required_if:order_type,delivery'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'terms' => ['accepted'],
        ]);

        $subtotal = $this->storefront->cartSubtotal();

        $order = DB::transaction(function () use ($validated, $cartItems, $subtotal) {
            $order = Order::create([
                'reference' => 'MK-'.Str::upper(Str::random(8)),
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'],
                'order_type' => $validated['order_type'],
                'collection_time' => $validated['collection_time'] ?? null,
                'delivery_postcode' => $validated['delivery_postcode'] ?? null,
                'delivery_address' => $validated['delivery_address'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_slug' => $item['slug'],
                    'product_name' => $item['product']['name'],
                    'selected_option' => $item['selected_option'],
                    'product_price' => $item['product']['price'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['line_total'],
                ]);
            }

            return $order;
        });

        $this->storefront->clearCart();

        return redirect()
            ->route('orders.show', $order->reference)
            ->with('success', 'Your order has been placed successfully.');
    }

    public function show(string $reference): View
    {
        $order = Order::with('items')->where('reference', $reference)->firstOrFail();

        return view('pages.order-success', compact('order'));
    }
}
