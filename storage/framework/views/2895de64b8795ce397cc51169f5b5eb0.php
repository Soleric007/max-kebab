<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['review']));

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

foreach (array_filter((['review']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="testimonial-carousel-item bg-main">
    <p class="carousel-para"><?php echo e($review['quote']); ?></p>
    <div class="carousel-info-grid">
        <div class="carousel-thumb">
            <img src="<?php echo e(asset($review['image'])); ?>" alt="<?php echo e($review['name']); ?>">
        </div>
        <div class="carousel-info text-end">
            <div class="review-star">
                <ul class="justify-content-end">
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <li class="full-star"><i class="flaticon-star-1"></i></li>
                    <?php endfor; ?>
                </ul>
            </div>
            <h3 class="carousel-name"><?php echo e($review['name']); ?></h3>
            <h4 class="carousel-designation"><?php echo e($review['designation']); ?></h4>
        </div>
    </div>
</div>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/components/review-card.blade.php ENDPATH**/ ?>