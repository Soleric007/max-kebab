<?php
    $pageHeading = 'Products';
?>



<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-card">
        <div class="admin-card-head">
            <div>
                <h2>Menu Products</h2>
                <p>Everything shown on the shop, product pages, wishlist, and checkout lives here now.</p>
            </div>
            <a href="<?php echo e(route('admin.products.create')); ?>" class="admin-btn">Add Product</a>
        </div>

        <form action="<?php echo e(route('admin.products.index')); ?>" method="GET" class="admin-filter-bar">
            <input type="text" name="search" class="admin-input" placeholder="Search by name, SKU, or slug" value="<?php echo e($filters['search'] ?? ''); ?>">
            <select name="category" class="admin-input">
                <option value="">All categories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if((string) ($filters['category'] ?? '') === (string) $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="status" class="admin-input">
                <option value="">Any status</option>
                <option value="active" <?php if(($filters['status'] ?? '') === 'active'): echo 'selected'; endif; ?>>Live</option>
                <option value="inactive" <?php if(($filters['status'] ?? '') === 'inactive'): echo 'selected'; endif; ?>>Hidden</option>
            </select>
            <button type="submit" class="admin-btn">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($product->name); ?></strong>
                                <span><?php echo e($product->sku); ?></span>
                            </td>
                            <td><?php echo e($product->category?->name); ?></td>
                            <td>
                                <strong>£<?php echo e(number_format((float) $product->price, 2)); ?></strong>
                                <?php if($product->compare_price): ?>
                                    <span>£<?php echo e(number_format((float) $product->compare_price, 2)); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><span class="status-chip <?php echo e($product->is_active ? 'status-completed' : 'status-cancelled'); ?>"><?php echo e($product->is_active ? 'Live' : 'Hidden'); ?></span></td>
                            <td><?php echo e($product->featured ? 'Yes' : 'No'); ?></td>
                            <td class="admin-table-actions">
                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="admin-link">Edit</a>
                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" data-confirm="Delete this product?" data-confirm-detail="This removes it from the live menu and future basket flows.">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="admin-text-btn danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="admin-empty-copy">No products found for this filter.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/admin/pages/products/index.blade.php ENDPATH**/ ?>