<?php
    $thumbModifier = $thumbModifier ?? '';
?>

<section class="menu-section menu-section-bg pt-100 pb-70 bg-black">
    <div class="container position-relative">
        <div class="section-title">
            <small><?php echo e($smallTitle ?? 'Menu'); ?></small>
            <h2 class="color-white"><?php echo e($heading ?? 'Just Choose From The Best'); ?></h2>
        </div>
        <div class="menu-main-carousel-area">
            <div class="menu-main-thumb-nav">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="menu-main-thumb-item <?php echo e($thumbModifier); ?>">
                        <div class="menu-main-thumb-inner">
                            <img src="<?php echo e(asset($category['icon'])); ?>" alt="<?php echo e($category['name']); ?>">
                            <p><?php echo e($category['name']); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="menu-main-details-for">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="menu-main-details-item">
                        <div class="menu-details-carousel">
                            <?php $__currentLoopData = ($menuSections[$category['slug']] ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="menu-details-carousel-item menu-details-carousel-black">
                                    <h3><?php echo e($product['name']); ?></h3>
                                    <p><?php echo e($product['short_description']); ?></p>
                                    <h4 class="menu-price"><?php echo e($product['price_formatted']); ?></h4>
                                    <form method="POST" action="<?php echo e(route('cart.store', $product['slug'])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-yellow">
                                            Add To Basket <i class="flaticon-shopping-cart-black-shape"></i>
                                        </button>
                                    </form>
                                    <div class="menu-details-carousel-image">
                                        <img src="<?php echo e(asset($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/menu-tabs.blade.php ENDPATH**/ ?>