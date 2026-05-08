<?php
    $pageHeading = 'Orders';
?>



<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Order Queue</h2>
            <p>Track dine-in, takeaway, and delivery orders from one place.</p>
        </div>

        <form action="<?php echo e(route('admin.orders.index')); ?>" method="GET" class="admin-filter-bar">
            <input type="text" name="search" class="admin-input" placeholder="Search by reference, name, or phone" value="<?php echo e($filters['search'] ?? ''); ?>">
            <select name="status" class="admin-input">
                <option value="">All statuses</option>
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value); ?>" <?php if(($filters['status'] ?? '') === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="admin-btn">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($order->reference); ?></td>
                            <td>
                                <strong><?php echo e($order->customer_name); ?></strong>
                                <span><?php echo e($order->phone); ?></span>
                            </td>
                            <td><?php echo e(strtoupper(str_replace('_', ' ', $order->order_type))); ?></td>
                            <td><?php echo e($order->items_count); ?></td>
                            <td>£<?php echo e(number_format((float) $order->total, 2)); ?></td>
                            <td><span class="status-chip status-<?php echo e($order->status); ?>"><?php echo e(str_replace('_', ' ', $order->status)); ?></span></td>
                            <td><a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="admin-link">Open</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="admin-empty-copy">No orders found for this filter.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/admin/pages/orders/index.blade.php ENDPATH**/ ?>