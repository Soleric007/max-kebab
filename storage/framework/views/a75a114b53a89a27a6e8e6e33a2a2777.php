<?php
    $title = 'Max Kebab | Northampton\'s Premium Kebab Experience';
    $description = 'Premium kebab restaurant in Northampton serving fresh wraps, burgers, wings, sides, salads, dine-in favourites, takeaway, and delivery.';
?>



<?php $__env->startSection('content'); ?>
    <div class="header-bg">
        <div class="container-fluid">
            <div class="header-container position-relative p-tb-100">
                <div class="header-page-shape">
                    <div class="header-page-shape-item wow animate__rollIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__slideInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="<?php echo e(asset('assets/images/header-shape-2.png')); ?>" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__slideInRight" data-wow-duration="1.5s" data-wow-delay="0.5s">
                        <img src="<?php echo e(asset('assets/images/header-shape-3.png')); ?>" alt="shape">
                    </div>
                    <div class="header-page-shape-item wow animate__rollIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape">
                    </div>
                </div>
                <div class="header-carousel owl-carousel owl-theme">
                    <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="header-carousel-text max-555 mx-auto me-lg-0 text-center text-lg-start">
                                        <h1 class="color-white"><?php echo e($slide['headline']); ?></h1>
                                        <p><?php echo e($slide['subtext']); ?></p>
                                        <div class="header-carousel-action">
                                            <a href="<?php echo e(route('shop.show', $slide['slug'])); ?>" class="btn">
                                                Order Now <i class="flaticon-shopping-cart-black-shape"></i>
                                            </a>
                                            <p class="header-product-price color-white"><?php echo e($slide['price']); ?> <del><?php echo e($slide['compare_price']); ?></del></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="header-carousel-image wow animate__zoomIn" data-wow-duration="1s" data-wow-delay="0.5s">
                                        <img src="<?php echo e(asset($slide['image'])); ?>" alt="<?php echo e($slide['headline']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                    <div class="section-title section-title-left text-center text-md-start m-0">
                        <small>Welcome To <?php echo e($brand['name']); ?></small>
                        <h2 class="color-white">Authentic grilled flavour with a premium street-food feel</h2>
                        <p><?php echo e($brand['description']); ?></p>
                        <a href="<?php echo e(route('about')); ?>" class="btn">
                            More About Us
                            <i class="flaticon-right-arrow-sketch-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-image-grid">
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner mb-30">
                                <img src="<?php echo e(asset('assets/images/welcome-image-1.jpg')); ?>" alt="restaurant interior">
                            </div>
                            <div class="about-image-grid-inner mb-30">
                                <img src="<?php echo e(asset('assets/images/welcome-image-2.jpg')); ?>" alt="fresh food preparation">
                            </div>
                        </div>
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner fluid-height">
                                <img src="<?php echo e(asset('assets/images/welcome-image-3.jpg')); ?>" alt="shared dining table">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.menu-tabs', [
        'smallTitle' => 'Menu',
        'heading' => 'Just Choose From The Best',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.order-steps', [
        'orderSteps' => $orderSteps,
        'heading' => '3 Easy Steps To Enjoy',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.special-highlights', [
        'ingredientHighlights' => $ingredientHighlights,
        'smallTitle' => 'Speciality',
        'heading' => 'Our Special Ingredients',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="section-title">
                <small>Chef Picks</small>
                <h2 class="color-white">Favourites our guests come back for</h2>
            </div>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="combo-section bg-black pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <small>Combos</small>
                <h2 class="color-white">Meal deals built for proper appetite</h2>
            </div>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $combos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-6 pb-30 wow animate__slideInUp" data-wow-duration="1s" data-wow-delay="0.<?php echo e($index + 1); ?>s">
                        <div class="combo-box">
                            <div class="combo-box-image">
                                <img src="<?php echo e(asset($combo['image'])); ?>" alt="<?php echo e($combo['name']); ?>">
                            </div>
                            <div class="combo-box-content">
                                <h3><?php echo e($combo['name']); ?></h3>
                                <h4><span><?php echo e($combo['category_name']); ?></span> <?php echo e($combo['short_description']); ?></h4>
                                <a href="<?php echo e(route('shop.show', $combo['slug'])); ?>" class="btn">
                                    Order Now
                                    <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                            </div>
                            <div class="combo-offer-shape">
                                <div class="combo-shape-inner">
                                    <small>Only At</small>
                                    <p><?php echo e($combo['price_formatted']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.reviews', ['reviews' => $reviews], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'Fresh food, no shortcuts.',
        'text' => 'Order for dine-in, takeaway, or delivery at Max Kebab and enjoy premium flavour made fresh to order.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Start Your Order',
        'secondaryUrl' => 'tel:' . preg_replace('/\s+/', '', $brand['phone']),
        'secondaryLabel' => 'Call The Shop',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/pages/home.blade.php ENDPATH**/ ?>