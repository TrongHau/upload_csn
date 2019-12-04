var swiper1 = new Swiper('.swiper1', {
    slidesPerView: 'auto',
    loop: false,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    centeredSlides: false,    
    resizeReInit: true
});
if(typeof swiper1.slides !== 'undefined') {
    swiper1.slides.each(function(index, val) {
        var ele = $(this);
        ele.on("click", function() {
            swiper2.slideTo(index, 300, false);
            swiper1.slideTo(index, 300, false);
            if (typeof slideSwiperChange !== 'undefined' && typeof slideSwiperChange === 'function') {
                slideSwiperChange(swiper1, 'click');
            }
        });
    });


    var swiper2 = new Swiper('.swiper2', {
        direction: 'horizontal',
        loop: false,
        autoHeight: true,
        resizeReInit: true,
        noSwiping: true,
        noSwipingClass: 'owl-carousel',
        thumbs: {
            swiper: swiper1,
        },
        on: {
            slideChangeTransitionEnd: function () {
                var n = $(this)[0].activeIndex;
                swiper1.slideTo(n, 300, false);
                if (typeof slideSwiperChange !== 'undefined' && typeof slideSwiperChange === 'function') {
                    slideSwiperChange(swiper1, 'click');
                }
            },
        }
    });
}


jQuery(document).ready(function($) {
    'use strict';

    $('.slider_home').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        center: true,
        items: 1.3,
        dots: true,
        autoplay: true,
    });

    $('.slide-chude').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        items: 1.6,
        dots: false,
    });

    $('.slide-album').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        items: 2.3,
        dots: false,
    });

    $('.header_top .navbar-toggler').click(function(e) {
        e.preventDefault();
        var $body = $(this).parents('body');
        $(this).toggleClass('show');
        $body.toggleClass('show_menu overlay');
        $body.find('.menumain').fadeToggle('fast');
        $body.scrollTop(0);
    });

    $('.button_search').click(function(e) {
        e.preventDefault();
        var $body = $(this).parents('body');
        $body.addClass('overlay');
        $body.find('.wrap-search').addClass('open');
        $body.scrollTop(0);
    });
    $('.button_close').click(function(e) {
        e.preventDefault();
        var $body = $(this).parents('body');
        $body.removeClass('overlay');
        $(this).parents('.wrap-search').removeClass('open');
    });
    $('.toggle_wishlist').click(function(e) {
        e.preventDefault();
        var $body = $(this).parents('body');
        $(this).toggleClass('selector');
    });

    $(document).on("click", ".reply_comment", function(e) {
        e.preventDefault();
        var $this = $(this);
        $this.parents('.block_form_comment').find('.form_reply_comment').slideToggle('fast');
    })

    // Hiển thị sub
    $(document).on("click", ".button-test-swiper", function(e) {
        e.preventDefault();
        $('body').find('#show_content').fadeToggle('fast', function() {
            swiper2.update();
        });
    })
});