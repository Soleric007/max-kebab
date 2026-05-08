@php
    $title = 'Shop | Max Kebab';
    $description = 'Order premium kebabs, burgers, wings, sides, drinks, and meal deals from Max Kebab.';
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Shop',
        'pageSubtitle' => 'Build your order from our premium restaurant menu',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop'],
        ],
    ])

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-9 pb-30">
                    <div class="product-list-header">
                        <div class="product-list-header-item">
                            <div class="product-list-result">
                                <p>Showing {{ $products->count() }} result{{ $products->count() === 1 ? '' : 's' }}</p>
                            </div>
                        </div>
                        <div class="product-list-header-item">
                            <div class="product-list-action">
                                <div class="product-list-form">
                                    <form method="GET" action="{{ route('shop.index') }}">
                                        @if (! empty($filters['search']))
                                            <input type="hidden" name="search" value="{{ $filters['search'] }}">
                                        @endif
                                        @if (! empty($filters['category']))
                                            <input type="hidden" name="category" value="{{ $filters['category'] }}">
                                        @endif
                                        <select name="sort" onchange="this.form.submit()">
                                            <option value="popular" @selected(($filters['sort'] ?? 'popular') === 'popular')>Sort By Popular</option>
                                            <option value="lowtohigh" @selected(($filters['sort'] ?? '') === 'lowtohigh')>Sort By Price: Low To High</option>
                                            <option value="hightolow" @selected(($filters['sort'] ?? '') === 'hightolow')>Sort By Price: High To Low</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <div class="row justify-content-center">
                            @forelse ($products as $product)
                                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                                    <x-product-card :product="$product" />
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state">
                                        <h3>No items matched your search.</h3>
                                        <p>Try a different category or clear the filters to see the full menu.</p>
                                        <a href="{{ route('shop.index') }}" class="btn">View Full Shop</a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 pb-30">
                    <div class="sidebar-item around-border sidebar-search">
                        <form method="GET" action="{{ route('shop.index') }}">
                            @if (! empty($filters['category']))
                                <input type="hidden" name="category" value="{{ $filters['category'] }}">
                            @endif
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="Search" value="{{ $filters['search'] ?? '' }}">
                                <button type="submit"><i class="flaticon-loupe"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-title">
                            <h3 class="color-white">Categories</h3>
                        </div>
                        <ul class="sidebar-list">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('shop.index', ['category' => $category['slug']]) }}">{{ $category['name'] }} <span>({{ $category['count'] }})</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-title">
                            <h3 class="color-white">Popular</h3>
                        </div>
                        <div class="sidebar-recent-post">
                            @foreach ($popularProducts as $product)
                                <div class="sidebar-recent-item">
                                    <div class="sidebar-recent-thumb">
                                        <a href="{{ route('shop.show', $product['slug']) }}"><img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"></a>
                                    </div>
                                    <div class="sidebar-recent-content">
                                        <h3><a href="{{ route('shop.show', $product['slug']) }}">{{ $product['name'] }}</a></h3>
                                        <h4 class="product-price">{{ $product['price_formatted'] }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.subscribe-banner', [
        'title' => 'Build your basket your way.',
        'text' => 'Browse the full Max Kebab shop, save favourites, and check out with a quick dine-in, takeaway, or delivery order.',
        'primaryUrl' => route('cart.index'),
        'primaryLabel' => 'View Basket',
        'secondaryUrl' => route('contact'),
        'secondaryLabel' => 'Find The Shop',
    ])
@endsection
