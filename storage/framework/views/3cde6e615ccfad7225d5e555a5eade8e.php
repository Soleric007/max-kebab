<section class="subscribe-section mural-bg pt-100 pb-70 bg-main">
    <div class="container">
        <div class="subscribe-grid">
            <div class="subscribe-item">
                <div class="section-title text-center text-lg-start m-0">
                    <h2 class="color-white">Fresh food, no shortcuts.</h2>
                    <p>Order for dine-in, takeaway, or delivery at <?php echo e($brand['name']); ?> and enjoy premium flavour made fresh to order.</p>
                </div>
            </div>
            <div class="subscribe-item">
                <div class="cta-action-group">
                    <a href="<?php echo e(route('shop.index')); ?>" class="btn btn-yellow">Start Your Order <i class="flaticon-right-arrow-sketch-1"></i></a>
                    <a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>" class="btn">Call The Shop <i class="flaticon-smartphone-call"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/cta.blade.php ENDPATH**/ ?>