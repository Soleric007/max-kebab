@php
    $title = 'Wishlist | Max Kebab';
    $description = 'Save your favourite Max Kebab menu items and add them to your basket when you are ready.';
    $showCta = false;
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Wishlist',
        'pageSubtitle' => 'Keep track of the dishes you want next',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Wishlist'],
        ],
    ])

    <div class="cart-section p-tb-100 bg-black">
        <div class="container">
            @if ($wishlistItems->isEmpty())
                <div class="empty-state">
                    <h3>Your wishlist is empty.</h3>
                    <p>Save a few favourites so they are easy to find next time.</p>
                    <a href="{{ route('shop.index') }}" class="btn">Browse The Shop</a>
                </div>
            @else
                <div class="cart-table cart-table-dark">
                    <table>
                        <tbody>
                            @foreach ($wishlistItems as $product)
                                <tr>
                                    <td class="cancel">
                                        <form action="{{ route('wishlist.destroy', $product['slug']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cart-icon-button"><i class="flaticon-cancel"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="product-table-info">
                                            <div class="product-table-thumb">
                                                <a href="{{ route('shop.show', $product['slug']) }}">
                                                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="td-product-name"><a href="{{ route('shop.show', $product['slug']) }}">{{ $product['name'] }}</a></td>
                                    <td>{{ $product['sku'] }}</td>
                                    <td>{{ $product['price_formatted'] }}</td>
                                    <td>
                                        <form action="{{ route('cart.store', $product['slug']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn">Add To Basket <i class="flaticon-shopping-cart-black-shape"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @include('partials.subscribe-banner', [
        'title' => 'Keep your favourites close.',
        'text' => 'Move saved dishes into your basket whenever you are ready to place a Max Kebab dine-in, takeaway, or delivery order.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Browse More Items',
        'secondaryUrl' => route('cart.index'),
        'secondaryLabel' => 'View Basket',
    ])
@endsection
