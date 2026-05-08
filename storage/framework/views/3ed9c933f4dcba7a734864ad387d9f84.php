<section class="subscribe-section mural-bg pt-100 pb-70 bg-main">
    <div class="container">
        <div class="subscribe-grid">
            <div class="subscribe-item">
                <div class="section-title text-center text-lg-start m-0">
                    <h2 class="color-white"><?php echo e($title ?? 'Fresh food, no shortcuts.'); ?></h2>
                    <p><?php echo e($text ?? 'Order for dine-in, takeaway, or delivery at Max Kebab and enjoy premium flavour made fresh to order.'); ?></p>
                </div>
            </div>
            <div class="subscribe-item">
                <div class="subscribe-action-group">
                    <a href="<?php echo e($primaryUrl ?? route('shop.index')); ?>" class="btn btn-yellow">
                        <?php echo e($primaryLabel ?? 'Start Your Order'); ?>

                        <i class="flaticon-right-arrow-sketch-1"></i>
                    </a>
                    <a href="<?php echo e($secondaryUrl ?? 'tel:' . preg_replace('/\\s+/', '', $brand['phone'])); ?>" class="btn">
                        <?php echo e($secondaryLabel ?? 'Call The Shop'); ?>

                        <i class="flaticon-smartphone-call"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/subscribe-banner.blade.php ENDPATH**/ ?>