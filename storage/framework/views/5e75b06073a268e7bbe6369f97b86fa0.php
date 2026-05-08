<div class="cart-modal-wrapper">
    <div class="cart-modal modal-item">
        <div class="cart-modal-header">
            <h3 class="color-white">Basket <?php echo e($cartCount); ?></h3>
            <div class="cart-modal-close">
                <i class="flaticon-cancel"></i>
            </div>
        </div>
        <div class="cart-modal-body">
            <h2 class="color-white">Your Order</h2>
            <?php $__empty_1 = true; $__currentLoopData = $cartPreviewItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="cart-modal-product">
                    <div class="cart-modal-thumb">
                        <a href="<?php echo e(route('shop.show', $item['slug'])); ?>">
                            <img src="<?php echo e(asset($item['product']['image'])); ?>" alt="<?php echo e($item['product']['name']); ?>">
                        </a>
                    </div>
                    <div class="cart-modal-content">
                        <h4><a href="<?php echo e(route('shop.show', $item['slug'])); ?>"><?php echo e($item['product']['name']); ?></a></h4>
                        <?php if($item['selected_option']): ?>
                            <p class="cart-item-meta">Option: <?php echo e($item['selected_option']); ?></p>
                        <?php endif; ?>
                        <div class="cart-modal-action">
                            <div class="cart-modal-action-item">
                                <div class="cart-modal-quantity">
                                    <p><?php echo e($item['quantity']); ?></p>
                                    <p>x</p>
                                    <p class="cart-quantity-price"><?php echo e($item['product']['price_formatted']); ?></p>
                                </div>
                            </div>
                            <div class="cart-modal-action-item">
                                <div class="cart-modal-delete">
                                    <form action="<?php echo e(route('cart.destroy', $item['key'])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="cart-icon-button" aria-label="Remove <?php echo e($item['product']['name']); ?>">
                                            <i class="icofont-ui-delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state compact-empty-state">
                    <p>Your basket is empty right now.</p>
                </div>
            <?php endif; ?>

            <div class="cart-modal-total">
                <h3 class="color-white">Subtotal</h3>
                <h3 class="color-white"><?php echo e($cartSubtotalFormatted); ?></h3>
            </div>
            <div class="cart-modal-button">
                <a href="<?php echo e(route('checkout.index')); ?>" class="btn full-width">Proceed To Checkout</a>
                <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-yellow full-width">View Basket</a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/partials/cart-modal.blade.php ENDPATH**/ ?>