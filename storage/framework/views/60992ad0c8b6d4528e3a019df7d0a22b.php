<?php
    $pageHeading = 'Categories';
?>



<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-grid-two admin-grid-wide-left">
        <?php echo $__env->make('admin.partials.category-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Current Categories</h2>
                <p>These drive the menu tabs and shop filters on the site.</p>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($category->name); ?></strong>
                                    <?php if($category->icon): ?>
                                        <span><?php echo e($category->icon); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($category->slug); ?></td>
                                <td><?php echo e($category->products_count); ?></td>
                                <td><span class="status-chip <?php echo e($category->is_active ? 'status-completed' : 'status-cancelled'); ?>"><?php echo e($category->is_active ? 'Live' : 'Hidden'); ?></span></td>
                                <td class="admin-table-actions">
                                    <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="admin-link">Edit</a>
                                    <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" data-confirm="Delete this category?" data-confirm-detail="You can only remove categories that do not still contain live products.">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="admin-text-btn danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="admin-empty-copy">No categories found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/admin/pages/categories/index.blade.php ENDPATH**/ ?>