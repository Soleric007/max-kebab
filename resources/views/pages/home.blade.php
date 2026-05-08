@php
    $title = 'Max Kebab | Northampton\'s Premium Kebab Experience';
    $description = 'Premium kebab restaurant in Northampton serving fresh wraps, burgers, wings, sides, salads, dine-in favourites, takeaway, and delivery.';
@endphp

@extends('layouts.app')

@section('content')
    <div class="header-bg">
        <div class="container-fluid">
            <div class="header-container position-relative p-tb-100">
                <div class="header-page-shape">
                    <div class="header-page-shape-item wow animate__rollIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__slideInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="{{ asset('assets/images/header-shape-2.png') }}" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__slideInRight" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="{{ asset('assets/images/header-shape-3.png') }}" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__rollIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape">
                    </div>
                </div>
                <div class="header-carousel owl-carousel owl-theme">
                    @foreach ($heroSlides as $slide)
                        <div class="item">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="header-carousel-text max-555 mx-auto me-lg-0 text-center text-lg-start">
                                        <h1 class="color-white">{{ $slide['headline'] }}</h1>
                                        <p>{{ $slide['subtext'] }}</p>
                                        <div class="header-carousel-action">
                                            <a href="{{ route('shop.show', $slide['slug']) }}" class="btn">
                                                Order Now <i class="flaticon-shopping-cart-black-shape"></i>
                                            </a>
                                            <p class="header-product-price color-white">{{ $slide['price'] }} <del>{{ $slide['compare_price'] }}</del></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="header-carousel-image wow animate__zoomIn" data-wow-duration="1s" data-wow-delay="0.5s">
                                        <img src="{{ asset($slide['image']) }}" alt="{{ $slide['headline'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                    <div class="section-title section-title-left text-center text-md-start m-0">
                        <small>Welcome To {{ $brand['name'] }}</small>
                        <h2 class="color-white">Authentic grilled flavour with a premium street-food feel</h2>
                        <p>{{ $brand['description'] }}</p>
                        <a href="{{ route('about') }}" class="btn">
                            More About Us
                            <i class="flaticon-right-arrow-sketch-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-image-grid">
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner mb-30">
                                <img src="{{ asset('assets/images/welcome-image-1.jpg') }}" alt="restaurant interior">
                            </div>
                            <div class="about-image-grid-inner mb-30">
                                <img src="{{ asset('assets/images/welcome-image-2.jpg') }}" alt="fresh food preparation">
                            </div>
                        </div>
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner fluid-height">
                                <img src="{{ asset('assets/images/welcome-image-3.jpg') }}" alt="shared dining table">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.menu-tabs', [
        'smallTitle' => 'Menu',
        'heading' => 'Just Choose From The Best',
    ])

    @include('partials.order-steps', [
        'orderSteps' => $orderSteps,
        'heading' => '3 Easy Steps To Enjoy',
    ])

    @include('partials.special-highlights', [
        'ingredientHighlights' => $ingredientHighlights,
        'smallTitle' => 'Speciality',
        'heading' => 'Our Special Ingredients',
    ])

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="section-title">
                <small>Chef Picks</small>
                <h2 class="color-white">Favourites our guests come back for</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($featuredProducts as $product)
                    <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="combo-section bg-black pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <small>Combos</small>
                <h2 class="color-white">Meal deals built for proper appetite</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($combos as $index => $combo)
                    <div class="col-sm-12 col-md-6 col-lg-6 pb-30 wow animate__slideInUp" data-wow-duration="1s" data-wow-delay="0.{{ $index + 1 }}s">
                        <div class="combo-box">
                            <div class="combo-box-image">
                                <img src="{{ asset($combo['image']) }}" alt="{{ $combo['name'] }}">
                            </div>
                            <div class="combo-box-content">
                                <h3>{{ $combo['name'] }}</h3>
                                <h4><span>{{ $combo['category_name'] }}</span> {{ $combo['short_description'] }}</h4>
                                <a href="{{ route('shop.show', $combo['slug']) }}" class="btn">
                                    Order Now
                                    <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                            </div>
                            <div class="combo-offer-shape">
                                <div class="combo-shape-inner">
                                    <small>Only At</small>
                                    <p>{{ $combo['price_formatted'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.reviews', ['reviews' => $reviews])

    @include('partials.subscribe-banner', [
        'title' => 'Fresh food, no shortcuts.',
        'text' => 'Order for dine-in, takeaway, or delivery at Max Kebab and enjoy premium flavour made fresh to order.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Start Your Order',
        'secondaryUrl' => 'tel:' . preg_replace('/\s+/', '', $brand['phone']),
        'secondaryLabel' => 'Call The Shop',
    ])
@endsection
