<header class="admin-header">
    <div>
        <p class="admin-kicker">Max Kebab Backend</p>
        <h1 class="admin-page-title"><?php echo e($pageHeading ?? trim($__env->yieldContent('title')) ?: 'Dashboard'); ?></h1>
        <div class="admin-header-meta">
            <a href="<?php echo e(route('home')); ?>" class="admin-meta-chip" target="_blank" rel="noopener">
                <i class="icofont-external-link"></i>
                View Storefront
            </a>
            <a href="<?php echo e(route('admin.orders.index', ['status' => 'pending'])); ?>" class="admin-meta-chip">
                <i class="icofont-bag"></i>
                Pending Orders
                <strong><?php echo e($adminNavStats['pending_orders'] ?? 0); ?></strong>
            </a>
            <a href="<?php echo e(route('admin.messages.index', ['status' => 'unread'])); ?>" class="admin-meta-chip">
                <i class="icofont-envelope-open"></i>
                Unread Messages
                <strong><?php echo e($adminNavStats['unread_messages'] ?? 0); ?></strong>
            </a>
        </div>
    </div>

    <div class="admin-header-actions">
        <div class="admin-user-chip">
            <span><?php echo e(auth()->user()?->name); ?></span>
            <small><?php echo e(auth()->user()?->email); ?></small>
        </div>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="admin-logout-btn">Log Out</button>
        </form>
    </div>
</header>
<?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/admin/partials/header.blade.php ENDPATH**/ ?>