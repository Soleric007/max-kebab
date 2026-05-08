<?php

use App\Models\Order;

it('renders the main storefront pages', function () {
    $this->get('/')->assertOk();
    $this->get('/menu')->assertOk();
    $this->get('/about')->assertOk();
    $this->get('/contact')->assertOk();
    $this->get('/shop')->assertOk();
    $this->get('/shop/signature-doner-wrap')->assertOk();
});

it('lets customers manage wishlist and basket items', function () {
    $this->post('/wishlist/signature-doner-wrap')->assertRedirect();
    $this->get('/wishlist')->assertOk()->assertSee('Signature Doner Wrap');

    $this->post('/cart/signature-doner-wrap', ['quantity' => 2])->assertRedirect();
    $this->get('/cart')->assertOk()->assertSee('Signature Doner Wrap');

    $this->patch('/cart/signature-doner-wrap', ['quantity' => 3])->assertRedirect();
    $this->get('/cart')->assertSee('£26.70');
});

it('creates an order through checkout', function () {
    $this->post('/cart/signature-doner-wrap', ['quantity' => 2])->assertRedirect();

    $response = $this->post('/checkout', [
        'customer_name' => 'Test Customer',
        'phone' => '+44 7708 449419',
        'email' => 'test@example.com',
        'order_type' => 'takeaway',
        'collection_time' => 'Tonight 7:30 PM',
        'notes' => 'Extra chilli sauce',
        'terms' => '1',
    ]);

    $order = Order::query()->first();

    expect($order)->not->toBeNull();
    expect($order->items)->toHaveCount(1);
    expect((float) $order->total)->toBe(17.80);

    $response->assertRedirect(route('orders.show', $order->reference));
    $this->get(route('orders.show', $order->reference))->assertOk()->assertSee($order->reference);
});
