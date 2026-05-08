<?php
    $title = 'Max Kebab | Northampton\'s Premium Kebab Experience';
    $description = 'Premium kebab restaurant in Northampton serving fresh wraps, burgers, wings, sides, salads, dine-in favourites, takeaway, and delivery.';
?>



<?php $__env->startSection('content'); ?>
    <div class="header-bg">
        <div class="container">
            <div class="rev_slider_wrapper">
                <div id="rev_slider_1" class="rev_slider" data-version="5.4.5" style="display:none">
                    <ul>
                        <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-index="rs-<?php echo e($loop->iteration); ?>" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off" data-title="<?php echo e($slide['headline']); ?>">
                                <div class="tp-caption LandingPage-Title tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-1"
                                    data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['170','72','92','96']"
                                    data-fontsize="['60','56','44','28']"
                                    data-lineheight="['78','72','56','36']"
                                    data-letterspacing="['2','2','1','1']"
                                    data-width="['620','620','520','300']"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','center','center','center']"
                                    data-fontweight="400"
                                    style="z-index: 5; white-space: normal;"><?php echo e($slide['headline']); ?></div>

                                <div class="tp-caption LandingPage-SubTitle tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-2"
                                    data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['355','255','225','222']"
                                    data-fontsize="['25','24','18','16']"
                                    data-lineheight="['34','32','26','24']"
                                    data-width="['470','470','430','290']"
                                    data-fontweight="500"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','center','center','center']"
                                    style="z-index: 7; white-space: normal; font-style: normal;"><?php echo e($slide['subtext']); ?></div>

                                <div class="tp-caption LandingPage-SubTitle tp-resizeme home-hero-action-group"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-3"
                                    data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['430','335','295','302']"
                                    data-fontsize="['20','20','17','17']"
                                    data-lineheight="['30','30','25','25']"
                                    data-width="['420','420','420','300']"
                                    data-height="none"
                                    data-whitespace="normal"
                                    data-type="text"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;opacity:0;","speed":1500,"to":"o:1;","delay":900,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','center','center','center']"
                                    style="z-index: 7; white-space: normal; font-style: normal; display: flex; align-items: center; gap: 18px; flex-wrap: wrap; max-width: 420px;">
                                    <a href="<?php echo e(route('shop.show', $slide['slug'])); ?>" class="btn">Order Now <i class="flaticon-shopping-cart-black-shape"></i></a>
                                    <p class="header-product-price color-white">
                                        <?php echo e($slide['price']); ?>

                                        <?php if(! empty($slide['compare_price'])): ?>
                                            <del><?php echo e($slide['compare_price']); ?></del>
                                        <?php endif; ?>
                                    </p>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-4"
                                    data-x="['right','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['87','380','350','398']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.75;sY:0.75;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset($slide['image'])); ?>" alt="<?php echo e($slide['headline']); ?>" data-ww="['620px','560px','520px','360px']" data-hh="['585px','535px','470px','310px']" width="620" height="585" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-5"
                                    data-x="['left','left','left','left']"
                                    data-y="['top','top','top','top']" data-voffset="['30','30','30','30']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;rZ: -120deg;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape" data-ww="['42px','42px','42px','42px']" data-hh="['43px','43px','43px','43px']" width="42" height="43" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-6"
                                    data-x="['center','center','center','center']"
                                    data-y="['top','top','top','top']" data-voffset="['50','0','12','0']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"y:-50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-2.png')); ?>" alt="shape" data-ww="['90px','90px','90px','90px']" data-hh="['81px','81px','81px','81px']" width="90" height="81" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-7"
                                    data-x="['right','right','right','right']"
                                    data-y="['top','top','top','top']" data-voffset="['-45','-45','-45','-75']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-3.png')); ?>" alt="shape" data-ww="['110px','110px','110px','110px']" data-hh="['143px','143px','143px','143px']" width="110" height="143" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-8"
                                    data-x="['right','right','right','right']"
                                    data-y="['top','top','top','top']" data-voffset="['150','150','150','150']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;rZ: -120deg;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape" data-ww="['42px','42px','42px','42px']" data-hh="['43px','43px','43px','43px']" width="42" height="43" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-9"
                                    data-x="['center','center','center','center']"
                                    data-y="['center','center','center','center']" data-voffset="['150','150','150','150']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:50px;rZ: -120deg;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-1.png')); ?>" alt="shape" data-ww="['42px','42px','42px','42px']" data-hh="['43px','43px','43px','43px']" width="42" height="43" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-10"
                                    data-x="['left','left','left','left']"
                                    data-y="['bottom','bottom','bottom','bottom']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-3.png')); ?>" alt="shape" data-ww="['110px','110px','110px','110px']" data-hh="['143px','143px','143px','143px']" width="110" height="143" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-<?php echo e($loop->iteration); ?>-layer-11"
                                    data-x="['right','right','right','right']"
                                    data-y="['bottom','bottom','bottom','bottom']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="<?php echo e(asset('assets/images/header-shape-4.png')); ?>" alt="shape" data-ww="['318px','300px','250px','210px']" data-hh="['209px','197px','164px','138px']" width="318" height="209" data-no-retina>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="welcome-section bg-overlay-1 pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5 pb-30">
                    <div class="section-title section-title-left text-center text-md-start m-0">
                        <small>Welcome To <?php echo e($brand['name']); ?></small>
                        <h2 class="color-white">Authentic grilled flavour with a premium street-food feel</h2>
                        <p><?php echo e($brand['description']); ?></p>
                        <a href="<?php echo e(route('about')); ?>" class="btn">
                            More About Us
                            <i class="flaticon-right-arrow-sketch-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-image-grid">
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner mb-30">
                                <img src="<?php echo e(asset('assets/images/welcome/welcome-image-1.jpg')); ?>" alt="restaurant interior">
                            </div>
                            <div class="about-image-grid-inner mb-30">
                                <img src="<?php echo e(asset('assets/images/welcome/welcome-image-2.jpg')); ?>" alt="fresh food preparation">
                            </div>
                        </div>
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner fluid-height">
                                <img src="<?php echo e(asset('assets/images/welcome/welcome-image-3.jpg')); ?>" alt="shared dining table">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.menu-tabs', [
        'smallTitle' => 'Menu',
        'heading' => 'Just Choose From The Best',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.order-steps', [
        'orderSteps' => $orderSteps,
        'heading' => '3 Easy Steps To Enjoy',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.special-highlights', [
        'ingredientHighlights' => $ingredientHighlights,
        'smallTitle' => 'Speciality',
        'heading' => 'Our Special Ingredients',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="section-title">
                <small>Chef Picks</small>
                <h2 class="color-white">Favourites our guests come back for</h2>
            </div>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="combo-section bg-black pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <small>Combos</small>
                <h2 class="color-white">Meal deals built for proper appetite</h2>
            </div>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $combos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-6 pb-30 wow animate__slideInUp" data-wow-duration="1s" data-wow-delay="0.<?php echo e($index + 1); ?>s">
                        <div class="combo-box">
                            <div class="combo-box-image">
                                <img src="<?php echo e(asset($combo['image'])); ?>" alt="<?php echo e($combo['name']); ?>">
                            </div>
                            <div class="combo-box-content">
                                <h3><?php echo e($combo['name']); ?></h3>
                                <h4><span><?php echo e($combo['category_name']); ?></span> <?php echo e($combo['short_description']); ?></h4>
                                <a href="<?php echo e(route('shop.show', $combo['slug'])); ?>" class="btn">
                                    Order Now
                                    <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                            </div>
                            <div class="combo-offer-shape">
                                <div class="combo-shape-inner">
                                    <small>Only At</small>
                                    <p><?php echo e($combo['price_formatted']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.reviews', ['reviews' => $reviews], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('partials.subscribe-banner', [
        'title' => 'Fresh food, no shortcuts.',
        'text' => 'Order for dine-in, takeaway, or delivery at Max Kebab and enjoy premium flavour made fresh to order.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Start Your Order',
        'secondaryUrl' => 'tel:' . preg_replace('/\s+/', '', $brand['phone']),
        'secondaryLabel' => 'Call The Shop',
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/pages/home.blade.php ENDPATH**/ ?>