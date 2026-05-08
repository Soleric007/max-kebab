<?php
    $pageHeading = 'Edit Category';
?>



<?php $__env->startSection('title', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.category-form', ['category' => $category], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/admin/pages/categories/edit.blade.php ENDPATH**/ ?>