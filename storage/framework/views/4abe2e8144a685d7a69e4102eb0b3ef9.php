<?php
    $socialLinks = collect($brand['socials'] ?? [])
        ->filter(fn (array $social) => filled($social['url'] ?? null) && ($social['url'] ?? null) !== '#')
        ->values();
?>

<footer class="bg-overlay-1 bg-black">
    <div class="footer-upper pt-100 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-4 order-2 order-lg-1">
                    <div class="footer-content-list footer-content-item">
                        <div class="footer-content-title">
                            <h3>Explore</h3>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap flex-lg-nowrap desk-pad-right-30">
                            <ul class="footer-details footer-list">
                                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                <li><a href="<?php echo e(route('menu')); ?>">Menu</a></li>
                                <li><a href="<?php echo e(route('shop.index')); ?>">Shop</a></li>
                                <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                                <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                            </ul>
                            <ul class="footer-details footer-list">
                                <li><a href="<?php echo e(route('wishlist.index')); ?>">Wishlist</a></li>
                                <li><a href="<?php echo e(route('cart.index')); ?>">Basket</a></li>
                                <li><a href="<?php echo e(route('checkout.index')); ?>">Checkout</a></li>
                                <li><a href="<?php echo e($brand['map_url']); ?>" target="_blank" rel="noopener">Find Us</a></li>
                                <li><a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>">Call Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 order-1 order-lg-2">
                    <div class="footer-content-item text-start text-lg-center">
                        <div class="footer-logo">
                            <a href="<?php echo e(route('home')); ?>" class="logo-text footer-logo-text">Max <span>Kebab</span></a>
                        </div>
                        <ul class="footer-details footer-address">
                            <li><?php echo e($brand['address']); ?></li>
                            <li><span>Hotline:</span><a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>"><?php echo e($brand['phone_display']); ?></a></li>
                            <li><span>Service:</span> <?php echo e($brand['service_modes']); ?></li>
                        </ul>
                        <?php if($socialLinks->isNotEmpty()): ?>
                            <div class="footer-follow">
                                <p>Follow Us:</p>
                                <ul class="social-list social-list-white">
                                    <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e($social['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo e($social['label']); ?>">
                                                <?php if(! empty($social['icon'] ?? null)): ?>
                                                    <i class="<?php echo e($social['icon']); ?>"></i>
                                                <?php else: ?>
                                                    <span class="social-label-icon"><?php echo e($social['text_icon'] ?? substr($social['label'], 0, 2)); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 order-3">
                    <div class="footer-content-list footer-content-item desk-pad-left-30">
                        <div class="footer-content-title">
                            <h3>Opening & Service</h3>
                        </div>
                        <ul class="footer-details footer-time">
                            <?php $__currentLoopData = $brand['hours']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($hour['day']); ?>: <span><?php echo e($hour['hours']); ?></span></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-lower">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="footer-lower-item">
                    <div class="footer-copyright-text footer-copyright-text-red">
                        <p>&copy; <?php echo e(now()->year); ?> <?php echo e($brand['name']); ?>. Premium kebab, made fresh in Northampton.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/footer.blade.php ENDPATH**/ ?>