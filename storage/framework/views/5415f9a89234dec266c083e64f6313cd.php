<!DOCTYPE html>
<html lang="en">
<head>
    <?php
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
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title><?php echo e($seoTitle); ?></title>
    <meta name="description" content="<?php echo e($seoDescription); ?>">
    <meta name="keywords" content="<?php echo e($seoKeywords); ?>">
    <meta name="author" content="<?php echo e($brand['name']); ?>">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="<?php echo e($seoCanonical); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($seoTitle); ?>">
    <meta property="og:description" content="<?php echo e($seoDescription); ?>">
    <meta property="og:url" content="<?php echo e($seoCanonical); ?>">
    <meta property="og:site_name" content="<?php echo e($brand['name']); ?>">
    <meta property="og:image" content="<?php echo e($seoImage); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($seoTitle); ?>">
    <meta name="twitter:description" content="<?php echo e($seoDescription); ?>">
    <meta name="twitter:image" content="<?php echo e($seoImage); ?>">
    <link rel="icon" href="<?php echo e(asset('assets/images/tab.png')); ?>" type="image/png" sizes="16x16">
    <script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.carousel.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.theme.default.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick-theme.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/meanmenu.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/icofont.min.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/flaticon.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/theme-dark.css')); ?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/max-kebab.css')); ?>" type="text/css" media="all">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="preloader bg-main">
        <div class="preloader-wrapper">
            <div class="preloader-grid">
                <?php for($i = 1; $i <= 9; $i++): ?>
                    <div class="preloader-grid-item preloader-grid-item-<?php echo e($i); ?>"></div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <header class="header">
        <?php echo $__env->make('partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </header>

    <?php echo $__env->make('shared.flash-messages', ['context' => 'storefront'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php if(($showCta ?? true) === true): ?>
        <?php echo $__env->make('partials.cta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('partials.cart-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div id="scrolltop">
        <i class="icofont-long-arrow-up"></i>
    </div>

    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.meanmenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/max-kebab.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/layouts/app.blade.php ENDPATH**/ ?>