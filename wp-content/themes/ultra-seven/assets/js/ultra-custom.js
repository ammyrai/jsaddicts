/** 
 * Youtube Video Section
 */

function onYouTubeIframeAPIReady() {
    var cvideo = jQuery('#initial-video').attr('data-curvideo');
    player = new YT.Player('video-placeholder', {
        width: 740,
        height: 420,
        videoId: cvideo,
    });
}
/** 
 * Ultra Seven Custon Scripts
 */

(function($) {
    'use strict';
    var win = $(window);

    //Preloader section
    win.load(function() {
        $('.ultra-seven-loader').fadeOut('slow');
    });

    /* For Header Search */
    $('.search-icon').on('click', function(e) {
        e.stopPropagation();
        $('.search-container').toggleClass('active');
        if ($('.search-container').hasClass('active')) {
            $('body').on('click', function() {
                $('.search-container').removeClass('active');
            });
            $(".search-container").on('click', function(e) {
                e.stopPropagation();
            });
        }
    });


    //Sticky Header
    if (ultra_params.sticky_menu == 'show') {
        win.scroll(function() {
            var sticky = $('.nav-search-wrap'),
                scroll = win.scrollTop();

            if (scroll >= 100) {
                sticky.addClass('fixed');
                $('.sticky-cont').addClass('ultra-container');
                $('.site-header.layout-three .ultra-logo').hide();
            } else {
                sticky.removeClass('fixed');
                $('.sticky-cont').removeClass('ultra-container');
                $('.site-header.layout-three .ultra-logo').show();
            }
        });
    }

    //Mobile toggle menu

    $('.menu-toggle').on('click touchstart', function() {
        $('.ultra-mobile-menu').addClass('on');
    });
    $('.mobile-menu-close').on('click touchstart', function() {
        $('.ultra-mobile-menu').removeClass('on');
    });

    /**
     * Mobile Submenus toggle
     *
     */
    $('.mobile-menu-wrap #site-navigation ul li ul').hide();

    $('<div class="sub-toggle"></div>').insertBefore('.mobile-menu-wrap .menu-item-has-children ul');
    $('<div class="sub-toggle-children"></div>').insertBefore('.mobile-menu-wrap .page_item_has_children ul');



    $('body').on('vclick touchstart', '.mobile-menu-wrap .sub-toggle', function() {
        $(this).next('ul.sub-menu').slideToggle('slow');
        $(this).parent('li').toggleClass('mob-menu-toggle');
    });

    $('body').on('vclick touchstart', '.mobile-menu-wrap .sub-toggle-children', function() {
        $(this).next('ul').slideToggle();
    });


    /* For Ticker */
    $('.ultra-ticker').lightSlider({
        loop: true,
        vertical: true,
        pager: false,
        auto: true,
        controls: true,
        speed: 600,
        pause: 3000,
        enableDrag: false,
        verticalHeight: 80,
        onSliderLoad: function() {
            $('.ultra-ticker').removeClass('cS-hidden');
        }
    });

    /* For main slider */
    $('.ultraSlider').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        enableDrag: false,
        loop: true,
        pager: false,
        pagerHtml: false,
        auto: true,
        speed: 700,
        pause: 4200,
        onSliderLoad: function() {
            $('.ultraSlider').removeClass('cS-hidden');

        }
    });

    /**
     * Post Slider block
     */
    $('.block-carousel').each(function() {
        var ID = $(this).closest('.ultra-block-wrapper').attr('data-id');
        var Class = $(this).closest('.ultra-block-wrapper').attr('data-class');
        $('.' + Class + " .block-carousel").lightSlider({
            pager: false,
            speed: 700,
            item: ID,
            loop: true,
            auto: true,
            enableDrag: true,
            responsive: [{
                breakpoint: 840,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 6,
                }
            }, {
                breakpoint: 480,
                settings: {
                    item: 1,
                    slideMove: 1
                }
            }],
            onSliderLoad: function() {
                $('.block-carousel').removeClass('cS-hidden');
            }
        });
    });

    /* For Single Post gallery */
    $('.ultra-gallery-items').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        enableDrag: false,
        loop: true,
        speed: 700,
        pager: false,
        auto: true,
        onSliderLoad: function() {
            $('.ultra-gallery-items').removeClass('cS-hidden');

        }
    });


    /* Related Posts Slider */
    var RelatedWrap = $(".slide .related-posts-wrapper");
    RelatedWrap.lightSlider({
        item: 3,
        pager: false,
        enableDrag: false,
        controls: false,
        speed: 650,
        onSliderLoad: function() {
            RelatedWrap.removeClass('cS-hidden');
        },
        responsive: [{
            breakpoint: 840,
            settings: {
                item: 2,
                slideMove: 1,
                slideMargin: 6,
            }
        }, {
            breakpoint: 480,
            settings: {
                item: 1,
                slideMove: 1,
            }
        }]
    });

    $('.slide-action .ultra-lSPrev').on('click', function() {
        RelatedWrap.goToPrevSlide();
    });
    $('.slide-action .ultra-lSNext').on('click', function() {
        RelatedWrap.goToNextSlide();
    });

    /* Woo SLider */
    var wooSlider = $(".tabs-cat-product");
    wooSlider.lightSlider({
        item: 4,
        pager: false,
        loop: true,
        speed: 600,
        controls: false,
        slideMargin: 20,
        onSliderLoad: function() {
            $('.tabs-cat-product').removeClass('cS-hidden');
        },
        responsive: [{
            breakpoint: 800,
            settings: {
                item: 2,
                slideMove: 1,
                slideMargin: 6,
            }
        }, {
            breakpoint: 480,
            settings: {
                item: 1,
                slideMove: 1,
            }
        }]
    });

    $('.ultra-lSPrev').click(function() {
        wooSlider.goToPrevSlide();
    });
    $('.ultra-lSNext').click(function() {
        wooSlider.goToNextSlide();
    });

    /* Recent Popular tabs*/
    $(".widget_ultra_seven_widget_tabs .widget-tab-titles li").on('click', function() {
        $(this).siblings("li").removeClass('active');
        $(this).addClass("active");
        $(this).parents(".widget_ultra_seven_widget_tabs").find(".tab-content").hide();
        var selected_tab = $(this).find("a").attr("href");
        $(this).parents(".widget_ultra_seven_widget_tabs").find(selected_tab).show();
        return false;
    });

    /**
     * Youtube list selector with play and pause
     */

    $('.vplay').on('click', function() {
        player.playVideo();
        $(this).hide();
        $('.vpause').show();
    });

    $('.vpause').on('click', function() {
        player.pauseVideo();
        $(this).hide();
        $('.vplay').show();
    });

    $(document).on('click', '.list-thumb', function() {
        $('.list-thumb').removeClass('now-playing');
        $(this).addClass('now-playing');

        $('.vpause').hide();
        $('.vplay').show();

        var url = $(this).attr('data-videoid');
        var vid_title = $(this).attr('data-videotitle');
        var vid_time = $(this).attr('data-videotime');

        $('.curVideo-title').html(vid_title);
        $('.curVideo-time').html(vid_time);
        player.cueVideoById(url);
    });

    /**
     * Sticky Sidebar
     */
    if (ultra_params.sidebar_sticky == 'show') {
        $('.primary, .secondary').theiaStickySidebar();
    }
    /**
     * WoW Animation
     */
    if (ultra_params.wow == 'show') {
        new WOW().init();
    }

    //Fix audio and video size
    $(".ultra-single-content").fitVids();
    $(".ultra-single-content").fitVids({
        customSelector: "iframe[src^='https://w.soundcloud.com']"
    });


    /**
     * Back to top button
     **/
    win.scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#ultra-go-top').fadeIn();
        } else {
            $('#ultra-go-top').fadeOut();
        }
    });

    $('#ultra-go-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    });

})(jQuery);