<?php
    $pageHeading = 'Dashboard';
?>



<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-dashboard-hero">
        <div>
            <p class="admin-dashboard-kicker">Daily Overview</p>
            <h2>Keep Max Kebab moving smoothly across dine-in, takeaway, and delivery.</h2>
            <p class="admin-dashboard-copy">Use this view to spot order pressure, menu gaps, and unread customer messages before they slow down service.</p>
        </div>
        <div class="admin-kpi-inline">
            <div>
                <span>Today&apos;s Orders</span>
                <strong><?php echo e($metrics['today_orders']); ?></strong>
            </div>
            <div>
                <span>Active Products</span>
                <strong><?php echo e($metrics['active_products']); ?></strong>
            </div>
            <div>
                <span>Average Completed Order</span>
                <strong>£<?php echo e(number_format($metrics['average_order_value'], 2)); ?></strong>
            </div>
        </div>
    </section>

    <section class="admin-metrics-grid">
        <div class="admin-metric-card">
            <p>Categories</p>
            <h2><?php echo e($metrics['categories']); ?></h2>
        </div>
        <div class="admin-metric-card">
            <p>Products</p>
            <h2><?php echo e($metrics['products']); ?></h2>
        </div>
        <div class="admin-metric-card">
            <p>Pending Orders</p>
            <h2><?php echo e($metrics['pending_orders']); ?></h2>
        </div>
        <div class="admin-metric-card">
            <p>Delivery Queue</p>
            <h2><?php echo e($metrics['delivery_orders']); ?></h2>
        </div>
        <div class="admin-metric-card">
            <p>Revenue</p>
            <h2>£<?php echo e(number_format($metrics['revenue'], 2)); ?></h2>
        </div>
        <div class="admin-metric-card">
            <p>Unread Messages</p>
            <h2><?php echo e($metrics['unread_messages']); ?></h2>
        </div>
    </section>

    <section class="admin-grid-two mt-4">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Order Pipeline</h2>
                <p>A quick look at where orders are sitting right now.</p>
            </div>
            <div class="admin-status-grid">
                <?php $__currentLoopData = $statusBreakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.orders.index', ['status' => $item['status']])); ?>" class="admin-status-card">
                        <span class="status-chip status-<?php echo e($item['status']); ?>"><?php echo e($item['label']); ?></span>
                        <strong><?php echo e($item['count']); ?></strong>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Service Mix</h2>
                <p>See which fulfilment channels are carrying the most orders.</p>
            </div>
            <div class="admin-list-stack">
                <?php $__currentLoopData = $orderMix; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mix): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="admin-list-row">
                        <div>
                            <strong><?php echo e($mix['label']); ?></strong>
                            <span>Orders placed through this channel</span>
                        </div>
                        <div class="text-end">
                            <strong><?php echo e($mix['count']); ?></strong>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="admin-grid-two mt-4">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Quick Actions</h2>
                <p>Keep the menu and orders moving.</p>
            </div>
            <div class="admin-action-grid">
                <a href="<?php echo e(route('admin.products.create')); ?>" class="admin-action-tile">Add New Product</a>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="admin-action-tile">Manage Categories</a>
                <a href="<?php echo e(route('admin.orders.index', ['status' => 'pending'])); ?>" class="admin-action-tile">Review Pending Orders</a>
                <a href="<?php echo e(route('admin.orders.index', ['status' => 'out_for_delivery'])); ?>" class="admin-action-tile">Check Delivery Orders</a>
                <a href="<?php echo e(route('admin.messages.index', ['status' => 'unread'])); ?>" class="admin-action-tile">Open Unread Messages</a>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Top Menu Items</h2>
                <p>Items currently carrying the strongest social proof.</p>
            </div>
            <div class="admin-list-stack">
                <?php $__empty_1 = true; $__currentLoopData = $popularProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="admin-list-row">
                        <div>
                            <strong><?php echo e($product->name); ?></strong>
                            <span><?php echo e($product->category?->name); ?></span>
                        </div>
                        <div class="text-end">
                            <strong>£<?php echo e(number_format((float) $product->price, 2)); ?></strong>
                            <span><?php echo e($product->review_count); ?> reviews</span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="admin-empty-copy">No products have been seeded yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="admin-grid-two mt-4">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Latest Orders</h2>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-link">View all</a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $latestOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($order->reference); ?></td>
                                <td><?php echo e($order->customer_name); ?></td>
                                <td><span class="status-chip status-<?php echo e($order->status); ?>"><?php echo e(str_replace('_', ' ', $order->status)); ?></span></td>
                                <td>£<?php echo e(number_format((float) $order->total, 2)); ?></td>
                                <td><a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="admin-link">Open</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="admin-empty-copy">No orders yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Recent Messages</h2>
                <a href="<?php echo e(route('admin.messages.index')); ?>" class="admin-link">Inbox</a>
            </div>
            <div class="admin-list-stack">
                <?php $__empty_1 = true; $__currentLoopData = $recentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('admin.messages.show', $message)); ?>" class="admin-message-snippet">
                        <strong><?php echo e($message->subject); ?></strong>
                        <span><?php echo e($message->name); ?> • <?php echo e($message->created_at->format('M j, Y g:i A')); ?></span>
                        <p><?php echo e(\Illuminate\Support\Str::limit($message->message, 110)); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="admin-empty-copy">No messages have come in yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/admin/pages/dashboard.blade.php ENDPATH**/ ?>