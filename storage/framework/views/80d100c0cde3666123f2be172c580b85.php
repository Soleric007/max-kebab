<?php
    $context = $context ?? 'storefront';
    $messages = [];

    if (session('success')) {
        $messages[] = [
            'type' => 'success',
            'title' => 'Done',
            'message' => session('success'),
            'icon' => 'icofont-check-circled',
        ];
    }

    if (session('error')) {
        $messages[] = [
            'type' => 'error',
            'title' => 'Something needs attention',
            'message' => session('error'),
            'icon' => 'icofont-warning-alt',
        ];
    }

    if (session('warning')) {
        $messages[] = [
            'type' => 'warning',
            'title' => 'Almost there',
            'message' => session('warning'),
            'icon' => 'icofont-info-circle',
        ];
    }

    if ($errors->any()) {
        $messages[] = [
            'type' => 'error',
            'title' => 'Please review the form',
            'message' => $errors->first(),
            'icon' => 'icofont-warning-alt',
        ];
    }
?>

<?php if(! empty($messages)): ?>
    <div class="flash-stack flash-stack-<?php echo e($context); ?>" data-flash-stack>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flash-toast flash-toast-<?php echo e($message['type']); ?>" data-flash-toast role="status" aria-live="polite">
                <div class="flash-toast-icon">
                    <i class="<?php echo e($message['icon']); ?>"></i>
                </div>
                <div class="flash-toast-copy">
                    <strong><?php echo e($message['title']); ?></strong>
                    <span><?php echo e($message['message']); ?></span>
                </div>
                <button type="button" class="flash-toast-close" data-flash-dismiss aria-label="Dismiss notification">
                    <i class="icofont-close-line"></i>
                </button>
                <span class="flash-toast-bar"></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/shared/flash-messages.blade.php ENDPATH**/ ?>