@php
    $socialLinks = collect($brand['socials'] ?? [])
        ->filter(fn (array $social) => filled($social['url'] ?? null) && ($social['url'] ?? null) !== '#')
        ->values();
@endphp

<footer class="bg-overlay-1 bg-black">
    <div class="footer-upper pt-100 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-4 order-2 order-lg-1">
                    <div class="footer-content-list footer-content-item">
                        <div class="footer-content-title">
                            <h3>Explore</h3>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-lg-nowrap desk-pad-right-30">
                            <ul class="footer-details footer-list">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('menu') }}">Menu</a></li>
                                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                            <ul class="footer-details footer-list">
                                <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                                <li><a href="{{ route('cart.index') }}">Basket</a></li>
                                <li><a href="{{ route('checkout.index') }}">Checkout</a></li>
                                <li><a href="{{ $brand['map_url'] }}" target="_blank" rel="noopener">Find Us</a></li>
                                <li><a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}">Call Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 order-1 order-lg-2">
                    <div class="footer-content-item text-start text-lg-center">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}" class="brand-logo-link brand-logo-link-footer">
                                <img src="{{ asset($brand['logo'] ?? 'assets/images/maxkebab.png') }}" alt="{{ $brand['name'] }} logo" class="brand-logo brand-logo-footer">
                            </a>
                        </div>
                        <ul class="footer-details footer-address">
                            <li>{{ $brand['address'] }}</li>
                            <li><span>Hotline:</span><a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}">{{ $brand['phone_display'] }}</a></li>
                            <li><span>Service:</span> {{ $brand['service_modes'] }}</li>
                        </ul>
                        @if ($socialLinks->isNotEmpty())
                            <div class="footer-follow">
                                <p>Follow Us:</p>
                                <ul class="social-list social-list-white">
                                    @foreach ($socialLinks as $social)
                                        <li>
                                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}">
                                                @if (! empty($social['icon'] ?? null))
                                                    <i class="{{ $social['icon'] }}"></i>
                                                @else
                                                    <span class="social-label-icon">{{ $social['text_icon'] ?? substr($social['label'], 0, 2) }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 order-3">
                    <div class="footer-content-list footer-content-item desk-pad-left-30">
                        <div class="footer-content-title">
                            <h3>Opening & Service</h3>
                        </div>
                        <ul class="footer-details footer-time">
                            @foreach ($brand['hours'] as $hour)
                                <li>{{ $hour['day'] }}: <span>{{ $hour['hours'] }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-lower">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="footer-lower-item">
                    <div class="footer-copyright-text footer-copyright-text-red">
                        <p>&copy; {{ now()->year }} {{ $brand['name'] }}. Premium kebab, made fresh in Northampton.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
