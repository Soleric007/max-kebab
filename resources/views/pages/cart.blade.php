@php
    $title = 'Your Basket | Max Kebab';
    $description = 'Review your Max Kebab basket and continue to checkout.';
    $showCta = false;
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Cart',
        'pageSubtitle' => 'Review your order before checkout',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Cart'],
        ],
    ])

    <section class="cart-section pt-100 pb-70 bg-black">
        <div class="container">
            @if ($cartItems->isEmpty())
                <div class="empty-state">
                    <h3>Your basket is empty.</h3>
                    <p>Browse the menu and add your favourites to get started.</p>
                    <a href="{{ route('shop.index') }}" class="btn">Shop Now</a>
                </div>
            @else
                <div class="cart-table cart-table-dark">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Product</th>
                                <th>Id</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="cancel">
                                        <form action="{{ route('cart.destroy', $item['key']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cart-icon-button"><i class="flaticon-cancel"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="product-table-info">
                                            <div class="product-table-thumb">
                                                <img src="{{ asset($item['product']['image']) }}" alt="{{ $item['product']['name'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="td-product-name">
                                        <a href="{{ route('shop.show', $item['slug']) }}">{{ $item['product']['name'] }}</a>
                                        @if ($item['selected_option'])
                                            <span class="cart-item-meta">Option: {{ $item['selected_option_label'] ?? $item['selected_option'] }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item['product']['sku'] }}</td>
                                    <td>{{ $item['unit_price_formatted'] }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['key']) }}" method="POST" class="cart-row-update">
                                            @csrf
                                            @method('PATCH')
                                            <div class="cart-quantity">
                                                <button class="qu-btn dec" type="button">-</button>
                                                <input type="text" name="quantity" class="qu-input" value="{{ $item['quantity'] }}">
                                                <button class="qu-btn inc" type="button">+</button>
                                            </div>
                                            <button type="submit" class="btn btn-small mt-10">Update</button>
                                        </form>
                                    </td>
                                    <td class="td-total-price">{{ $item['line_total_formatted'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-between align-items-center mt-30">
                    <div class="col-sm-12 col-md-7 col-lg-5">
                        <div class="cart-coupon cart-info-item">
                            <div class="cart-note-box">
                                <h4 class="color-white">Service Note</h4>
                                <p>{{ $brand['service_modes'] }}. Delivery details are confirmed during checkout.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="cart-update cart-info-item">
                            <a href="{{ route('shop.index') }}" class="btn full-width">Continue Shopping</a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-8 col-lg-6 pb-30">
                        <div class="cart-details mt-20">
                            <h3 class="cart-details-title color-white">Cart Totals</h3>
                            <div class="cart-total-box">
                                <div class="cart-total-item">
                                    <h4>Sub Total</h4>
                                    <p>{{ $subtotalFormatted }}</p>
                                </div>
                                <div class="cart-total-item">
                                    <h4>Fulfilment</h4>
                                    <p>{{ $brand['service_modes'] }}</p>
                                </div>
                                <div class="cart-total-item cart-total-bold">
                                    <h4 class="color-white">Total</h4>
                                    <p>{{ $subtotalFormatted }}</p>
                                </div>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="btn">Proceed To Checkout</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('partials.subscribe-banner', [
        'title' => 'One step away from checkout.',
        'text' => 'Review your basket, make any changes, and continue to place your Max Kebab dine-in, takeaway, or delivery order.',
        'primaryUrl' => route('checkout.index'),
        'primaryLabel' => 'Go To Checkout',
        'secondaryUrl' => route('shop.index'),
        'secondaryLabel' => 'Continue Shopping',
    ])
@endsection
