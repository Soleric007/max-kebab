<div class="fixed-top">
    <div class="navbar-area navbar-dark">
        <div class="mobile-nav">
            <a href="{{ route('home') }}" class="navbar-brand brand-logo-link">
                <img src="{{ asset($brand['logo'] ?? 'assets/images/maxkebab.png') }}" alt="{{ $brand['name'] }} logo" class="brand-logo">
                <span class="logo-text">MAX <span>KEBAB</span></span>
            </a>
            <div class="navbar-option mobile-navbar-option d-flex align-items-center">
                <div class="navbar-option-item navbar-option-search">
                    <button class="dropdown-toggle" type="button" id="mobileSearchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-loupe"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="mobileSearchDropdown">
                        <form method="GET" action="{{ route('shop.index') }}">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit"><i class="flaticon-loupe"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="navbar-option-item navbar-option-cart">
                    <a href="{{ route('cart.index') }}" aria-label="Basket"><i class="flaticon-supermarket-basket"></i></a>
                    @if ($cartCount > 0)
                        <span class="option-badge">{{ $cartCount }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand brand-logo-link" href="{{ route('home') }}">
                        <img src="{{ asset($brand['logo'] ?? 'assets/images/maxkebab.png') }}" alt="{{ $brand['name'] }} logo" class="brand-logo">
                        <span class="logo-text">MAX <span>KEBAB</span></span>
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">MENU</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}">SHOP</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}">CONTACT US</a>
                            </li>
                            <li class="nav-item mobile-only-nav-item">
                                <a href="{{ route('wishlist.index') }}" class="nav-link">WISHLIST @if ($wishlistCount > 0) ({{ $wishlistCount }}) @endif</a>
                            </li>
                            <li class="nav-item mobile-only-nav-item">
                                <a href="{{ route('cart.index') }}" class="nav-link">CART @if ($cartCount > 0) ({{ $cartCount }}) @endif</a>
                            </li>
                            <li class="nav-item mobile-only-nav-item">
                                <a href="{{ route('shop.index') }}" class="nav-link">ORDER NOW</a>
                            </li>
                        </ul>
                        <div class="navbar-option d-flex align-items-center">
                            <div class="navbar-option-item navbar-option-cart">
                                <a href="{{ route('wishlist.index') }}" aria-label="Wishlist"><i class="flaticon-heart"></i></a>
                                @if ($wishlistCount > 0)
                                    <span class="option-badge">{{ $wishlistCount }}</span>
                                @endif
                            </div>
                            <div class="navbar-option-item navbar-option-search">
                                <button class="dropdown-toggle" type="button" id="desktopSearchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-loupe"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="desktopSearchDropdown">
                                    <form method="GET" action="{{ route('shop.index') }}">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                                            <button type="submit"><i class="flaticon-loupe"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="navbar-option-item navbar-option-cart">
                                <a href="#" class="productCart" aria-label="Basket"><i class="flaticon-supermarket-basket"></i></a>
                                @if ($cartCount > 0)
                                    <span class="option-badge">{{ $cartCount }}</span>
                                @endif
                            </div>
                            <div class="navbar-option-item navbar-option-order">
                                <a href="{{ route('shop.index') }}" class="btn text-nowrap">
                                    Order Now <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
