<div class="cart-modal-wrapper">
    <div class="cart-modal modal-item">
        <div class="cart-modal-header">
            <h3 class="color-white">Basket {{ $cartCount }}</h3>
            <div class="cart-modal-close">
                <i class="flaticon-cancel"></i>
            </div>
        </div>
        <div class="cart-modal-body">
            <h2 class="color-white">Your Order</h2>
            @forelse ($cartPreviewItems as $item)
                <div class="cart-modal-product">
                    <div class="cart-modal-thumb">
                        <a href="{{ route('shop.show', $item['slug']) }}">
                            <img src="{{ asset($item['product']['image']) }}" alt="{{ $item['product']['name'] }}">
                        </a>
                    </div>
                    <div class="cart-modal-content">
                        <h4><a href="{{ route('shop.show', $item['slug']) }}">{{ $item['product']['name'] }}</a></h4>
                        @if ($item['selected_option'])
                            <p class="cart-item-meta">Option: {{ $item['selected_option_label'] ?? $item['selected_option'] }}</p>
                        @endif
                        <div class="cart-modal-action">
                            <div class="cart-modal-action-item">
                                <div class="cart-modal-quantity">
                                    <p>{{ $item['quantity'] }}</p>
                                    <p>x</p>
                                    <p class="cart-quantity-price">{{ $item['unit_price_formatted'] }}</p>
                                </div>
                            </div>
                            <div class="cart-modal-action-item">
                                <div class="cart-modal-delete">
                                    <form action="{{ route('cart.destroy', $item['key']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart-icon-button" aria-label="Remove {{ $item['product']['name'] }}">
                                            <i class="icofont-ui-delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state compact-empty-state">
                    <p>Your basket is empty right now.</p>
                </div>
            @endforelse

            <div class="cart-modal-total">
                <h3 class="color-white">Subtotal</h3>
                <h3 class="color-white">{{ $cartSubtotalFormatted }}</h3>
            </div>
            <div class="cart-modal-button">
                <a href="{{ route('checkout.index') }}" class="btn full-width">Proceed To Checkout</a>
                <a href="{{ route('cart.index') }}" class="btn btn-yellow full-width">View Basket</a>
            </div>
        </div>
    </div>
</div>
