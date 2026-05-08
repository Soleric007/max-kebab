<?php
    $title = 'Menu | Max Kebab';
    $description = 'Explore the Max Kebab menu of premium kebabs, burgers, wings, sides, salads, drinks, and meal deals.';
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Our Menu',
        'pageSubtitle' => 'Freshly prepared favourites for dine-in, takeaway, and delivery',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Menu'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="menu-section bg-black p-tb-100">
        <div class="container position-relative">
            <div class="section-title">
                <small>Menu</small>
                <h2 class="color-white">Just Choose From The Best</h2>
            </div>
            <div class="menu-main-carousel-area">
                <div class="menu-main-thumb-nav">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="menu-main-thumb-item menu-main-thumb-black">
                            <div class="menu-main-thumb-inner">
                                <img src="<?php echo e(asset($category['icon'])); ?>" alt="<?php echo e($category['name']); ?>">
                                <p><?php echo e(strtoupper($category['name'])); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="menu-main-details-for">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="menu-main-details-item">
                            <div class="receipe-grid receipe-grid-three">
                                <?php $__currentLoopData = ($menuSections[$category['slug']] ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="receipe-item receipe-item-black pb-30 receipe-grid-item">
                                        <div class="receipe-item-inner">
                                            <div class="receipe-image">
                                                <a href="<?php echo e(route('shop.show', $product['slug'])); ?>">
                                                    <img src="<?php echo e(asset($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
                                                </a>
                                            </div>
                                            <div class="receipe-content">
                                                <div class="receipe-info">
                                                    <h3><a href="<?php echo e(route('shop.show', $product['slug'])); ?>"><?php echo e($product['name']); ?></a></h3>
                                                    <h4>
                                                        <?php echo e($product['price_formatted']); ?>

                                                        <?php if(! empty($product['compare_price_formatted'])): ?>
                                                            <del><?php echo e($product['compare_price_formatted']); ?></del>
                                                        <?php endif; ?>
                                                    </h4>
                                                </div>
                                                <div class="receipe-cart">
                                                    <form method="POST" action="<?php echo e(route('cart.store', $product['slug'])); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="submit" class="receipe-cart-button" aria-label="Add <?php echo e($product['name']); ?> to basket">
                                                            <i class="flaticon-supermarket-basket"></i>
                                                            <i class="flaticon-supermarket-basket"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo e(route('shop.index', ['category' => $category['slug']])); ?>" class="btn load-more-btn">
                                    <span class="load-more-text">View <?php echo e($category['name']); ?></span>
                                    <span class="load-more-icon"><i class="icofont-long-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.order-steps', [
        'orderSteps' => $orderSteps,
        'heading' => '3 Easy Steps To Enjoy',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/menu.blade.php ENDPATH**/ ?>