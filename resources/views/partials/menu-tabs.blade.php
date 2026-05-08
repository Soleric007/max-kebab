@php
    $thumbModifier = $thumbModifier ?? '';
@endphp

<section class="menu-section menu-section-bg pt-100 pb-70 bg-black">
    <div class="container position-relative">
        <div class="section-title">
            <small>{{ $smallTitle ?? 'Menu' }}</small>
            <h2 class="color-white">{{ $heading ?? 'Just Choose From The Best' }}</h2>
        </div>
        <div class="menu-main-carousel-area">
            <div class="menu-main-thumb-nav">
                @foreach ($categories as $category)
                    <div class="menu-main-thumb-item {{ $thumbModifier }}">
                        <div class="menu-main-thumb-inner">
                            <img src="{{ asset($category['icon']) }}" alt="{{ $category['name'] }}">
                            <p>{{ $category['name'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="menu-main-details-for">
                @foreach ($categories as $category)
                    <div class="menu-main-details-item">
                        <div class="menu-details-carousel">
                            @foreach (($menuSections[$category['slug']] ?? collect()) as $product)
                                <div class="menu-details-carousel-item menu-details-carousel-black">
                                    <h3>{{ $product['name'] }}</h3>
                                    <p>{{ $product['short_description'] }}</p>
                                    @if (! empty($product['options']))
                                        <p class="menu-option-copy">{{ collect($product['options'])->pluck('display')->join(' / ') }}</p>
                                    @endif
                                    <h4 class="menu-price">{{ $product['price_display'] }}</h4>
                                    <form method="POST" action="{{ route('cart.store', $product['slug']) }}">
                                        @csrf
                                        @if (! empty($product['default_option']))
                                            <input type="hidden" name="option" value="{{ $product['default_option'] }}">
                                        @endif
                                        <button type="submit" class="btn btn-yellow">
                                            Add To Basket <i class="flaticon-shopping-cart-black-shape"></i>
                                        </button>
                                    </form>
                                    <div class="menu-details-carousel-image">
                                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
