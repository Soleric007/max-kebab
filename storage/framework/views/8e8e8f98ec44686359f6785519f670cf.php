<?php
    $socialLinks = collect($brand['socials'] ?? [])
        ->filter(fn (array $social) => filled($social['url'] ?? null) && ($social['url'] ?? null) !== '#')
        ->values();
?>

<div class="topbar bg-main">
    <div class="container">
        <div class="topbar-inner <?php echo e($socialLinks->isEmpty() ? 'topbar-inner-centered' : ''); ?>">
            <?php if($socialLinks->isNotEmpty()): ?>
                <div class="topbar-item topbar-padding">
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
            <div class="topbar-item">
                <div class="topbar-right d-flex flex-wrap justify-content-center justify-content-md-start full-height">
                    <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-clock"></i>
                        <?php echo e($brand['service_modes']); ?>

                    </div>
                    <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-placeholder-1"></i>
                        <?php echo e($brand['short_address']); ?>

                    </div>
                    <div class="topbar-right-item topbar-padding color-white">
                        <i class="flaticon-smartphone-call"></i>
                        <a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>" class="color-white"><?php echo e($brand['phone_display']); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/topbar.blade.php ENDPATH**/ ?>