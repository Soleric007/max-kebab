@props(['product'])

@php
    $storefront = app(\App\Support\Storefront::class);
    $isWishlisted = $storefront->inWishlist($product['slug']);
@endphp

<div class="product-card product-card-dark">
    <div class="product-card-thumb">
        <div class="product-card-thumb-inner">
            <a href="{{ route('shop.show', $product['slug']) }}" class="product-card-image-link">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
            </a>
            <div class="product-card-button">
                <form method="POST" action="{{ route('cart.store', $product['slug']) }}">
                    @csrf
                    @if (! empty($product['default_option']))
                        <input type="hidden" name="option" value="{{ $product['default_option'] }}">
                    @endif
                    <button type="submit" class="btn btn-yellow">Add To Basket</button>
                </form>
                @if ($isWishlisted)
                    <form method="POST" action="{{ route('wishlist.destroy', $product['slug']) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Wishlisted</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('wishlist.store', $product['slug']) }}">
                        @csrf
                        <button type="submit" class="btn">Add To Wishlist</button>
                    </form>
                @endif
            </div>
            @if (! empty($product['badge']))
                <div class="product-status product-status-danger">{{ $product['badge'] }}</div>
            @endif
        </div>
    </div>
    <div class="product-card-content">
        <h3><a href="{{ route('shop.show', $product['slug']) }}">{{ $product['name'] }}</a></h3>
        <h4 class="product-price">
            {{ $product['price_display'] }}
            @if (! empty($product['compare_price_formatted']))
                <small>{{ $product['compare_price_formatted'] }}</small>
            @endif
        </h4>
    </div>
</div>
