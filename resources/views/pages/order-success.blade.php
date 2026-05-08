@php
    $title = 'Order Confirmed | Max Kebab';
    $description = 'Your Max Kebab order has been received.';
    $showCta = false;
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Order Confirmed',
        'pageSubtitle' => 'Thanks for ordering from Max Kebab',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Order Confirmed'],
        ],
    ])

    <section class="cart-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="empty-state success-state">
                <h3>Order {{ $order->reference }} is in.</h3>
                <p>We have received your order for {{ ucfirst(str_replace('_', ' ', $order->order_type)) }}. If needed, call the shop on <a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}">{{ $brand['phone_display'] }}</a>. @if ($order->email)We will also send status updates to {{ $order->email }}.@endif</p>
            </div>
            <div class="row justify-content-center mt-50">
                <div class="col-sm-12 col-md-8 col-lg-6 pb-30">
                    <div class="cart-details">
                        <h3 class="cart-details-title color-white">Order Summary</h3>
                        <div class="cart-total-box">
                            <div class="cart-total-item pt-0">
                                <h4>Name</h4>
                                <p>{{ $order->customer_name }}</p>
                            </div>
                            <div class="cart-total-item">
                                <h4>Phone</h4>
                                <p>{{ $order->phone }}</p>
                            </div>
                            <div class="cart-total-item">
                                <h4>Type</h4>
                                <p>{{ ucfirst(str_replace('_', ' ', $order->order_type)) }}</p>
                            </div>
                            @if ($order->collection_time)
                                <div class="cart-total-item">
                                    <h4>Preferred Time</h4>
                                    <p>{{ $order->collection_time }}</p>
                                </div>
                            @endif
                            @if ($order->order_type === 'delivery' && $order->delivery_postcode)
                                <div class="cart-total-item">
                                    <h4>Delivery Postcode</h4>
                                    <p>{{ $order->delivery_postcode }}</p>
                                </div>
                            @endif
                            @if ($order->order_type === 'delivery' && $order->delivery_address)
                                <div class="cart-total-item">
                                    <h4>Delivery Address</h4>
                                    <p>{{ $order->delivery_address }}</p>
                                </div>
                            @endif
                            @foreach ($order->items as $item)
                                <div class="cart-total-item">
                                    <h4>
                                        {{ $item->product_name }} x{{ $item->quantity }}
                                        @if ($item->selected_option)
                                            <span class="cart-item-meta">Option: {{ $item->selected_option }}</span>
                                        @endif
                                    </h4>
                                    <p>£{{ number_format((float) $item->line_total, 2) }}</p>
                                </div>
                            @endforeach
                            <div class="cart-total-item cart-total-bold">
                                <h4 class="color-white">Total</h4>
                                <p>£{{ number_format((float) $order->total, 2) }}</p>
                            </div>
                        </div>
                        <a href="{{ route('shop.index') }}" class="btn">Order Again</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
