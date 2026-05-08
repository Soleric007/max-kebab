<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $storefront = app(\App\Support\Storefront::class);
    $isWishlisted = $storefront->inWishlist($product['slug']);
?>

<div class="product-card product-card-dark">
    <div class="product-card-thumb">
        <div class="product-card-thumb-inner">
            <a href="<?php echo e(route('shop.show', $product['slug'])); ?>" class="product-card-image-link">
                <img src="<?php echo e(asset($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
            </a>
            <div class="product-card-button">
                <form method="POST" action="<?php echo e(route('cart.store', $product['slug'])); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-yellow">Add To Basket</button>
                </form>
                <?php if($isWishlisted): ?>
                    <form method="POST" action="<?php echo e(route('wishlist.destroy', $product['slug'])); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn">Wishlisted</button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('wishlist.store', $product['slug'])); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn">Add To Wishlist</button>
                    </form>
                <?php endif; ?>
            </div>
            <?php if(! empty($product['badge'])): ?>
                <div class="product-status product-status-danger"><?php echo e($product['badge']); ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="product-card-content">
        <h3><a href="<?php echo e(route('shop.show', $product['slug'])); ?>"><?php echo e($product['name']); ?></a></h3>
        <h4 class="product-price">
            <?php echo e($product['price_formatted']); ?>

            <?php if(! empty($product['compare_price_formatted'])): ?>
                <small><?php echo e($product['compare_price_formatted']); ?></small>
            <?php endif; ?>
        </h4>
    </div>
</div>
<?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/components/product-card.blade.php ENDPATH**/ ?>