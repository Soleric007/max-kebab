<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login | Max Kebab</title>
    <link rel="icon" href="<?php echo e(asset('assets/images/tab.png')); ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/max-kebab-admin.css')); ?>">
</head>
<body class="admin-auth-body">
    <?php echo $__env->make('shared.flash-messages', ['context' => 'admin'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="admin-auth-shell">
        <section class="admin-auth-panel">
            <div class="admin-auth-copy">
                <p class="admin-kicker">Max Kebab Backend</p>
                <h1>Sign in to manage the restaurant</h1>
                <p>Orders, menu items, categories, and customer enquiries now live in one proper Laravel admin area.</p>
            </div>

            <form action="<?php echo e(route('login')); ?>" method="POST" class="admin-auth-form">
                <?php echo csrf_field(); ?>

                <div>
                    <label class="admin-label">Email Address</label>
                    <input type="email" name="email" class="admin-input" value="<?php echo e(old('email')); ?>" required autofocus>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="admin-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="admin-label">Password</label>
                    <input type="password" name="password" class="admin-input" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="admin-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <label class="admin-check">
                    <input type="checkbox" name="remember" value="1">
                    <span>Keep me signed in on this device</span>
                </label>

                <button type="submit" class="admin-btn w-100">Sign In</button>
            </form>

            <a href="<?php echo e(route('home')); ?>" class="admin-auth-link">Back to storefront</a>
        </section>
    </main>

    <script src="<?php echo e(asset('assets/js/max-kebab-admin.js')); ?>"></script>
</body>
</html>
<?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/auth/login.blade.php ENDPATH**/ ?>