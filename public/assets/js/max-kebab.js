jQuery(function ($) {
    'use strict';

    function closeFlashToast($toast) {
        $toast.addClass('is-closing');

        window.setTimeout(function () {
            $toast.remove();
        }, 260);
    }

    $('.mean-menu').meanmenu({
        meanScreenWidth: '1059',
    });

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 500) {
            $('.navbar-area').addClass('is-sticky');
        } else {
            $('.navbar-area').removeClass('is-sticky');
        }

        if ($(this).scrollTop() > 0) {
            $('#scrolltop').fadeIn();
        } else {
            $('#scrolltop').fadeOut();
        }
    });

    $('body').addClass('pre-loaded');

    $('#scrolltop').on('click', function () {
        $('html').animate({ scrollTop: 0 }, 0);
        return false;
    });

    if (typeof WOW === 'function') {
        new WOW().init();
    }

    if ($.fn.owlCarousel && $('.header-carousel').length) {
        $('.header-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            dotsEach: 1,
            items: 1,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 4500,
            smartSpeed: 1500,
        });
    }

    if ($.fn.owlCarousel && $('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            dotsEach: 3,
            items: 3,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 3000,
            smartSpeed: 1500,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 },
            },
        });
    }

    if ($.fn.slick && $('.menu-main-details-for').length && $('.menu-main-thumb-nav').length) {
        $('.menu-main-details-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            infinite: false,
            draggable: false,
            asNavFor: '.menu-main-thumb-nav',
            speed: 1500,
        });

        $('.menu-main-thumb-nav').slick({
            slidesToShow: Math.min($('.menu-main-thumb-nav .menu-main-thumb-item').length, 6),
            slidesToScroll: 1,
            asNavFor: '.menu-main-details-for',
            dots: false,
            focusOnSelect: true,
            arrows: false,
            infinite: false,
            draggable: false,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        arrows: true,
                        draggable: true,
                        infinite: true,
                        prevArrow: '<i class="flaticon-left-arrow-2 prev-arrow"></i>',
                        nextArrow: '<i class="flaticon-right-arrow-3 next-arrow"></i>',
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: true,
                        draggable: true,
                        infinite: true,
                        prevArrow: '<i class="flaticon-left-arrow-2 prev-arrow"></i>',
                        nextArrow: '<i class="flaticon-right-arrow-3 next-arrow"></i>',
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: true,
                        draggable: true,
                        infinite: true,
                        prevArrow: '<i class="flaticon-left-arrow-2 prev-arrow"></i>',
                        nextArrow: '<i class="flaticon-right-arrow-3 next-arrow"></i>',
                    },
                },
            ],
        });

        $('.menu-details-carousel').each(function () {
            var carousel = $(this);
            var itemCount = carousel.children('.menu-details-carousel-item').length;
            var desktopSlides = Math.min(Math.max(itemCount, 1), 3);
            var shouldLoop = itemCount > desktopSlides;
            var shouldCenter = itemCount > 1;

            carousel.slick({
                centerMode: shouldCenter,
                centerPadding: '0',
                slidesToShow: desktopSlides,
                infinite: shouldLoop,
                autoplay: false,
                autoplaySpeed: 3000,
                speed: 1300,
                prevArrow: '<i class="flaticon-left-arrow-2 prev-arrow"></i>',
                nextArrow: '<i class="flaticon-right-arrow-3 next-arrow"></i>',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            centerMode: shouldCenter,
                            centerPadding: shouldCenter ? '180px' : '0px',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            centerMode: shouldCenter,
                            centerPadding: '0px',
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        });
    }

    if ($.fn.slick && $('.product-details-for').length && $('.product-details-nav').length) {
        $('.product-details-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.product-details-nav',
            speed: 1200,
            infinite: false,
        });

        $('.product-details-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.product-details-for',
            dots: false,
            arrows: false,
            focusOnSelect: true,
            speed: 1200,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    }

    $('.product-size-list li').on('click', function () {
        var option = $(this).data('option');
        var optionPrice = $(this).data('optionPrice');
        var caption = $(this).closest('.product-details-caption');

        $(this).addClass('active').siblings().removeClass('active');

        if (option) {
            caption.find('input[name="option"]').val(option);
        }

        if (optionPrice) {
            caption.find('[data-product-price]').text(optionPrice);
        }
    });

    $('[data-option-list]').each(function () {
        var firstOption = $(this).find('li.active').first();

        if (!firstOption.length) {
            firstOption = $(this).find('li').first().addClass('active');
        }

        if (firstOption.length) {
            firstOption.trigger('click');
        }
    });

    $(document).on('click', '.qu-btn', function () {
        var button = $(this);
        var input = button.siblings('.qu-input');
        var current = parseInt(input.val(), 10) || 1;

        if (button.hasClass('inc')) {
            input.val(current + 1);
            return;
        }

        input.val(Math.max(1, current - 1));
    });

    $('.product-details-tab-list li').on('click', function () {
        var tab = $(this).attr('data-product-tab-list');
        $(this).addClass('active').siblings().removeClass('active');
        $('.product-tab-information-item[data-product-details-tab=' + tab + ']').addClass('active').siblings().removeClass('active');
    });

    $('.productCart').on('click', function (e) {
        e.preventDefault();
        $('.cart-modal-wrapper').addClass('active');
        $('.cart-modal').addClass('active');
    });

    $('.cart-modal-close').on('click', function () {
        $('.cart-modal-wrapper').removeClass('active');
        $('.cart-modal').removeClass('active');
    });

    $('.cart-modal-wrapper').on('click', function (e) {
        if ($(e.target).is('.cart-modal-wrapper')) {
            $('.cart-modal-wrapper').removeClass('active');
            $('.cart-modal').removeClass('active');
        }
    });

    $('[data-flash-dismiss]').on('click', function () {
        closeFlashToast($(this).closest('[data-flash-toast]'));
    });

    window.setTimeout(function () {
        $('[data-flash-toast]').each(function () {
            closeFlashToast($(this));
        });
    }, 4600);

    function syncDeliveryFields() {
        var orderType = $('select[name="order_type"]');
        var deliveryFields = $('[data-delivery-fields]');

        if (!orderType.length || !deliveryFields.length) {
            return;
        }

        var isDelivery = orderType.val() === 'delivery';
        deliveryFields.toggleClass('d-none', !isDelivery);

        deliveryFields.find('[data-delivery-required]').each(function () {
            this.required = isDelivery;
        });
    }

    $('select[name="order_type"]').on('change', syncDeliveryFields);
    syncDeliveryFields();
});
