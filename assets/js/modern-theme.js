/**
 * Fescon (Pvt.) Ltd - Modern Corporate Theme Controller
 * Parallax scrolling, reveal animations, counters, and mobile interaction.
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {

        // -------------------------------------------------------------
        // 1. Cinematic Parallax Scrolling Engine (fesconinternational.com parity)
        // -------------------------------------------------------------
        const parallaxHeroSections = document.querySelectorAll('.hero-section');
        const projectsBg = document.querySelector('.parallax-projects-bg');
        const header = document.querySelector('.site-header');
        const scrollTopBtn = document.querySelector('.scroll-top-btn');
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        let lastScrollY = window.pageYOffset;
        let ticking = false;

        function updateParallax() {
            const scrollY = lastScrollY;
            const windowHeight = window.innerHeight;
            const isMobile = window.innerWidth <= 768;

            // Parallax on hero section (Exact fesconinternational.com calculation)
            if (!prefersReducedMotion.matches && !isMobile && parallaxHeroSections.length > 0) {
                parallaxHeroSections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top < windowHeight && rect.bottom > 0) {
                        const speed = 0.35;
                        const yPos = -(rect.top * speed);
                        section.style.backgroundPositionY = `calc(50% + ${yPos}px)`;
                    }
                });
            }

            // Parallax on project section background
            if (projectsBg) {
                const projectsSection = projectsBg.closest('.parallax-projects-section');
                if (projectsSection) {
                    const rect = projectsSection.getBoundingClientRect();
                    if (rect.top < windowHeight && rect.bottom > 0) {
                        const relativeScroll = (windowHeight - rect.top) * 0.18;
                        projectsBg.style.transform = `translate3d(0, ${relativeScroll}px, 0)`;
                    }
                }
            }

            // Header Scrolled Glass Effect
            if (header) {
                if (scrollY > 60) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }

            // Scroll To Top Button Visibility
            if (scrollTopBtn) {
                if (scrollY > 300) {
                    scrollTopBtn.classList.add('visible');
                } else {
                    scrollTopBtn.classList.remove('visible');
                }
            }

            ticking = false;
        }

        function onScroll() {
            lastScrollY = window.pageYOffset;
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', () => {
            if (window.innerWidth <= 768) {
                parallaxHeroSections.forEach(section => {
                    section.style.backgroundPositionY = '';
                });
            } else {
                updateParallax();
            }
        });
        updateParallax(); // Initial positioning

        // Scroll to top click
        if (scrollTopBtn) {
            scrollTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // -------------------------------------------------------------
        // 2. Smooth Reveal Animations on Scroll (IntersectionObserver)
        // -------------------------------------------------------------
        const revealElements = document.querySelectorAll('[data-reveal]');
        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -40px 0px'
            });

            revealElements.forEach(el => revealObserver.observe(el));

            // Fallback timeout
            setTimeout(() => {
                revealElements.forEach(el => {
                    if (!el.classList.contains('revealed')) {
                        el.classList.add('revealed');
                    }
                });
            }, 1200);
        } else {
            revealElements.forEach(el => el.classList.add('revealed'));
        }

        // -------------------------------------------------------------
        // 3. Animated Metric Counters
        // -------------------------------------------------------------
        const counterElements = document.querySelectorAll('.counter-val');
        if ('IntersectionObserver' in window && counterElements.length) {
            const counterObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const target = parseInt(el.getAttribute('data-target') || el.innerText, 10);
                        if (!isNaN(target)) {
                            animateValue(el, 0, target, 1800);
                        }
                        observer.unobserve(el);
                    }
                });
            }, { threshold: 0.2 });

            counterElements.forEach(el => counterObserver.observe(el));
        }

        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                // EaseOutQuad
                const ease = 1 - (1 - progress) * (1 - progress);
                obj.innerHTML = Math.floor(ease * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    obj.innerHTML = end;
                }
            };
            window.requestAnimationFrame(step);
        }

        // -------------------------------------------------------------
        // 4. Mobile Navigation Drawer & Accordion
        // -------------------------------------------------------------
        const mobileToggle = document.querySelector('.mobile-toggle-btn');
        const navMenu = document.querySelector('.nav-menu');

        if (mobileToggle && navMenu) {
            mobileToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                navMenu.classList.toggle('open');
                const isOpen = navMenu.classList.contains('open');
                mobileToggle.setAttribute('aria-expanded', isOpen);
                mobileToggle.innerHTML = isOpen ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });

            // Close on clicking outside
            document.addEventListener('click', function(e) {
                if (navMenu.classList.contains('open') && !navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                    navMenu.classList.remove('open');
                    mobileToggle.setAttribute('aria-expanded', 'false');
                    mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
                }
            });

            // Dropdown toggles on mobile
            const parentItems = navMenu.querySelectorAll('.nav-item.has-dropdown');
            parentItems.forEach(item => {
                const link = item.querySelector('.nav-link');
                link.addEventListener('click', function(e) {
                    if (window.innerWidth <= 900) {
                        e.preventDefault();
                        item.classList.toggle('dropdown-open');
                    }
                });
            });
        }

        // -------------------------------------------------------------
        // 5. Project Showcase Category Filters
        // -------------------------------------------------------------
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projectCards = document.querySelectorAll('.project-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                projectCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'flex';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(15px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 250);
                    }
                });
            });
        });

        // -------------------------------------------------------------
        // 6. Modern Consultation Form AJAX Submission
        // -------------------------------------------------------------
        const consultForm = document.getElementById('consultation-form');
        if (consultForm) {
            consultForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                const responseMsg = form.querySelector('.form-response-msg');

                const originalBtnText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

                const formData = new FormData(form);

                fetch(form.getAttribute('action') || 'contact-handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;

                    if (responseMsg) {
                        responseMsg.style.display = 'block';
                        if (data.status === 'mail_sent' || data.status === 1) {
                            responseMsg.style.backgroundColor = 'rgba(34, 197, 94, 0.15)';
                            responseMsg.style.color = '#4ade80';
                            responseMsg.style.border = '1px solid rgba(34, 197, 94, 0.3)';
                            responseMsg.innerHTML = '<i class="fas fa-check-circle"></i> ' + (data.message || 'Thank you! Your inquiry has been sent successfully. Our team will contact you shortly.');
                            form.reset();
                        } else {
                            responseMsg.style.backgroundColor = 'rgba(239, 68, 68, 0.15)';
                            responseMsg.style.color = '#f87171';
                            responseMsg.style.border = '1px solid rgba(239, 68, 68, 0.3)';
                            responseMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + (data.message || 'Error sending inquiry. Please try again.');
                        }
                    }
                })
                .catch(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                    if (responseMsg) {
                        responseMsg.style.display = 'block';
                        responseMsg.style.backgroundColor = 'rgba(239, 68, 68, 0.15)';
                        responseMsg.style.color = '#f87171';
                        responseMsg.style.border = '1px solid rgba(239, 68, 68, 0.3)';
                        responseMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> An unexpected network error occurred. Please call us directly.';
                    }
                });
            });
        }

        // -------------------------------------------------------------
        // 7. Swiper Carousel Init for Certifications & Ongoing Projects
        // -------------------------------------------------------------
        if (typeof Swiper !== 'undefined') {
            const certSwiperEl = document.querySelector('.cert-swiper-container');
            if (certSwiperEl) {
                new Swiper(certSwiperEl, {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: true,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.cert-swiper-pagination',
                        clickable: true
                    },
                    breakpoints: {
                        640: { slidesPerView: 2, spaceBetween: 20 },
                        1024: { slidesPerView: 4, spaceBetween: 24 }
                    }
                });
            }
        }

    });
})();
