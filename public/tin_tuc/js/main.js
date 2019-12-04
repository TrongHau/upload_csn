/*
 *   Template: CSN
 *   Author: EAS Team
 */
let CSN = {};
(function($) {
    /************************************************************
     * Predefined letiables
     *************************************************************/

    let $window = $(window),
        $document = $(document),
        $html = $('html'),
        $body = $('body');

    /**
     * exists - VinhBQ
     * @return true
     */
    $.fn.exists = function() {
        return this.length > 0;
    };

    /**
     * isMobile - Check mobile screen - TuanNA
     * @return void
     */
    $.fn.isMobile = function() {
        let screen = $window.outerWidth();
        return !!(screen < 601);
    };

    /**
     * uaSetting - TuanNA
     * @return void
     */
    CSN.uaSetting = function() {
        let _ua = (function(u) {
            return {
                Tablet: (u.indexOf('windows') !== -1 && u.indexOf('touch') !== -1 && u.indexOf('tablet pc') === -1) ||
                    u.indexOf('ipad') !== -1 ||
                    (u.indexOf('android') !== -1 && u.indexOf('mobile') === -1) ||
                    (u.indexOf('firefox') !== -1 && u.indexOf('tablet') !== -1) ||
                    u.indexOf('kindle') !== -1 ||
                    u.indexOf('silk') !== -1 ||
                    u.indexOf('playbook') !== -1,
                Mobile: (u.indexOf('windows') !== -1 && u.indexOf('phone') !== -1) ||
                    u.indexOf('iphone') !== -1 ||
                    u.indexOf('ipod') !== -1 ||
                    (u.indexOf('android') !== -1 && u.indexOf('mobile') !== -1) ||
                    (u.indexOf('firefox') !== -1 && u.indexOf('mobile') !== -1) ||
                    u.indexOf('blackberry') !== -1,
            }
        })(window.navigator.userAgent.toLowerCase());
        if (_ua.Tablet || _ua.Mobile) {
            $body.addClass('sp');
        }
    }



    /**
     *  slider - VinhBQ
     *  slider in banner
     */
    CSN.slider = function(object) {
        //if ($(object).children('.c-item').length > 1) {
            $(object).slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                        breakpoint: 1170,
                        settings: {
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 610,
                        settings: {
                            slidesToShow: 2,
                            arrows: false,
                        }
                    }
                ]
            });
        //}
    };
    CSN.sliderNav = function(object) {
        $(object).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '#c-slider__main--nav',
            dots: true,
        });
        $('#c-slider__main--nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '#c-slider__main',
            dots: false,
            arrows: false,
            // centerMode: true,
            focusOnSelect: true,
            centerPadding: 0,
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                    }
                },
            ],
        });
    };


    /**
     *  menumobile - VinhBQ
     *  open or close menu in mobile
     */
    CSN.menumobile = function(obj) {
        let btn_menumobile = $(obj);
        btn_menumobile.on('click', function() {
            $(this).toggleClass('open');
            $('html').toggleClass('openMenu');
        })
    }

    /**
     *  fixBrowser - VinhBQ
     *  custom for browser
     */
    CSN.fixBrowser = function() {
        var ua = navigator.userAgent.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i),
            browser;
        if (navigator.userAgent.match(/Edge/i) || navigator.userAgent.match(/Trident.*rv[ :]*11\./i)) {
            browser = "msie";
        } else {
            browser = ua[1].toLowerCase();
        }
        $html.addClass(browser);
    }

    CSN.imgObjectFitIE = function(elem) {
        let userAgent, ieReg, ie;
        userAgent = window.navigator.userAgent;
        ieReg = /msie|Trident.*rv[ :]*11\./gi;
        ie = ieReg.test(userAgent);

        if (ie) {
            $(elem).each(function() {
                let $container = $(this),
                    imgUrl = $container.find("img").prop("src");
                $container.find("img").hide();
                if (imgUrl) {
                    $container.css({ "background": 'url(' + imgUrl + ') no-repeat center / cover;' }).addClass("custom-object-fit");
                }
            });
        }
    }


    /**
     *  call function
     */
    $document.ready(function() {
        CSN.menumobile('.c-btn__menu--mobile');
        CSN.slider('.slider4item');
        CSN.sliderNav('#c-slider__main');
    })

})(jQuery);