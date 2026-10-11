/**
 * Fescon (Pvt.) Ltd - Core JavaScript Controller
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // -------------------------------------------------------------
        // 1. Mobile Menu Toggle
        // -------------------------------------------------------------
        $('.hfe-nav-menu__toggle').on('click', function(e) {
            e.preventDefault();
            var $wrapper = $(this).closest('.hfe-nav-menu__layout-horizontal, .hfe-nav-menu');
            $wrapper.toggleClass('menu-is-active');
            var $nav = $(this).siblings('nav');
            if ($nav.length) {
                $nav.slideToggle(250);
            }
        });

        // Mobile submenu arrows
        $('.hfe-has-submenu-container').on('click', function(e) {
            if ($(window).width() <= 1024) {
                var $sub = $(this).siblings('.sub-menu');
                if ($sub.length) {
                    e.preventDefault();
                    $sub.slideToggle(200);
                }
            }
        });

        // -------------------------------------------------------------
        // 2. Scroll Animations (IntersectionObserver)
        // -------------------------------------------------------------
        var animatedElements = document.querySelectorAll('.elementor-invisible');
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var el = entry.target;
                        var settings = el.getAttribute('data-settings');
                        var animClass = '';
                        if (settings) {
                            try {
                                var parsed = JSON.parse(settings);
                                animClass = parsed.animation || parsed._animation || '';
                            } catch(err) {}
                        }
                        if (animClass) {
                            el.classList.add(animClass);
                        }
                        el.classList.remove('elementor-invisible');
                        el.classList.add('animated');
                        observer.unobserve(el);
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: '50px 0px 50px 0px'
            });

            animatedElements.forEach(function(el) {
                observer.observe(el);
            });

            // Fallback timeout to guarantee all elements become visible
            setTimeout(function() {
                animatedElements.forEach(function(el) {
                    if (el.classList.contains('elementor-invisible')) {
                        el.classList.remove('elementor-invisible');
                        el.classList.add('animated');
                    }
                });
            }, 1200);
        } else {
            // Fallback for older browsers
            animatedElements.forEach(function(el) {
                el.classList.remove('elementor-invisible');
            });
        }

        // -------------------------------------------------------------
        // 3. Scroll To Top Button
        // -------------------------------------------------------------
        var $scrollTopBtn = $('.hfe-scroll-to-top-wrap');
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 150) {
                $scrollTopBtn.fadeIn(250);
            } else {
                $scrollTopBtn.fadeOut(250);
            }
        });

        $scrollTopBtn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 400);
        });

        // -------------------------------------------------------------
        // 4. Contact Form 7 AJAX Submission Handler
        // -------------------------------------------------------------
        $('form.wpcf7-form').on('submit', function(e) {
            var $form = $(this);
            var $output = $form.find('.wpcf7-response-output');
            var $submitBtn = $form.find('input[type="submit"]');

            $submitBtn.prop('disabled', true).addClass('is-submitting');
            if (!$output.length) {
                $output = $('<div class="wpcf7-response-output" aria-hidden="false"></div>').appendTo($form);
            }

            $.ajax({
                url: $form.attr('action') || 'contact-handler.php',
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(res) {
                    $submitBtn.prop('disabled', false).removeClass('is-submitting');
                    if (res.status === 'mail_sent') {
                        $output.css({
                            'display': 'block',
                            'border': '2px solid #46b450',
                            'padding': '12px 16px',
                            'margin': '15px 0',
                            'background': '#eaf8ea',
                            'color': '#2e6930',
                            'border-radius': '4px'
                        }).text(res.message);
                        $form[0].reset();
                    } else {
                        $output.css({
                            'display': 'block',
                            'border': '2px solid #dc3232',
                            'padding': '12px 16px',
                            'margin': '15px 0',
                            'background': '#fdf2f2',
                            'color': '#a92020',
                            'border-radius': '4px'
                        }).text(res.message || 'There was an error sending your message.');
                    }
                },
                error: function(xhr) {
                    $submitBtn.prop('disabled', false).removeClass('is-submitting');
                    var msg = 'An error occurred. Please try again later.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    $output.css({
                        'display': 'block',
                        'border': '2px solid #dc3232',
                        'padding': '12px 16px',
                        'margin': '15px 0',
                        'background': '#fdf2f2',
                        'color': '#a92020',
                        'border-radius': '4px'
                    }).text(msg);
                }
            });
            e.preventDefault();
        });

        // -------------------------------------------------------------
        // 5. Sticky Elements Popup Form AJAX Handler
        // -------------------------------------------------------------
        $('#stickyelements-form').on('submit', function(e) {
            var $form = $(this);
            var $errorBox = $form.find('#mse-form-error');

            $.ajax({
                url: $form.attr('action') || 'sticky-handler.php',
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.status == 1) {
                        $errorBox.css({
                            'display': 'block',
                            'color': '#28a745',
                            'padding': '8px',
                            'margin-top': '8px'
                        }).text(res.message);
                        $form[0].reset();
                        setTimeout(function() {
                            $errorBox.fadeOut();
                        }, 4000);
                    } else {
                        $errorBox.css({
                            'display': 'block',
                            'color': '#dc3545',
                            'padding': '8px',
                            'margin-top': '8px'
                        }).text(res.message || 'Validation error');
                    }
                },
                error: function() {
                    $errorBox.css({
                        'display': 'block',
                        'color': '#dc3545',
                        'padding': '8px',
                        'margin-top': '8px'
                    }).text('Failed to send message.');
                }
            });
            e.preventDefault();
        });

        // -------------------------------------------------------------
        // 6. Elementor Image Carousel (Swiper) Auto-Init
        // -------------------------------------------------------------
        function initImageCarousels() {
            if (typeof Swiper === 'undefined') return;
            $('.elementor-widget-image-carousel').each(function() {
                var $widget = $(this);
                var $wrapper = $widget.find('.elementor-image-carousel-wrapper.swiper');
                if (!$wrapper.length || $wrapper.hasClass('swiper-initialized')) return;

                var settings = {};
                try {
                    settings = JSON.parse($widget.attr('data-settings') || '{}');
                } catch(e) {}

                var isOngoing = $widget.hasClass('elementor-element-8c419d7');
                var spaceBetween = 20;
                if (settings.image_spacing_custom && settings.image_spacing_custom.size !== undefined) {
                    spaceBetween = parseInt(settings.image_spacing_custom.size, 10);
                }

                new Swiper($wrapper[0], {
                    slidesPerView: isOngoing ? 3 : 4,
                    spaceBetween: spaceBetween,
                    loop: settings.infinite !== 'no',
                    speed: settings.speed || 600,
                    autoplay: settings.autoplay === 'yes' ? {
                        delay: settings.autoplay_speed || 3500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: settings.pause_on_hover === 'yes'
                    } : false,
                    navigation: {
                        nextEl: $widget.find('.elementor-swiper-button-next')[0],
                        prevEl: $widget.find('.elementor-swiper-button-prev')[0]
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 10
                        },
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 15
                        },
                        1024: {
                            slidesPerView: isOngoing ? 3 : 4,
                            spaceBetween: spaceBetween
                        }
                    }
                });
            });
        }
        initImageCarousels();
    });
})(jQuery);
