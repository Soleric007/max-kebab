<?php
    $title = 'Shop | Max Kebab';
    $description = 'Order premium kebabs, burgers, wings, sides, drinks, and meal deals from Max Kebab.';
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Shop',
        'pageSubtitle' => 'Build your order from our premium restaurant menu',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-9 pb-30">
                    <div class="product-list-header">
                        <div class="product-list-header-item">
                            <div class="product-list-result">
                                <p>Showing <?php echo e($products->count()); ?> result<?php echo e($products->count() === 1 ? '' : 's'); ?></p>
                            </div>
                        </div>
                        <div class="product-list-header-item">
                            <div class="product-list-action">
                                <div class="product-list-form">
                                    <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                                        <?php if(! empty($filters['search'])): ?>
                                            <input type="hidden" name="search" value="<?php echo e($filters['search']); ?>">
                                        <?php endif; ?>
                                        <?php if(! empty($filters['category'])): ?>
                                            <input type="hidden" name="category" value="<?php echo e($filters['category']); ?>">
                                        <?php endif; ?>
                                        <select name="sort" onchange="this.form.submit()">
                                            <option value="popular" <?php if(($filters['sort'] ?? 'popular') === 'popular'): echo 'selected'; endif; ?>>Sort By Popular</option>
                                            <option value="lowtohigh" <?php if(($filters['sort'] ?? '') === 'lowtohigh'): echo 'selected'; endif; ?>>Sort By Price: Low To High</option>
                                            <option value="hightolow" <?php if(($filters['sort'] ?? '') === 'hightolow'): echo 'selected'; endif; ?>>Sort By Price: High To Low</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <div class="row justify-content-center">
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-12">
                                    <div class="empty-state">
                                        <h3>No items matched your search.</h3>
                                        <p>Try a different category or clear the filters to see the full menu.</p>
                                        <a href="<?php echo e(route('shop.index')); ?>" class="btn">View Full Shop</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 pb-30">
                    <div class="sidebar-item around-border sidebar-search">
                        <form method="GET" action="<?php echo e(route('shop.index')); ?>">
                            <?php if(! empty($filters['category'])): ?>
                                <input type="hidden" name="category" value="<?php echo e($filters['category']); ?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo e($filters['search'] ?? ''); ?>">
                                <button type="submit"><i class="flaticon-loupe"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-title">
                            <h3 class="color-white">Categories</h3>
                        </div>
                        <ul class="sidebar-list">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('shop.index', ['category' => $category['slug']])); ?>"><?php echo e($category['name']); ?> <span>(<?php echo e($category['count']); ?>)</span></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-title">
                            <h3 class="color-white">Popular</h3>
                        </div>
                        <div class="sidebar-recent-post">
                            <?php $__currentLoopData = $popularProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="sidebar-recent-item">
                                    <div class="sidebar-recent-thumb">
                                        <a href="<?php echo e(route('shop.show', $product['slug'])); ?>"><img src="<?php echo e(asset($product['image'])); ?>" alt="<?php echo e($product['name']); ?>"></a>
                                    </div>
                                    <div class="sidebar-recent-content">
                                        <h3><a href="<?php echo e(route('shop.show', $product['slug'])); ?>"><?php echo e($product['name']); ?></a></h3>
                                        <h4 class="product-price"><?php echo e($product['price_display']); ?></h4>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'Build your basket your way.',
        'text' => 'Browse the full Max Kebab shop, save favourites, and check out with a quick dine-in, takeaway, or delivery order.',
        'primaryUrl' => route('cart.index'),
        'primaryLabel' => 'View Basket',
        'secondaryUrl' => route('contact'),
        'secondaryLabel' => 'Find The Shop',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/shop.blade.php ENDPATH**/ ?>