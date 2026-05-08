@php
    $title = $product['name'].' | Max Kebab';
    $description = $product['description'];
    $showCta = false;
    $isWishlisted = app(\App\Support\Storefront::class)->inWishlist($product['slug']);
    $defaultOption = $product['options'][0] ?? null;
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Shop Details',
        'pageSubtitle' => $product['name'],
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => $product['name']],
        ],
    ])

    <div class="product-details-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-5 pb-30">
                    <div class="product-details-item">
                        <div class="product-details-slider">
                            <div class="product-details-for">
                                @foreach ($product['gallery'] as $image)
                                    <div class="product-for-item">
                                        <img src="{{ asset($image) }}" alt="{{ $product['name'] }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-details-nav">
                                @foreach ($product['gallery'] as $image)
                                    <div class="product-nav-item">
                                        <div class="product-nav-item-inner">
                                            <img src="{{ asset($image) }}" alt="{{ $product['name'] }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 pb-30">
                    <div class="product-details-item">
                        <div class="product-details-caption">
                            @if (! empty($product['badge']))
                                <div class="product-status product-status-danger mb-20">{{ $product['badge'] }}</div>
                            @endif
                            <h3 class="mb-20 color-white">{{ $product['name'] }}</h3>
                            <h4 class="mb-20 product-id">Id: {{ $product['sku'] }}</h4>
                            <div class="review-star mb-20">
                                <ul>
                                    @for ($i = 0; $i < 5; $i++)
                                        <li class="full-star"><i class="flaticon-star-1"></i></li>
                                    @endfor
                                </ul>
                                <p>({{ $product['review_count'] }} Reviews)</p>
                            </div>
                            <div class="product-details-price mb-20">
                                <h4 data-product-price>{{ $defaultOption['price_formatted'] ?? $product['price_formatted'] }}</h4>
                                @if ($product['has_variable_pricing'])
                                    <p class="cart-item-meta">{{ $product['price_display'] }} across available options</p>
                                @endif
                            </div>
                            <div class="product-details-para mb-20">
                                <p>{{ $product['description'] }}</p>
                            </div>
                            @if (! empty($product['options']))
                                <div class="product-action-info mb-20">
                                    <h4>Options:</h4>
                                    <p class="cart-item-meta mb-15">{{ collect($product['options'])->pluck('display')->join(' / ') }}</p>
                                    <ul class="product-size-list" data-option-list>
                                        @foreach ($product['options'] as $option)
                                            <li
                                                class="{{ $loop->first ? 'active' : '' }}"
                                                data-option="{{ $option['value'] }}"
                                                data-option-price="{{ $option['price_formatted'] }}"
                                            >
                                                {{ $option['label'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="product-action-info mb-20">
                                <div class="d-flex flex-wrap align-items-center product-quantity">
                                    <form method="POST" action="{{ route('cart.store', $product['slug']) }}" class="product-add-form">
                                        @csrf
                                        @if ($defaultOption)
                                            <input type="hidden" name="option" value="{{ $defaultOption['value'] }}">
                                        @endif
                                        <button class="btn btn-icon product-quantity-item" type="submit">
                                            Add To Basket
                                            <i class="flaticon-shopping-cart-black-shape"></i>
                                        </button>
                                        <div class="cart-quantity product-quantity-item">
                                            <button class="qu-btn dec" type="button">-</button>
                                            <input type="text" name="quantity" class="qu-input" value="1">
                                            <button class="qu-btn inc" type="button">+</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="product-action-info">
                                <div class="product-add-wishlist">
                                    @if ($isWishlisted)
                                        <form method="POST" action="{{ route('wishlist.destroy', $product['slug']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-button-link"><i class="flaticon-heart"></i>Wishlisted</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('wishlist.store', $product['slug']) }}">
                                            @csrf
                                            <button type="submit" class="text-button-link"><i class="flaticon-heart"></i>Add To Wishlist</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-tab below-border">
                <ul class="product-details-tab-list">
                    <li class="active" data-product-tab-list="1">Description</li>
                    <li data-product-tab-list="2">Reviews <span>({{ $reviews->count() }})</span></li>
                </ul>
                <div class="product-tab-information">
                    <div class="product-tab-information-item active" data-product-details-tab="1">
                        <div class="product-description mb-30">
                            <p>{{ $product['description'] }}</p>
                            <p>Prepared for {{ str_replace('-', ' ', $product['category']) }}, built around fresh ingredients, and served at a quality level that matches the Max Kebab name.</p>
                        </div>
                    </div>
                    <div class="product-tab-information-item" data-product-details-tab="2">
                        <div class="product-review-list">
                            @foreach ($reviews as $review)
                                <div class="product-review-item">
                                    <x-review-card :review="$review" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-product mt-50">
                <div class="sub-section-title">
                    <h3 class="color-white">Related Items</h3>
                </div>
                <div class="receipe-grid receipe-grid-three">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="receipe-item receipe-item-black pb-30">
                            <div class="receipe-item-inner">
                                <div class="receipe-image">
                                    <a href="{{ route('shop.show', $relatedProduct['slug']) }}">
                                        <img src="{{ asset($relatedProduct['image']) }}" alt="{{ $relatedProduct['name'] }}">
                                    </a>
                                </div>
                                <div class="receipe-content">
                                    <div class="receipe-info">
                                        <h3><a href="{{ route('shop.show', $relatedProduct['slug']) }}">{{ $relatedProduct['name'] }}</a></h3>
                                        <h4>
                                            {{ $relatedProduct['price_display'] }}
                                            @if (! empty($relatedProduct['compare_price_formatted']))
                                                <del>{{ $relatedProduct['compare_price_formatted'] }}</del>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="receipe-cart receipe-cart-main">
                                        <form method="POST" action="{{ route('cart.store', $relatedProduct['slug']) }}">
                                            @csrf
                                            @if (! empty($relatedProduct['default_option']))
                                                <input type="hidden" name="option" value="{{ $relatedProduct['default_option'] }}">
                                            @endif
                                            <button type="submit" class="receipe-cart-button" aria-label="Add {{ $relatedProduct['name'] }} to basket">
                                                <i class="flaticon-supermarket-basket"></i>
                                                <i class="flaticon-supermarket-basket"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('partials.subscribe-banner', [
        'title' => 'Save it now, order it when you are ready.',
        'text' => 'Browse more of the Max Kebab menu, add favourites to your wishlist, and build a proper basket for dine-in, takeaway, or delivery.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Back To Shop',
        'secondaryUrl' => route('wishlist.index'),
        'secondaryLabel' => 'Open Wishlist',
    ])
@endsection
