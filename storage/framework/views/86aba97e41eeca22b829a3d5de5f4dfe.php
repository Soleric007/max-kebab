<div class="fixed-top">
    <div class="navbar-area navbar-dark">
        <div class="mobile-nav">
            <a href="<?php echo e(route('home')); ?>" class="navbar-brand">
                <span class="logo-text">Max <span>Kebab</span></span>
            </a>
            <div class="navbar-option mobile-navbar-option d-flex align-items-center">
                <div class="navbar-option-item navbar-option-search">
                    <button class="dropdown-toggle" type="button" id="mobileSearchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-loupe"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="mobileSearchDropdown">
                        <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo e(request('search')); ?>">
                                <button type="submit"><i class="flaticon-loupe"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="navbar-option-item navbar-option-dots mobile-hide">
                    <button class="dropdown-toggle" type="button" id="mobileOptionDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-menu-1"></i>
                    </button>
                    <div class="dropdown-menu mobile-action-menu" aria-labelledby="mobileOptionDropdown">
                        <div class="navbar-option-item navbar-option-cart">
                            <a href="<?php echo e(route('wishlist.index')); ?>" aria-label="Wishlist"><i class="flaticon-heart"></i></a>
                            <?php if($wishlistCount > 0): ?>
                                <span class="option-badge"><?php echo e($wishlistCount); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="navbar-option-item navbar-option-cart">
                            <a href="#" class="productCart" aria-label="Basket"><i class="flaticon-supermarket-basket"></i></a>
                            <?php if($cartCount > 0): ?>
                                <span class="option-badge"><?php echo e($cartCount); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="navbar-option-item navbar-option-order">
                            <a href="<?php echo e(route('shop.index')); ?>" class="btn">
                                Order Now <i class="flaticon-shopping-cart-black-shape"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="navbar-option-item navbar-option-cart mobile-block">
                    <a href="<?php echo e(route('wishlist.index')); ?>" aria-label="Wishlist"><i class="flaticon-heart"></i></a>
                    <?php if($wishlistCount > 0): ?>
                        <span class="option-badge"><?php echo e($wishlistCount); ?></span>
                    <?php endif; ?>
                </div>
                <div class="navbar-option-item navbar-option-cart mobile-block">
                    <a href="#" class="productCart" aria-label="Basket"><i class="flaticon-supermarket-basket"></i></a>
                    <?php if($cartCount > 0): ?>
                        <span class="option-badge"><?php echo e($cartCount); ?></span>
                    <?php endif; ?>
                </div>
                <div class="navbar-option-item navbar-option-order mobile-block">
                    <a href="<?php echo e(route('shop.index')); ?>" class="btn">
                        <i class="flaticon-shopping-cart-black-shape"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                        <span class="logo-text">Max <span>Kebab</span></span>
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('menu')); ?>" class="nav-link <?php echo e(request()->routeIs('menu') ? 'active' : ''); ?>">MENU</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('shop.index')); ?>" class="nav-link <?php echo e(request()->routeIs('shop.*') ? 'active' : ''); ?>">SHOP</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('about')); ?>" class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('contact')); ?>" class="nav-link <?php echo e(request()->routeIs('contact*') ? 'active' : ''); ?>">CONTACT US</a>
                            </li>
                        </ul>
                        <div class="navbar-option d-flex align-items-center">
                            <div class="navbar-option-item navbar-option-cart">
                                <a href="<?php echo e(route('wishlist.index')); ?>" aria-label="Wishlist"><i class="flaticon-heart"></i></a>
                                <?php if($wishlistCount > 0): ?>
                                    <span class="option-badge"><?php echo e($wishlistCount); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="navbar-option-item navbar-option-search">
                                <button class="dropdown-toggle" type="button" id="desktopSearchDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-loupe"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="desktopSearchDropdown">
                                    <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo e(request('search')); ?>">
                                            <button type="submit"><i class="flaticon-loupe"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="navbar-option-item navbar-option-cart">
                                <a href="#" class="productCart" aria-label="Basket"><i class="flaticon-supermarket-basket"></i></a>
                                <?php if($cartCount > 0): ?>
                                    <span class="option-badge"><?php echo e($cartCount); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="navbar-option-item navbar-option-order">
                                <a href="<?php echo e(route('shop.index')); ?>" class="btn text-nowrap">
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
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/navbar.blade.php ENDPATH**/ ?>