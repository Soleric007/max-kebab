<?php
    $title = 'Your Basket | Max Kebab';
    $description = 'Review your Max Kebab basket and continue to checkout.';
    $showCta = false;
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Cart',
        'pageSubtitle' => 'Review your order before checkout',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Cart'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="cart-section pt-100 pb-70 bg-black">
        <div class="container">
            <?php if($cartItems->isEmpty()): ?>
                <div class="empty-state">
                    <h3>Your basket is empty.</h3>
                    <p>Browse the menu and add your favourites to get started.</p>
                    <a href="<?php echo e(route('shop.index')); ?>" class="btn">Shop Now</a>
                </div>
            <?php else: ?>
                <div class="cart-table cart-table-dark">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Product</th>
                                <th>Id</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="cancel">
                                        <form action="<?php echo e(route('cart.destroy', $item['key'])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="cart-icon-button"><i class="flaticon-cancel"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="product-table-info">
                                            <div class="product-table-thumb">
                                                <img src="<?php echo e(asset($item['product']['image'])); ?>" alt="<?php echo e($item['product']['name']); ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="td-product-name">
                                        <a href="<?php echo e(route('shop.show', $item['slug'])); ?>"><?php echo e($item['product']['name']); ?></a>
                                        <?php if($item['selected_option']): ?>
                                            <span class="cart-item-meta">Option: <?php echo e($item['selected_option']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item['product']['sku']); ?></td>
                                    <td><?php echo e($item['product']['price_formatted']); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('cart.update', $item['key'])); ?>" method="POST" class="cart-row-update">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <div class="cart-quantity">
                                                <button class="qu-btn dec" type="button">-</button>
                                                <input type="text" name="quantity" class="qu-input" value="<?php echo e($item['quantity']); ?>">
                                                <button class="qu-btn inc" type="button">+</button>
                                            </div>
                                            <button type="submit" class="btn btn-small mt-10">Update</button>
                                        </form>
                                    </td>
                                    <td class="td-total-price"><?php echo e($item['line_total_formatted']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-between align-items-center mt-30">
                    <div class="col-sm-12 col-md-7 col-lg-5">
                        <div class="cart-coupon cart-info-item">
                            <div class="cart-note-box">
                                <h4 class="color-white">Service Note</h4>
                                <p><?php echo e($brand['service_modes']); ?>. Delivery details are confirmed during checkout.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="cart-update cart-info-item">
                            <a href="<?php echo e(route('shop.index')); ?>" class="btn full-width">Continue Shopping</a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-8 col-lg-6 pb-30">
                        <div class="cart-details mt-20">
                            <h3 class="cart-details-title color-white">Cart Totals</h3>
                            <div class="cart-total-box">
                                <div class="cart-total-item">
                                    <h4>Sub Total</h4>
                                    <p><?php echo e($subtotalFormatted); ?></p>
                                </div>
                                <div class="cart-total-item">
                                    <h4>Fulfilment</h4>
                                    <p><?php echo e($brand['service_modes']); ?></p>
                                </div>
                                <div class="cart-total-item cart-total-bold">
                                    <h4 class="color-white">Total</h4>
                                    <p><?php echo e($subtotalFormatted); ?></p>
                                </div>
                            </div>
                            <a href="<?php echo e(route('checkout.index')); ?>" class="btn">Proceed To Checkout</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'One step away from checkout.',
        'text' => 'Review your basket, make any changes, and continue to place your Max Kebab dine-in, takeaway, or delivery order.',
        'primaryUrl' => route('checkout.index'),
        'primaryLabel' => 'Go To Checkout',
        'secondaryUrl' => route('shop.index'),
        'secondaryLabel' => 'Continue Shopping',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/cart.blade.php ENDPATH**/ ?>