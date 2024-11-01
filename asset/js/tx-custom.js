(function ($) {
    "use strict";

    var Tx_accordion = function ($scope, $) {
        $scope.find('.txacdn').each(function () {

            var settings = $(this).data('xld');
            var faction = $('.accordion.' + settings['id'] + ' ' + 'li:eq(0) .accortitle');
            var saction = $('.accordion.' + settings['id'] + ' ' + '.accortitle');

            faction.addClass('active').next().slideDown();

            saction.click(function (j) {
                var dropDown = $(this).closest('li').find('p');
                $(this).closest('.accordion').find('p').not(dropDown).slideUp();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).closest('.accordion').find('.accortitle.active').removeClass('active');
                    $(this).addClass('active');
                }
                dropDown.stop(false, true).slideToggle();
                j.preventDefault();

            });
        });
    };

    var Tx_scroll_feedback = function ($scope, $) {
        $scope.find('.tx-scroll-feedback').each(function () {

            var settings = $(this).data('xld');
            var lastScrollTop = 0, delta = 5;
            var tx_wrap = $(this);
            $(this).parents('.elementor-widget-wrap').addClass('tx-no-overflow');
            $(document).ready(function () {
                $(document).on('scroll', function () {
                    var nowScrollTop = $(this).scrollTop();
                    var new_pos = nowScrollTop / 10;
                    var direction = settings['invert'] ? '-' : '+';
                    if (Math.abs(lastScrollTop - nowScrollTop) >= delta) {
                        if (nowScrollTop > lastScrollTop) {
                            var dist = direction + new_pos + 'px';
                            tx_wrap.css({ transform: 'translate3d( ' + dist + ', 0px, 0px)' });
                        } else {
                            var dist = direction + new_pos + 'px';
                            tx_wrap.css({ transform: 'translate3d( ' + dist + ', 0px, 0px)' })
                        }
                        lastScrollTop = nowScrollTop;
                    }
                }).trigger('scroll');
            });

        });
    };

    var Tx_Animate_Grad_Bg = function ($scope, $) {

        if (!$scope.hasClass('tx-gradient-bg-yes')) {
            return;
        }

        var color = $scope.data('color'),
            angle = $scope.data('angle'),
            gradientColor = 'linear-gradient( ' + angle + ',' + color + ' )';

        $scope.css('background-image', gradientColor);

    };

    var Tx_Sticky_Section = function ($scope, $) {

        var exadStickySection = $scope.find('.exad-sticky-section-yes').eq(0);
       
        exadStickySection.each(function(i) {
            var dataSettings = $(this).data('settings');
            $.each( dataSettings, function(index, value) { 
                if( index === 'exad_sticky_top_spacing' ){
                    $scope.find('.exad-sticky-section-yes').css( "top", value + "px" );
                }
            }); 
        });
        $scope.each(function(i) {
            var sectionSettings = $scope.data("settings");
            $.each( sectionSettings, function(index, value) { 
                if( index === 'exad_sticky_top_spacing' ){
                    $scope.css( "top", value + "px" );
                }
            }); 
        });
        
        if ( exadStickySection.length > 0 ) {
            var parent = document.querySelector('.exad-sticky-section-yes').parentElement;
            while (parent) {
                var hasOverflow = getComputedStyle(parent).overflow;
                if (hasOverflow !== 'visible') {
                    parent.style.overflow = "visible"
                }
                parent = parent.parentElement;
            }
        }
    
        var columnClass = $scope.find( '.exad-column-sticky' );
        var dataId = columnClass.data('id');
        var dataType = columnClass.data('type');
        var topSpacing = columnClass.data('top_spacing');
    
        if( dataType === 'column' ){
            var $target  = $scope;
            var wrapClass = columnClass.find( '.elementor-widget-wrap' );
        
            wrapClass.stickySidebar({
                topSpacing: topSpacing,
                bottomSpacing: 60,
                containerSelector: '.elementor-row',
                innerWrapperSelector: '.elementor-column-wrap',
            });
        }
    };


    var Tx_Wrapper_Link = function ($scope, $) {
        $scope.find('.tx-wrapper-link').each(function () {
            var _this = $(this);
            var settings = _this.data('tx-wrapper-link');
            _this.css('cursor', 'pointer');
            console.log(_this);
            _this.on('click', function () {
                var url = settings['url'];

                var win = window.open(url, $(this).data('column-clickable-blank'));
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    console.log('Please allow popups for this website');
                }
            });
        });
    };


    var Tx_Testimonial_1 = function ($scope, $) {
        $scope.find('.txswiper').each(function () {
            var settings = $(this).data('xld');
            var options = {
                slidesPerView: 1,
                pagination: {
                    el: $(this).find('.swiper-pagination'),
                    clickable: true,
                },
                autoplay: {
                    delay: settings['speed'],
                    enabled: settings['auto'],
                },
                spaceBetween: settings['space'],

                breakpoints: {
                    1140: {
                        slidesPerView: settings['item'],
                    },
                    768: {
                        slidesPerView: settings['itemtab'],
                    },
                    1: {
                        slidesPerView: 1,
                    },
                },
                loop: true,
                navigation: {
                    nextEl: $(this).find('.txprev'),
                    prevEl: $(this).find('.txnxt'),
                }
            };

            if ('undefined' === typeof Swiper) {
                const asyncSwiper = elementorFrontend.utils.swiper;
                new asyncSwiper($(this), options).then((newSwiperInstance) => {
                    var swiper = newSwiperInstance;
                });

            } else {
                var swiper = new Swiper($(this), options);
            }
        });
    };

    function tx_front_back_script(){

        $(document).on("scroll", function(){
            var pixels = $(document).scrollTop();
            var pageHeight = $(document).height() - $(window).height();
            var progress = 100 * pixels / pageHeight;
            
            $("div.progress").css("width", progress + "%");
        })
		
        if ( $('.tx-back-top').length){
            var progressPath = document.querySelector('.tx-back-top path');
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';		
            var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            }
            updateProgress();
            $(window).scroll(updateProgress);	
            var offset = 50;
            var duration = 550;
            jQuery(window).on('scroll', function() {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.tx-back-top').addClass('active-progress');
                } else {
                    jQuery('.tx-back-top').removeClass('active-progress');
                }
            });				
            jQuery('.tx-back-top').on('click', function(event) {
                event.preventDefault();
                jQuery('html, body').animate({scrollTop: 0}, duration);
                return false;
            }) 
        }
       
    }

    $(window).on('elementor/frontend/init', function () {

        if (elementorFrontend.isEditMode()) {

            elementorFrontend.hooks.addAction('frontend/element_ready/tx-accordion.default', Tx_accordion);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-testimonial-1.default', Tx_Testimonial_1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-scrollfeedback.default', Tx_scroll_feedback);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-client.default', Tx_Testimonial_1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-team-1.default', Tx_Testimonial_1);

            elementorFrontend.hooks.addAction('frontend/element_ready/section', Tx_Animate_Grad_Bg);

            tx_front_back_script();

        } else {

            elementorFrontend.hooks.addAction('frontend/element_ready/tx-accordion.default', Tx_accordion);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-testimonial-1.default', Tx_Testimonial_1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-scrollfeedback.default', Tx_Testimonial_1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-client.default', Tx_Testimonial_1);
            elementorFrontend.hooks.addAction('frontend/element_ready/tx-team-1.default', Tx_Testimonial_1);

            elementorFrontend.hooks.addAction('frontend/element_ready/section', Tx_Animate_Grad_Bg);
            elementorFrontend.hooks.addAction('frontend/element_ready/global', Tx_Wrapper_Link);
            elementorFrontend.hooks.addAction('frontend/element_ready/global', Tx_Sticky_Section);
            
        }

    });

    tx_front_back_script();

})(jQuery);