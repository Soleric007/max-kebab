<?php
    $title = 'Order Confirmed | Max Kebab';
    $description = 'Your Max Kebab order has been received.';
    $showCta = false;
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Order Confirmed',
        'pageSubtitle' => 'Thanks for ordering from Max Kebab',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Order Confirmed'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="cart-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="empty-state success-state">
                <h3>Order <?php echo e($order->reference); ?> is in.</h3>
                <p>We have received your order for <?php echo e(ucfirst(str_replace('_', ' ', $order->order_type))); ?>. If needed, call the shop on <a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>"><?php echo e($brand['phone_display']); ?></a>. <?php if($order->email): ?>We will also send status updates to <?php echo e($order->email); ?>.<?php endif; ?></p>
            </div>
            <div class="row justify-content-center mt-50">
                <div class="col-sm-12 col-md-8 col-lg-6 pb-30">
                    <div class="cart-details">
                        <h3 class="cart-details-title color-white">Order Summary</h3>
                        <div class="cart-total-box">
                            <div class="cart-total-item pt-0">
                                <h4>Name</h4>
                                <p><?php echo e($order->customer_name); ?></p>
                            </div>
                            <div class="cart-total-item">
                                <h4>Phone</h4>
                                <p><?php echo e($order->phone); ?></p>
                            </div>
                            <div class="cart-total-item">
                                <h4>Type</h4>
                                <p><?php echo e(ucfirst(str_replace('_', ' ', $order->order_type))); ?></p>
                            </div>
                            <?php if($order->collection_time): ?>
                                <div class="cart-total-item">
                                    <h4>Preferred Time</h4>
                                    <p><?php echo e($order->collection_time); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if($order->order_type === 'delivery' && $order->delivery_postcode): ?>
                                <div class="cart-total-item">
                                    <h4>Delivery Postcode</h4>
                                    <p><?php echo e($order->delivery_postcode); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if($order->order_type === 'delivery' && $order->delivery_address): ?>
                                <div class="cart-total-item">
                                    <h4>Delivery Address</h4>
                                    <p><?php echo e($order->delivery_address); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cart-total-item">
                                    <h4>
                                        <?php echo e($item->product_name); ?> x<?php echo e($item->quantity); ?>

                                        <?php if($item->selected_option): ?>
                                            <span class="cart-item-meta">Option: <?php echo e($item->selected_option); ?></span>
                                        <?php endif; ?>
                                    </h4>
                                    <p>£<?php echo e(number_format((float) $item->line_total, 2)); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="cart-total-item cart-total-bold">
                                <h4 class="color-white">Total</h4>
                                <p>£<?php echo e(number_format((float) $order->total, 2)); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo e(route('shop.index')); ?>" class="btn">Order Again</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/pages/order-success.blade.php ENDPATH**/ ?>