@php
    $title = 'About Us | Max Kebab';
    $description = 'Learn more about Max Kebab, our premium street-food identity, authentic flavours, and quality-first service in Northampton.';
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'About Us',
        'pageSubtitle' => 'Modern street food, authentic flavour, and a warm local atmosphere',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About Us'],
        ],
    ])

    <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                    <div class="section-title section-title-left text-center text-md-start m-0">
                        <small>Our Story</small>
                        <h2 class="color-white">A cleaner, better take on the classic kebab shop</h2>
                        <p>{{ $brand['name'] }} was shaped around fresh ingredients, authentic grilled flavour, and a more premium dine-in, takeaway, and delivery experience for Northampton.</p>
                        <p>We keep the menu focused, the kitchen sharp, and the hospitality friendly so every order feels worth coming back for.</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-image-grid">
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner mb-30">
                                <img src="{{ asset('assets/images/welcome-image-1.jpg') }}" alt="Max Kebab interior">
                            </div>
                            <div class="about-image-grid-inner mb-30">
                                <img src="{{ asset('assets/images/welcome-image-2.jpg') }}" alt="Freshly prepared menu items">
                            </div>
                        </div>
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner fluid-height">
                                <img src="{{ asset('assets/images/welcome-image-3.jpg') }}" alt="Dining atmosphere">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="service-section p-tb-100 bg-black">
        <div class="container-fluid">
            <div class="bg-main bg-overlay-transparent contain-box">
                <div class="container">
                    <div class="section-title">
                        <h2 class="color-white">What defines the Max Kebab experience</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                            <div class="service-item">
                                <div class="service-image">
                                    <img src="{{ asset('assets/images/service-1.jpg') }}" alt="Dine in">
                                </div>
                                <div class="service-content">
                                    <h3>1. Dine In</h3>
                                    <p>Comfortable, clean, and friendly for guests who want fresh food served in a stylish atmosphere.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                            <div class="service-item">
                                <div class="service-image">
                                    <img src="{{ asset('assets/images/service-2.jpg') }}" alt="Takeaway">
                                </div>
                                <div class="service-content">
                                    <h3>2. Takeaway</h3>
                                    <p>Fast, well-packed takeaway and delivery with quality that still feels premium when it reaches your door.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                            <div class="service-item">
                                <div class="service-image">
                                    <img src="{{ asset('assets/images/service-3.jpg') }}" alt="Fresh grill">
                                </div>
                                <div class="service-content">
                                    <h3>3. Fresh Grill</h3>
                                    <p>Everything centres on authentic flavour, fresh salad, and properly cooked meat without shortcuts.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="section-title">
                <small>Signature Items</small>
                <h2 class="color-white">A few standout plates from the kitchen</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($featuredProducts as $product)
                    <div class="col-sm-12 col-md-6 col-lg-3 pb-30">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.reviews', [
        'reviews' => $reviews,
        'heading' => 'Fresh, authentic, friendly, and premium quality. That is the feedback we hear most.',
    ])
@endsection
