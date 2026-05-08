<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $storefront = app(\App\Support\Storefront::class);
        $brand = $brand ?? config('maxkebab.brand');
        $navCategories = $navCategories ?? $storefront->categories();
        $cartPreviewItems = $cartPreviewItems ?? $storefront->cartItems();
        $cartCount = $cartCount ?? $storefront->cartCount();
        $cartSubtotal = $cartSubtotal ?? $storefront->cartSubtotal();
        $cartSubtotalFormatted = $cartSubtotalFormatted ?? $storefront->money($cartSubtotal);
        $wishlistCount = $wishlistCount ?? $storefront->wishlistCount();
        $seoTitle = trim($title ?? $brand['name'].' | '.$brand['tagline']);
        $seoDescription = trim($description ?? $brand['description']);
        $seoKeywords = trim($keywords ?? $brand['keywords']);
        $seoCanonical = url()->current();
        $seoImage = asset('assets/images/combo-4.jpg');
        $socialUrls = collect($brand['socials'] ?? [])
            ->pluck('url')
            ->filter(fn ($url) => filled($url) && $url !== '#')
            ->values()
            ->all();
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Restaurant',
            'name' => $brand['name'],
            'description' => $brand['description'],
            'url' => url('/'),
            'image' => $seoImage,
            'telephone' => $brand['phone'],
            'sameAs' => $socialUrls,
            'hasMap' => $brand['map_url'],
            'menu' => route('menu'),
            'areaServed' => 'Northampton',
            'servesCuisine' => ['Kebab', 'Street Food', 'Burgers', 'Grill'],
            'priceRange' => '££',
            'acceptsReservations' => 'False',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '53 Harborough Rd',
                'addressLocality' => 'Kingsthorpe, Northampton',
                'postalCode' => 'NN2 7SH',
                'addressCountry' => 'GB',
            ],
        ];
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="author" content="{{ $brand['name'] }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ $seoCanonical }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:site_name" content="{{ $brand['name'] }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
    <link rel="icon" href="{{ asset('assets/images/tab.png') }}" type="image/png" sizes="16x16">
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/settings.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/layers.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/navigation.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-dark.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('assets/css/max-kebab.css') }}" type="text/css" media="all">
    @stack('styles')
</head>
<body>
    <div class="preloader bg-main">
        <div class="preloader-wrapper">
            <div class="preloader-grid">
                @for ($i = 1; $i <= 9; $i++)
                    <div class="preloader-grid-item preloader-grid-item-{{ $i }}"></div>
                @endfor
            </div>
        </div>
    </div>

    <header class="header">
        @include('partials.topbar')
        @include('partials.navbar')
    </header>

    @include('shared.flash-messages', ['context' => 'storefront'])

    @yield('content')

    @if (($showCta ?? true) === true)
        @include('partials.cta')
    @endif

    @include('partials.footer')
    @include('partials.cart-modal')

    <div id="scrolltop">
        <i class="icofont-long-arrow-up"></i>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('assets/js/max-kebab.js') }}"></script>
    @stack('scripts')
</body>
</html>
