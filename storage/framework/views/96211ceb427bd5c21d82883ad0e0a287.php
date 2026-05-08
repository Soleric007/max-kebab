<section class="step-section p-tb-100 bg-black">
    <div class="container">
        <div class="section-title">
            <h2 class="color-white"><?php echo e($heading ?? '3 Easy Steps To Enjoy'); ?></h2>
        </div>
        <div class="steps-box">
            <div class="row justify-content-center">
                <?php $__currentLoopData = $orderSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="steps-item">
                            <h3><?php echo e($index + 1); ?>. <?php echo e($step['title']); ?></h3>
                            <p><?php echo e($step['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/partials/order-steps.blade.php ENDPATH**/ ?>