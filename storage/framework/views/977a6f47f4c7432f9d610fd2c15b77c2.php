<section class="special-section bg-overlay-2 pt-100 pb-70 bg-black">
    <div class="container">
        <div class="section-title">
            <small><?php echo e($smallTitle ?? 'Speciality'); ?></small>
            <h2 class="color-white"><?php echo e($heading ?? 'Our Special Ingredients'); ?></h2>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-12 col-md-4 col-lg-4 text-end wow animate__slideInUp" data-wow-duration="1.5s" data-wow-delay="0.1s">
                <?php $__currentLoopData = $ingredientHighlights['left']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="info-item info-item-right info-item-white">
                        <h3><?php echo e($item['title']); ?> <span><?php echo e($item['accent']); ?></span></h3>
                        <p><?php echo e($item['description']); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 wow animate__zoomIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
                <div class="info-image">
                    <img src="<?php echo e(asset('assets/images/special-food.png')); ?>" alt="Max Kebab ingredients">
                    <div class="info-shape">
                        <?php for($arrow = 1; $arrow <= 6; $arrow++): ?>
                            <div class="info-shape-item">
                                <img src="<?php echo e(asset("assets/images/arrow-{$arrow}.png")); ?>" alt="ingredient highlight arrow">
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 wow animate__slideInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                <?php $__currentLoopData = $ingredientHighlights['right']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="info-item info-item-left info-item-white">
                        <h3><?php echo e($item['title']); ?> <span><?php echo e($item['accent']); ?></span></h3>
                        <p><?php echo e($item['description']); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/special-highlights.blade.php ENDPATH**/ ?>