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
        $(this).toggleClass('show');
        $(this).parents('.navbar').toggleClass('bg-black-cs');
        $(this).parents('.header_top').toggleClass('show_menu');
        $(this).parents('body').toggleClass('overflow-hidden');
    });

    $('.button_search').click(function(e) {
        e.preventDefault();
        $(this).parents('body').find('.block_search_fixed').addClass('show');
        $(this).parents('body').find('.wrap-search').addClass('open');
    });

    $('.button_close').click(function(e) {
        e.preventDefault();
        $(this).parents('.block_search_fixed').removeClass('show');
        $(this).parents('.wrap-search').removeClass('open');
    });

    $('.block_more .icon').click(function(e) {
        $('.wrap-bottom-sheet').show();
        $('.bottom-sheet').slideDown();
    });
    $('.wrap-bottom-sheet').click(function(e) {
        $(this).hide();
        $('.bottom-sheet').slideUp();
    });

    $('.block_button .icon').click(function(e) {
        $('.wrap-bottom-sheet').show();
        jQuery('.bottom-sheet').slideDown();
    });

    // $('#time_player').slider();
    // $('#playlist_time_player').slider();
    // $('#binhluan_time_player').slider();
    window.onload = function() {
        var itemMenu = $(".swiper1").data('itemmenu');

        function setCurrentSlide(ele, index) {
            $(".swiper1 .swiper-slide").removeClass("selected");
            ele.addClass("selected");
        }

        var swiper1 = new Swiper('.swiper1', {
            slidesPerView: itemMenu,
            paginationClickable: true,
            spaceBetween: 10,
            freeMode: true,
            loop: false,
            onTab: function(swiper) {
                var n = swiper1.clickedIndex;
            }
        });
        if(swiper1.slides.length) {
            swiper1.slides.each(function(index, val) {
                var ele = $(this);
                ele.on("click", function() {
                    setCurrentSlide(ele, index);
                    swiper2.slideTo(index, 500, false);
                });
            });
        }
        var swiper2 = new Swiper('.swiper2', {
            direction: 'horizontal',
            loop: false,
            autoHeight: true,
            onSlideChangeEnd: function(swiper) {
                var n = swiper.activeIndex;
                setCurrentSlide($(".swiper1 .swiper-slide").eq(n), n);
                swiper1.slideTo(n, 500, false);
            }
        });
    }
});