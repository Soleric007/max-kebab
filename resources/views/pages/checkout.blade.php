@php
    $title = 'Checkout | Max Kebab';
    $description = 'Complete your Max Kebab dine-in, takeaway, or delivery order.';
    $showCta = false;
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Checkout',
        'pageSubtitle' => 'Confirm your details and place your order',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Checkout'],
        ],
    ])

    <div class="checkout-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-7 col-lg-8 pb-30">
                    <div class="checkout-item">
                        <div class="sub-section-title">
                            <h3 class="color-white">Order Details</h3>
                        </div>
                        <div class="checkout-form">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="customer_name" class="form-control" placeholder="Full Name*" value="{{ old('customer_name') }}" required>
                                            </div>
                                            @error('customer_name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone Number*" value="{{ old('phone') }}" required>
                                            </div>
                                            @error('phone')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
                                            </div>
                                            @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <select name="order_type" class="form-control" required>
                                                    <option value="">Order Type*</option>
                                                    <option value="dine_in" @selected(old('order_type') === 'dine_in')>Dine In</option>
                                                    <option value="takeaway" @selected(old('order_type') === 'takeaway')>Takeaway</option>
                                                    <option value="delivery" @selected(old('order_type') === 'delivery')>Delivery</option>
                                                </select>
                                            </div>
                                            @error('order_type')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="collection_time" class="form-control" placeholder="Preferred Collection, Arrival, or Delivery Time" value="{{ old('collection_time') }}">
                                            </div>
                                            @error('collection_time')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12" data-delivery-fields @class(['d-none' => old('order_type') !== 'delivery'])>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="delivery_postcode" class="form-control" placeholder="Delivery Postcode*" value="{{ old('delivery_postcode') }}" data-delivery-required>
                                                    </div>
                                                    @error('delivery_postcode')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group input-group-textarea">
                                                        <textarea name="delivery_address" class="form-control" rows="2" placeholder="Full Delivery Address*" data-delivery-required>{{ old('delivery_address') }}</textarea>
                                                    </div>
                                                    @error('delivery_address')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group input-group-textarea">
                                                <textarea name="notes" class="form-control" rows="5" placeholder="Order Notes">{{ old('notes') }}</textarea>
                                            </div>
                                            @error('notes')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-check agree-label mb-20">
                                            <input name="terms" class="form-check-input" type="checkbox" id="checkoutTerms" value="1" required>
                                            <label class="form-check-label" for="checkoutTerms">
                                                I understand that {{ $brand['name'] }} offers dine-in, takeaway, and delivery subject to service hours and delivery area.
                                            </label>
                                        </div>
                                        @error('terms')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <button class="btn full-width" type="submit">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-4 pb-30">
                    <div class="checkout-item">
                        <div class="checkout-details cart-details mb-30">
                            <h3 class="cart-details-title color-white">Cart Totals</h3>
                            <div class="cart-total-box">
                                @foreach ($cartItems as $item)
                                    <div class="cart-total-item {{ $loop->first ? 'pt-0' : '' }}">
                                        <h4 class="color-main">
                                            {{ $item['product']['name'] }} x{{ $item['quantity'] }}
                                            @if ($item['selected_option'])
                                                <span class="cart-item-meta">Option: {{ $item['selected_option_label'] ?? $item['selected_option'] }}</span>
                                            @endif
                                        </h4>
                                        <p>{{ $item['line_total_formatted'] }}</p>
                                    </div>
                                @endforeach
                                <div class="cart-total-item">
                                    <h4>Sub Total</h4>
                                    <p>{{ $subtotalFormatted }}</p>
                                </div>
                                <div class="cart-total-item cart-total-bold">
                                    <h4 class="color-white">Total</h4>
                                    <p>{{ $subtotalFormatted }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-payment-area">
                            <h3 class="color-white cart-details-title">Order Fulfilment</h3>
                            <div class="checkout-form">
                                <div class="checkout-note-box">
                                    <p>Dine-in, takeaway, and delivery orders are handled from {{ $brand['address'] }}.</p>
                                    <p>Need to confirm timing or delivery availability? Call <a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}">{{ $brand['phone_display'] }}</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.subscribe-banner', [
        'title' => 'Fresh food prepared your way.',
        'text' => 'Complete your order and we will prepare it for dine-in, takeaway, or delivery from Max Kebab.',
        'primaryUrl' => route('contact'),
        'primaryLabel' => 'Find The Shop',
        'secondaryUrl' => 'tel:' . preg_replace('/\s+/', '', $brand['phone']),
        'secondaryLabel' => 'Call Before Arrival',
    ])
@endsection
