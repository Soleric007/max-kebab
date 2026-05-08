<?php
    $title = $product['name'].' | Max Kebab';
    $description = $product['description'];
    $showCta = false;
    $isWishlisted = app(\App\Support\Storefront::class)->inWishlist($product['slug']);
    $defaultOption = $product['options'][0] ?? null;
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Shop Details',
        'pageSubtitle' => $product['name'],
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => $product['name']],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="product-details-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-5 pb-30">
                    <div class="product-details-item">
                        <div class="product-details-slider">
                            <div class="product-details-for">
                                <?php $__currentLoopData = $product['gallery']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-for-item">
                                        <img src="<?php echo e(asset($image)); ?>" alt="<?php echo e($product['name']); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="product-details-nav">
                                <?php $__currentLoopData = $product['gallery']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-nav-item">
                                        <div class="product-nav-item-inner">
                                            <img src="<?php echo e(asset($image)); ?>" alt="<?php echo e($product['name']); ?>">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 pb-30">
                    <div class="product-details-item">
                        <div class="product-details-caption">
                            <?php if(! empty($product['badge'])): ?>
                                <div class="product-status product-status-danger mb-20"><?php echo e($product['badge']); ?></div>
                            <?php endif; ?>
                            <h3 class="mb-20 color-white"><?php echo e($product['name']); ?></h3>
                            <h4 class="mb-20 product-id">Id: <?php echo e($product['sku']); ?></h4>
                            <div class="review-star mb-20">
                                <ul>
                                    <?php for($i = 0; $i < 5; $i++): ?>
                                        <li class="full-star"><i class="flaticon-star-1"></i></li>
                                    <?php endfor; ?>
                                </ul>
                                <p>(<?php echo e($product['review_count']); ?> Reviews)</p>
                            </div>
                            <div class="product-details-price mb-20">
                                <h4 data-product-price><?php echo e($defaultOption['price_formatted'] ?? $product['price_formatted']); ?></h4>
                                <?php if($product['has_variable_pricing']): ?>
                                    <p class="cart-item-meta"><?php echo e($product['price_display']); ?> across available options</p>
                                <?php endif; ?>
                            </div>
                            <div class="product-details-para mb-20">
                                <p><?php echo e($product['description']); ?></p>
                            </div>
                            <?php if(! empty($product['options'])): ?>
                                <div class="product-action-info mb-20">
                                    <h4>Options:</h4>
                                    <p class="cart-item-meta mb-15"><?php echo e(collect($product['options'])->pluck('display')->join(' / ')); ?></p>
                                    <ul class="product-size-list" data-option-list>
                                        <?php $__currentLoopData = $product['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li
                                                class="<?php echo e($loop->first ? 'active' : ''); ?>"
                                                data-option="<?php echo e($option['value']); ?>"
                                                data-option-price="<?php echo e($option['price_formatted']); ?>"
                                            >
                                                <?php echo e($option['label']); ?>

                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="product-action-info mb-20">
                                <div class="d-flex flex-wrap align-items-center product-quantity">
                                    <form method="POST" action="<?php echo e(route('cart.store', $product['slug'])); ?>" class="product-add-form">
                                        <?php echo csrf_field(); ?>
                                        <?php if($defaultOption): ?>
                                            <input type="hidden" name="option" value="<?php echo e($defaultOption['value']); ?>">
                                        <?php endif; ?>
                                        <button class="btn btn-icon product-quantity-item" type="submit">
                                            Add To Basket
                                            <i class="flaticon-shopping-cart-black-shape"></i>
                                        </button>
                                        <div class="cart-quantity product-quantity-item">
                                            <button class="qu-btn dec" type="button">-</button>
                                            <input type="text" name="quantity" class="qu-input" value="1">
                                            <button class="qu-btn inc" type="button">+</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="product-action-info">
                                <div class="product-add-wishlist">
                                    <?php if($isWishlisted): ?>
                                        <form method="POST" action="<?php echo e(route('wishlist.destroy', $product['slug'])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-button-link"><i class="flaticon-heart"></i>Wishlisted</button>
                                        </form>
                                    <?php else: ?>
                                        <form method="POST" action="<?php echo e(route('wishlist.store', $product['slug'])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="text-button-link"><i class="flaticon-heart"></i>Add To Wishlist</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-tab below-border">
                <ul class="product-details-tab-list">
                    <li class="active" data-product-tab-list="1">Description</li>
                    <li data-product-tab-list="2">Reviews <span>(<?php echo e($reviews->count()); ?>)</span></li>
                </ul>
                <div class="product-tab-information">
                    <div class="product-tab-information-item active" data-product-details-tab="1">
                        <div class="product-description mb-30">
                            <p><?php echo e($product['description']); ?></p>
                            <p>Prepared for <?php echo e(str_replace('-', ' ', $product['category'])); ?>, built around fresh ingredients, and served at a quality level that matches the Max Kebab name.</p>
                        </div>
                    </div>
                    <div class="product-tab-information-item" data-product-details-tab="2">
                        <div class="product-review-list">
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product-review-item">
                                    <?php if (isset($component)) { $__componentOriginal9c755b64b7bb8b6a080bedeeb703c319 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.review-card','data' => ['review' => $review]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('review-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['review' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($review)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319)): ?>
<?php $attributes = $__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319; ?>
<?php unset($__attributesOriginal9c755b64b7bb8b6a080bedeeb703c319); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c755b64b7bb8b6a080bedeeb703c319)): ?>
<?php $component = $__componentOriginal9c755b64b7bb8b6a080bedeeb703c319; ?>
<?php unset($__componentOriginal9c755b64b7bb8b6a080bedeeb703c319); ?>
<?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-product mt-50">
                <div class="sub-section-title">
                    <h3 class="color-white">Related Items</h3>
                </div>
                <div class="receipe-grid receipe-grid-three">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="receipe-item receipe-item-black pb-30">
                            <div class="receipe-item-inner">
                                <div class="receipe-image">
                                    <a href="<?php echo e(route('shop.show', $relatedProduct['slug'])); ?>">
                                        <img src="<?php echo e(asset($relatedProduct['image'])); ?>" alt="<?php echo e($relatedProduct['name']); ?>">
                                    </a>
                                </div>
                                <div class="receipe-content">
                                    <div class="receipe-info">
                                        <h3><a href="<?php echo e(route('shop.show', $relatedProduct['slug'])); ?>"><?php echo e($relatedProduct['name']); ?></a></h3>
                                        <h4>
                                            <?php echo e($relatedProduct['price_display']); ?>

                                            <?php if(! empty($relatedProduct['compare_price_formatted'])): ?>
                                                <del><?php echo e($relatedProduct['compare_price_formatted']); ?></del>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                    <div class="receipe-cart receipe-cart-main">
                                        <form method="POST" action="<?php echo e(route('cart.store', $relatedProduct['slug'])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php if(! empty($relatedProduct['default_option'])): ?>
                                                <input type="hidden" name="option" value="<?php echo e($relatedProduct['default_option']); ?>">
                                            <?php endif; ?>
                                            <button type="submit" class="receipe-cart-button" aria-label="Add <?php echo e($relatedProduct['name']); ?> to basket">
                                                <i class="flaticon-supermarket-basket"></i>
                                                <i class="flaticon-supermarket-basket"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'Save it now, order it when you are ready.',
        'text' => 'Browse more of the Max Kebab menu, add favourites to your wishlist, and build a proper basket for dine-in, takeaway, or delivery.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Back To Shop',
        'secondaryUrl' => route('wishlist.index'),
        'secondaryLabel' => 'Open Wishlist',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/product.blade.php ENDPATH**/ ?>