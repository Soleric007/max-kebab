<?php
    $title = 'Checkout | Max Kebab';
    $description = 'Complete your Max Kebab dine-in, takeaway, or delivery order.';
    $showCta = false;
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Checkout',
        'pageSubtitle' => 'Confirm your details and place your order',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Checkout'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="checkout-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-7 col-lg-8 pb-30">
                    <div class="checkout-item">
                        <div class="sub-section-title">
                            <h3 class="color-white">Order Details</h3>
                        </div>
                        <div class="checkout-form">
                            <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="customer_name" class="form-control" placeholder="Full Name*" value="<?php echo e(old('customer_name')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone Number*" value="<?php echo e(old('phone')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo e(old('email')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <select name="order_type" class="form-control" required>
                                                    <option value="">Order Type*</option>
                                                    <option value="dine_in" <?php if(old('order_type') === 'dine_in'): echo 'selected'; endif; ?>>Dine In</option>
                                                    <option value="takeaway" <?php if(old('order_type') === 'takeaway'): echo 'selected'; endif; ?>>Takeaway</option>
                                                    <option value="delivery" <?php if(old('order_type') === 'delivery'): echo 'selected'; endif; ?>>Delivery</option>
                                                </select>
                                            </div>
                                            <?php $__errorArgs = ['order_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="collection_time" class="form-control" placeholder="Preferred Collection, Arrival, or Delivery Time" value="<?php echo e(old('collection_time')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['collection_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" data-delivery-fields class="<?php echo \Illuminate\Support\Arr::toCssClasses(['d-none' => old('order_type') !== 'delivery']); ?>">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group">
                                                        <input type="text" name="delivery_postcode" class="form-control" placeholder="Delivery Postcode*" value="<?php echo e(old('delivery_postcode')); ?>" data-delivery-required>
                                                    </div>
                                                    <?php $__errorArgs = ['delivery_postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group mb-20">
                                                    <div class="input-group input-group-textarea">
                                                        <textarea name="delivery_address" class="form-control" rows="2" placeholder="Full Delivery Address*" data-delivery-required><?php echo e(old('delivery_address')); ?></textarea>
                                                    </div>
                                                    <?php $__errorArgs = ['delivery_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group input-group-textarea">
                                                <textarea name="notes" class="form-control" rows="5" placeholder="Order Notes"><?php echo e(old('notes')); ?></textarea>
                                            </div>
                                            <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-check agree-label mb-20">
                                            <input name="terms" class="form-check-input" type="checkbox" id="checkoutTerms" value="1" required>
                                            <label class="form-check-label" for="checkoutTerms">
                                                I understand that <?php echo e($brand['name']); ?> offers dine-in, takeaway, and delivery subject to service hours and delivery area.
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <button class="btn full-width" type="submit">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-4 pb-30">
                    <div class="checkout-item">
                        <div class="checkout-details cart-details mb-30">
                            <h3 class="cart-details-title color-white">Cart Totals</h3>
                            <div class="cart-total-box">
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cart-total-item <?php echo e($loop->first ? 'pt-0' : ''); ?>">
                                        <h4 class="color-main">
                                            <?php echo e($item['product']['name']); ?> x<?php echo e($item['quantity']); ?>

                                            <?php if($item['selected_option']): ?>
                                                <span class="cart-item-meta">Option: <?php echo e($item['selected_option']); ?></span>
                                            <?php endif; ?>
                                        </h4>
                                        <p><?php echo e($item['line_total_formatted']); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="cart-total-item">
                                    <h4>Sub Total</h4>
                                    <p><?php echo e($subtotalFormatted); ?></p>
                                </div>
                                <div class="cart-total-item cart-total-bold">
                                    <h4 class="color-white">Total</h4>
                                    <p><?php echo e($subtotalFormatted); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-payment-area">
                            <h3 class="color-white cart-details-title">Order Fulfilment</h3>
                            <div class="checkout-form">
                                <div class="checkout-note-box">
                                    <p>Dine-in, takeaway, and delivery orders are handled from <?php echo e($brand['address']); ?>.</p>
                                    <p>Need to confirm timing or delivery availability? Call <a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>"><?php echo e($brand['phone_display']); ?></a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'Fresh food prepared your way.',
        'text' => 'Complete your order and we will prepare it for dine-in, takeaway, or delivery from Max Kebab.',
        'primaryUrl' => route('contact'),
        'primaryLabel' => 'Find The Shop',
        'secondaryUrl' => 'tel:' . preg_replace('/\s+/', '', $brand['phone']),
        'secondaryLabel' => 'Call Before Arrival',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/checkout.blade.php ENDPATH**/ ?>