<?php
    $pageHeading = 'Order '.$order->reference;
?>



<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-grid-two">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Order Details</h2>
                <p>Placed <?php echo e($order->created_at->format('M j, Y g:i A')); ?></p>
            </div>

            <div class="admin-detail-grid">
                <div>
                    <span>Customer</span>
                    <strong><?php echo e($order->customer_name); ?></strong>
                </div>
                <div>
                    <span>Phone</span>
                    <strong><?php echo e($order->phone); ?></strong>
                </div>
                <div>
                    <span>Email</span>
                    <strong><?php echo e($order->email ?: 'Not provided'); ?></strong>
                </div>
                <div>
                    <span>Order Type</span>
                    <strong><?php echo e(strtoupper(str_replace('_', ' ', $order->order_type))); ?></strong>
                </div>
                <div>
                    <span>Preferred Time</span>
                    <strong><?php echo e($order->collection_time ?: 'Not specified'); ?></strong>
                </div>
                <div>
                    <span>Total</span>
                    <strong>£<?php echo e(number_format((float) $order->total, 2)); ?></strong>
                </div>
                <?php if($order->order_type === 'delivery'): ?>
                    <div>
                        <span>Delivery Postcode</span>
                        <strong><?php echo e($order->delivery_postcode ?: 'Not provided'); ?></strong>
                    </div>
                    <div>
                        <span>Delivery Address</span>
                        <strong><?php echo e($order->delivery_address ?: 'Not provided'); ?></strong>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-4">
                <h3 class="admin-section-title">Order Notes</h3>
                <p class="admin-note-panel"><?php echo e($order->notes ?: 'No customer notes were added.'); ?></p>
            </div>

            <div class="mt-4">
                <h3 class="admin-section-title">Items</h3>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Option</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->product_name); ?></td>
                                    <td><?php echo e($item->selected_option ?: 'Standard'); ?></td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td>£<?php echo e(number_format((float) $item->product_price, 2)); ?></td>
                                    <td>£<?php echo e(number_format((float) $item->line_total, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="admin-card admin-form-card">
            <div class="admin-card-head">
                <h2>Update Status</h2>
                <p>Keep the order flow tidy for staff and customers. Customers with an email address receive automatic status updates.</p>
            </div>

            <form action="<?php echo e(route('admin.orders.update', $order)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div>
                    <label class="admin-label">Status</label>
                    <select name="status" class="admin-input">
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?php if($order->status === $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mt-3">
                    <label class="admin-label">Admin Notes</label>
                    <textarea name="admin_notes" class="admin-textarea" rows="8" placeholder="Internal notes for the team"><?php echo e(old('admin_notes', $order->admin_notes)); ?></textarea>
                </div>

                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn">Save Update</button>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-btn admin-btn-muted">Back</a>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/admin/pages/orders/show.blade.php ENDPATH**/ ?>