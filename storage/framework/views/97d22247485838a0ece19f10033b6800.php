<?php
    $pageHeading = 'Messages';
?>



<?php $__env->startSection('title', 'Messages'); ?>

<?php $__env->startSection('content'); ?>
    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Contact Inbox</h2>
            <p>Enquiries from the contact form are saved here for follow-up.</p>
        </div>

        <form action="<?php echo e(route('admin.messages.index')); ?>" method="GET" class="admin-filter-bar">
            <input type="text" name="search" class="admin-input" placeholder="Search by name, email, or subject" value="<?php echo e($filters['search'] ?? ''); ?>">
            <select name="status" class="admin-input">
                <option value="">All messages</option>
                <option value="unread" <?php if(($filters['status'] ?? '') === 'unread'): echo 'selected'; endif; ?>>Unread</option>
                <option value="read" <?php if(($filters['status'] ?? '') === 'read'): echo 'selected'; endif; ?>>Read</option>
            </select>
            <button type="submit" class="admin-btn">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($message->name); ?></strong>
                                <span><?php echo e($message->email); ?></span>
                            </td>
                            <td><?php echo e($message->subject); ?></td>
                            <td><span class="status-chip <?php echo e($message->is_read ? 'status-completed' : 'status-pending'); ?>"><?php echo e($message->is_read ? 'Read' : 'Unread'); ?></span></td>
                            <td><?php echo e($message->created_at->format('M j, Y g:i A')); ?></td>
                            <td><a href="<?php echo e(route('admin.messages.show', $message)); ?>" class="admin-link">Open</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="admin-empty-copy">No messages found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/admin/pages/messages/index.blade.php ENDPATH**/ ?>