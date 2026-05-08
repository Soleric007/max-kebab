@php
    $title = 'Menu | Max Kebab';
    $description = 'Explore the Max Kebab menu of premium kebabs, burgers, wings, sides, salads, drinks, and meal deals.';
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Our Menu',
        'pageSubtitle' => 'Freshly prepared favourites for dine-in, takeaway, and delivery',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Menu'],
        ],
    ])

    <section class="menu-section bg-black p-tb-100">
        <div class="container position-relative">
            <div class="section-title">
                <small>Menu</small>
                <h2 class="color-white">Just Choose From The Best</h2>
            </div>
            <div class="menu-main-carousel-area">
                <div class="menu-main-thumb-nav">
                    @foreach ($categories as $category)
                        <div class="menu-main-thumb-item menu-main-thumb-black">
                            <div class="menu-main-thumb-inner">
                                <img src="{{ asset($category['icon']) }}" alt="{{ $category['name'] }}">
                                <p>{{ strtoupper($category['name']) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="menu-main-details-for">
                    @foreach ($categories as $category)
                        <div class="menu-main-details-item">
                            <div class="receipe-grid receipe-grid-three">
                                @foreach (($menuSections[$category['slug']] ?? collect()) as $product)
                                    <div class="receipe-item receipe-item-black pb-30">
                                        <div class="receipe-item-inner">
                                            <div class="receipe-image">
                                                <a href="{{ route('shop.show', $product['slug']) }}">
                                                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                                                </a>
                                            </div>
                                            <div class="receipe-content">
                                                <div class="receipe-info">
                                                    <h3><a href="{{ route('shop.show', $product['slug']) }}">{{ $product['name'] }}</a></h3>
                                                    @if (! empty($product['options']))
                                                        <p class="receipe-option-copy">{{ collect($product['options'])->pluck('display')->join(' / ') }}</p>
                                                    @endif
                                                    <h4>
                                                        {{ $product['price_display'] }}
                                                        @if (! empty($product['compare_price_formatted']))
                                                            <del>{{ $product['compare_price_formatted'] }}</del>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="receipe-cart">
                                                    <form method="POST" action="{{ route('cart.store', $product['slug']) }}">
                                                        @csrf
                                                        @if (! empty($product['default_option']))
                                                            <input type="hidden" name="option" value="{{ $product['default_option'] }}">
                                                        @endif
                                                        <button type="submit" class="receipe-cart-button" aria-label="Add {{ $product['name'] }} to basket">
                                                            <i class="flaticon-supermarket-basket"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <a href="{{ route('shop.index', ['category' => $category['slug']]) }}" class="btn load-more-btn">
                                    <span class="load-more-text">View {{ $category['name'] }}</span>
                                    <span class="load-more-icon"><i class="icofont-long-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('partials.order-steps', [
        'orderSteps' => $orderSteps,
        'heading' => '3 Easy Steps To Enjoy',
    ])
@endsection
