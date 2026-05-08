<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> | Max Kebab</title>
    <link rel="icon" href="<?php echo e(asset('assets/images/tab.png')); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/icofont.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/max-kebab-admin.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="admin-body">
    <div class="admin-shell">
        <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="admin-content-wrap">
            <?php echo $__env->make('admin.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <main class="admin-main">
                <?php echo $__env->make('shared.flash-messages', ['context' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <?php echo $__env->make('admin.partials.confirm-dialog', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/max-kebab-admin.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>