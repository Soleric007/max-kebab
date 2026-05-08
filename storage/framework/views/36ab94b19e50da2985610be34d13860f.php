<?php
    $breadcrumbs = $breadcrumbs ?? [];
?>

<div class="header-bg header-bg-page">
    <div class="header-padding position-relative">
        <div class="header-page-shape">
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-2.png')); ?>" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-3.png')); ?>" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-4.png')); ?>" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape">
            </div>
            <div class="header-page-shape-item">
                <img src="<?php echo e(asset('assets/images/header-shape-3.png')); ?>" alt="shape">
            </div>
        </div>
        <div class="container">
            <div class="header-page-content">
                <h1><?php echo e($pageTitle); ?></h1>
                <?php if(! empty($pageSubtitle)): ?>
                    <p class="page-hero-subtitle"><?php echo e($pageSubtitle); ?></p>
                <?php endif; ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(! empty($breadcrumb['url'])): ?>
                                <li class="breadcrumb-item"><a href="<?php echo e($breadcrumb['url']); ?>"><?php echo e($breadcrumb['label']); ?></a></li>
                            <?php else: ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($breadcrumb['label']); ?></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/partials/page-hero.blade.php ENDPATH**/ ?>