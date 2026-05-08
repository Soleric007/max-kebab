<?php
    $title = 'About Us | Max Kebab';
    $description = 'Learn more about Max Kebab, our premium street-food identity, authentic flavours, and quality-first service in Northampton.';
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'About Us',
        'pageSubtitle' => 'Modern street food, authentic flavour, and a warm local atmosphere',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About Us'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                    <div class="section-title section-title-left text-center text-md-start m-0">
                        <small>Our Story</small>
                        <h2 class="color-white">A cleaner, better take on the classic kebab shop</h2>
                        <p><?php echo e($brand['name']); ?> was shaped around fresh ingredients, authentic grilled flavour, and a more premium dine-in, takeaway, and delivery experience for Northampton.</p>
                        <p>We keep the menu focused, the kitchen sharp, and the hospitality friendly so every order feels worth coming back for.</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-image-grid">
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner mb-30">
                                <img src="<?php echo e(asset('assets/images/welcome-image-1.jpg')); ?>" alt="Max Kebab interior">
                            </div>
                            <div class="about-image-grid-inner mb-30">
                                <img src="<?php echo e(asset('assets/images/welcome-image-2.jpg')); ?>" alt="Freshly prepared menu items">
                            </div>
                        </div>
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner fluid-height">
                                <img src="<?php echo e(asset('assets/images/welcome-image-3.jpg')); ?>" alt="Dining atmosphere">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="service-section p-tb-100 bg-black">
        <div class="container-fluid">
            <div class="bg-main bg-overlay-transparent contain-box">
                <div class="container">
                    <div class="section-title">
                        <h2 class="color-white">What defines the Max Kebab experience</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                            <div class="service-item">
                                <div class="service-image">
                                    <img src="<?php echo e(asset('assets/images/service-1.jpg')); ?>" alt="Dine in">
                                </div>
                                <div class="service-content">
                                    <h3>1. Dine In</h3>
                                    <p>Comfortable, clean, and friendly for guests who want fresh food served in a stylish atmosphere.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                            <div class="service-item">
                                <div class="service-image">
                                    <img src="<?php echo e(asset('assets/images/service-2.jpg')); ?>" alt="Takeaway">
                                </div>
                                <div class="service-content">
                                    <h3>2. Takeaway</h3>
                                    <p>Fast, well-packed takeaway and delivery with quality that still feels premium when it reaches your door.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                            <div class="service-item">
                                <div class="service-image">
                                    <img src="<?php echo e(asset('assets/images/service-3.jpg')); ?>" alt="Fresh grill">
                                </div>
                                <div class="service-content">
                                    <h3>3. Fresh Grill</h3>
                                    <p>Everything centres on authentic flavour, fresh salad, and properly cooked meat without shortcuts.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="section-title">
                <small>Signature Items</small>
                <h2 class="color-white">A few standout plates from the kitchen</h2>
            </div>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-3 pb-30">
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

    <?php echo $__env->make('partials.reviews', [
        'reviews' => $reviews,
        'heading' => 'Fresh, authentic, friendly, and premium quality. That is the feedback we hear most.',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/pages/about.blade.php ENDPATH**/ ?>