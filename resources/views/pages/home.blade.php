@php
    $title = 'Max Kebab | Northampton\'s Premium Kebab Experience';
    $description = 'Premium kebab restaurant in Northampton serving fresh wraps, burgers, wings, sides, salads, dine-in favourites, takeaway, and delivery.';
@endphp

@extends('layouts.app')

@section('content')
    <div class="header-bg">
        <div class="container">
            <div class="rev_slider_wrapper">
                <div id="rev_slider_1" class="rev_slider" data-version="5.4.5" style="display:none">
                    <ul>
                        @foreach ($heroSlides as $slide)
                            <li data-index="rs-{{ $loop->iteration }}" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off" data-title="{{ $slide['headline'] }}">
                                <div class="tp-caption LandingPage-Title tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-1"
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
                                    style="z-index: 5; white-space: normal;">{{ $slide['headline'] }}</div>

                                <div class="tp-caption LandingPage-SubTitle tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-2"
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
                                    style="z-index: 7; white-space: normal; font-style: normal;">{{ $slide['subtext'] }}</div>

                                <div class="tp-caption LandingPage-SubTitle tp-resizeme home-hero-action-group"
                                    id="slide-{{ $loop->iteration }}-layer-3"
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
                                    <a href="{{ route('shop.show', $slide['slug']) }}" class="btn">Order Now <i class="flaticon-shopping-cart-black-shape"></i></a>
                                    <p class="header-product-price color-white">
                                        {{ $slide['price'] }}
                                        @if (! empty($slide['compare_price']))
                                            <del>{{ $slide['compare_price'] }}</del>
                                        @endif
                                    </p>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-4"
                                    data-x="['right','center','center','center']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['87','380','350','398']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:0.75;sY:0.75;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset($slide['image']) }}" alt="{{ $slide['headline'] }}" data-ww="['620px','560px','520px','360px']" data-hh="['585px','535px','470px','310px']" width="620" height="585" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-5"
                                    data-x="['left','left','left','left']"
                                    data-y="['top','top','top','top']" data-voffset="['30','30','30','30']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;rZ: -120deg;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape" data-ww="['42px','42px','42px','42px']" data-hh="['43px','43px','43px','43px']" width="42" height="43" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-6"
                                    data-x="['center','center','center','center']"
                                    data-y="['top','top','top','top']" data-voffset="['50','0','12','0']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"y:-50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-2.png') }}" alt="shape" data-ww="['90px','90px','90px','90px']" data-hh="['81px','81px','81px','81px']" width="90" height="81" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-7"
                                    data-x="['right','right','right','right']"
                                    data-y="['top','top','top','top']" data-voffset="['-45','-45','-45','-75']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-3.png') }}" alt="shape" data-ww="['110px','110px','110px','110px']" data-hh="['143px','143px','143px','143px']" width="110" height="143" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-8"
                                    data-x="['right','right','right','right']"
                                    data-y="['top','top','top','top']" data-voffset="['150','150','150','150']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:-50px;rZ: -120deg;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape" data-ww="['42px','42px','42px','42px']" data-hh="['43px','43px','43px','43px']" width="42" height="43" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-9"
                                    data-x="['center','center','center','center']"
                                    data-y="['center','center','center','center']" data-voffset="['150','150','150','150']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"x:50px;rZ: -120deg;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-1.png') }}" alt="shape" data-ww="['42px','42px','42px','42px']" data-hh="['43px','43px','43px','43px']" width="42" height="43" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-10"
                                    data-x="['left','left','left','left']"
                                    data-y="['bottom','bottom','bottom','bottom']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-3.png') }}" alt="shape" data-ww="['110px','110px','110px','110px']" data-hh="['143px','143px','143px','143px']" width="110" height="143" data-no-retina>
                                </div>

                                <div class="tp-caption tp-resizeme"
                                    id="slide-{{ $loop->iteration }}-layer-11"
                                    data-x="['right','right','right','right']"
                                    data-y="['bottom','bottom','bottom','bottom']"
                                    data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"y:50px;opacity:0;","speed":1500,"to":"o:1;","delay":700,"ease":"Power3.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                    style="z-index: 8; border-width:0px;">
                                    <img src="{{ asset('assets/images/header-shape-4.png') }}" alt="shape" data-ww="['318px','300px','250px','210px']" data-hh="['209px','197px','164px','138px']" width="318" height="209" data-no-retina>
                                </div>
                            </li>
                        @endforeach
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
                        <small>Welcome To {{ $brand['name'] }}</small>
                        <h2 class="color-white">Authentic grilled flavour with a premium street-food feel</h2>
                        <p>{{ $brand['description'] }}</p>
                        <a href="{{ route('about') }}" class="btn">
                            More About Us
                            <i class="flaticon-right-arrow-sketch-1"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="about-image-grid">
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner mb-30">
                                <img src="{{ asset('assets/images/welcome/welcome-image-1.jpg') }}" alt="restaurant interior">
                            </div>
                            <div class="about-image-grid-inner mb-30">
                                <img src="{{ asset('assets/images/welcome/welcome-image-2.jpg') }}" alt="fresh food preparation">
                            </div>
                        </div>
                        <div class="about-image-grid-item">
                            <div class="about-image-grid-inner fluid-height">
                                <img src="{{ asset('assets/images/welcome/welcome-image-3.jpg') }}" alt="shared dining table">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.menu-tabs', [
        'smallTitle' => 'Menu',
        'heading' => 'Just Choose From The Best',
    ])

    @include('partials.order-steps', [
        'orderSteps' => $orderSteps,
        'heading' => '3 Easy Steps To Enjoy',
    ])

    @include('partials.special-highlights', [
        'ingredientHighlights' => $ingredientHighlights,
        'smallTitle' => 'Speciality',
        'heading' => 'Our Special Ingredients',
    ])

    <section class="shop-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="section-title">
                <small>Chef Picks</small>
                <h2 class="color-white">Favourites our guests come back for</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($featuredProducts as $product)
                    <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
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
                @foreach ($combos as $index => $combo)
                    <div class="col-sm-12 col-md-6 col-lg-6 pb-30 wow animate__slideInUp" data-wow-duration="1s" data-wow-delay="0.{{ $index + 1 }}s">
                        <div class="combo-box">
                            <div class="combo-box-image">
                                <img src="{{ asset($combo['image']) }}" alt="{{ $combo['name'] }}">
                            </div>
                            <div class="combo-box-content">
                                <h3>{{ $combo['name'] }}</h3>
                                <h4><span>{{ $combo['category_name'] }}</span> {{ $combo['short_description'] }}</h4>
                                <a href="{{ route('shop.show', $combo['slug']) }}" class="btn">
                                    Order Now
                                    <i class="flaticon-shopping-cart-black-shape"></i>
                                </a>
                            </div>
                            <div class="combo-offer-shape">
                                <div class="combo-shape-inner">
                                    <small>Only At</small>
                                    <p>{{ $combo['price_formatted'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.reviews', ['reviews' => $reviews])

    @include('partials.subscribe-banner', [
        'title' => 'Fresh food, no shortcuts.',
        'text' => 'Order for dine-in, takeaway, or delivery at Max Kebab and enjoy premium flavour made fresh to order.',
        'primaryUrl' => route('shop.index'),
        'primaryLabel' => 'Start Your Order',
        'secondaryUrl' => 'tel:' . preg_replace('/\s+/', '', $brand['phone']),
        'secondaryLabel' => 'Call The Shop',
    ])
@endsection
