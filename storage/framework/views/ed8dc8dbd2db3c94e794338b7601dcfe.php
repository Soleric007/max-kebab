<?php
    $pageHeading = 'Message from '.$message->name;
?>



<?php $__env->startSection('title', 'Message Details'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-grid-two">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2><?php echo e($message->subject); ?></h2>
                <p><?php echo e($message->created_at->format('M j, Y g:i A')); ?></p>
            </div>

            <div class="admin-detail-grid">
                <div>
                    <span>Name</span>
                    <strong><?php echo e($message->name); ?></strong>
                </div>
                <div>
                    <span>Phone</span>
                    <strong><?php echo e($message->phone); ?></strong>
                </div>
                <div>
                    <span>Email</span>
                    <strong><?php echo e($message->email); ?></strong>
                </div>
                <div>
                    <span>Status</span>
                    <strong><?php echo e($message->is_read ? 'Read' : 'Unread'); ?></strong>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="admin-section-title">Message</h3>
                <div class="admin-message-body"><?php echo e($message->message); ?></div>
            </div>
        </div>

        <div class="admin-card admin-form-card">
            <div class="admin-card-head">
                <h2>Actions</h2>
                <p>Use the details below to follow up directly.</p>
            </div>

            <div class="admin-list-stack">
                <a href="mailto:<?php echo e($message->email); ?>" class="admin-action-tile">Reply by Email</a>
                <a href="tel:<?php echo e(preg_replace('/\s+/', '', $message->phone)); ?>" class="admin-action-tile">Call Sender</a>
                <a href="<?php echo e(route('admin.messages.index')); ?>" class="admin-action-tile">Back to Inbox</a>
            </div>

            <?php if (! ($message->is_read)): ?>
                <form action="<?php echo e(route('admin.messages.read', $message)); ?>" method="POST" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="admin-btn">Mark As Read</button>
                </form>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/admin/pages/messages/show.blade.php ENDPATH**/ ?>