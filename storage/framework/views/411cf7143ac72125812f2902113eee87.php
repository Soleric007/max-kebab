<?php
    $title = 'Wishlist | Max Kebab';
    $description = 'Save your favourite Max Kebab menu items and add them to your basket when you are ready.';
    $showCta = false;
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Wishlist',
        'pageSubtitle' => 'Keep track of the dishes you want next',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Wishlist'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="cart-section p-tb-100 bg-black">
        <div class="container">
            <?php if($wishlistItems->isEmpty()): ?>
                <div class="empty-state">
                    <h3>Your wishlist is empty.</h3>
                    <p>Save a few favourites so they are easy to find next time.</p>
                    <a href="<?php echo e(route('shop.index')); ?>" class="btn">Browse The Shop</a>
                </div>
            <?php else: ?>
                <div class="cart-table cart-table-dark">
                    <table>
                        <tbody>
                            <?php $__currentLoopData = $wishlistItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="cancel">
                                        <form action="<?php echo e(route('wishlist.destroy', $product['slug'])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="cart-icon-button"><i class="flaticon-cancel"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="product-table-info">
                                            <div class="product-table-thumb">
                                                <a href="<?php echo e(route('shop.show', $product['slug'])); ?>">
                                                    <img src="<?php echo e(asset($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="td-product-name"><a href="<?php echo e(route('shop.show', $product['slug'])); ?>"><?php echo e($product['name']); ?></a></td>
                                    <td><?php echo e($product['sku']); ?></td>
                                    <td><?php echo e($product['price_formatted']); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('cart.store', $product['slug'])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn">Add To Basket <i class="flaticon-shopping-cart-black-shape"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'Keep your favourites close.',
        'text' => 'Move saved dishes into your basket whenever you are ready to place a Max Kebab dine-in, takeaway, or delivery order.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Browse More Items',
        'secondaryUrl' => route('cart.index'),
        'secondaryLabel' => 'View Basket',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/wishlist.blade.php ENDPATH**/ ?>