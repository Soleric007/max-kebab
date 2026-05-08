<section class="subscribe-section mural-bg pt-100 pb-70 bg-main">
    <div class="container">
        <div class="subscribe-grid">
            <div class="subscribe-item">
                <div class="section-title text-center text-lg-start m-0">
                    <h2 class="color-white">{{ $title ?? 'Fresh food, no shortcuts.' }}</h2>
                    <p>{{ $text ?? 'Order for dine-in, takeaway, or delivery at Max Kebab and enjoy premium flavour made fresh to order.' }}</p>
                </div>
            </div>
            <div class="subscribe-item">
                <div class="subscribe-action-group">
                    <a href="{{ $primaryUrl ?? route('shop.index') }}" class="btn btn-yellow">
                        {{ $primaryLabel ?? 'Start Your Order' }}
                        <i class="flaticon-right-arrow-sketch-1"></i>
                    </a>
                    <a href="{{ $secondaryUrl ?? 'tel:' . preg_replace('/\\s+/', '', $brand['phone']) }}" class="btn">
                        {{ $secondaryLabel ?? 'Call The Shop' }}
                        <i class="flaticon-smartphone-call"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
