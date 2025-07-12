document.addEventListener("DOMContentLoaded", (event) => {
    // preloader
    const preloader = document.getElementById('preloader');
    preloader.style.display = 'none';
    document.body.style.position = 'static';

    // HEADER NAV IN MOBILE
    if (document.querySelector(".ul-header-nav")) {
        const ulSidebar = document.querySelector(".ul-sidebar");
        const ulSidebarOpener = document.querySelector(".ul-header-sidebar-opener");
        const ulSidebarCloser = document.querySelector(".ul-sidebar-closer");
        const ulMobileMenuContent = document.querySelector(".to-go-to-sidebar-in-mobile");
        const ulHeaderNavMobileWrapper = document.querySelector(".ul-sidebar-header-nav-wrapper");
        const ulHeaderNavOgWrapper = document.querySelector(".ul-header-nav-wrapper");

        function updateMenuPosition() {
            if (window.innerWidth < 992) {
                ulHeaderNavMobileWrapper.appendChild(ulMobileMenuContent);
            }

            if (window.innerWidth >= 992) {
                ulHeaderNavOgWrapper.appendChild(ulMobileMenuContent);
            }
        }

        updateMenuPosition();

        window.addEventListener("resize", () => {
            updateMenuPosition();
        });

        ulSidebarOpener.addEventListener("click", () => {
            ulSidebar.classList.add("active");
        });

        ulSidebarCloser.addEventListener("click", () => {
            ulSidebar.classList.remove("active");
        });


        // menu dropdown/submenu in mobile
        const ulHeaderNavMobile = document.querySelector(".ul-header-nav");
        const ulHeaderNavMobileItems = ulHeaderNavMobile.querySelectorAll(".has-sub-menu");
        ulHeaderNavMobileItems.forEach((item) => {
            if (window.innerWidth < 992) {
                item.addEventListener("click", () => {
                    item.classList.toggle("active");
                });
            }
        });
    }

    // header search in mobile start
    const ulHeaderSearchOpener = document.querySelector(".ul-header-search-opener");
    const ulHeaderSearchCloser = document.querySelector(".ul-search-closer");
    if (ulHeaderSearchOpener) {
        ulHeaderSearchOpener.addEventListener("click", () => {
            document.querySelector(".ul-search-form-wrapper").classList.add("active");
        });
    }

    if (ulHeaderSearchCloser) {
        ulHeaderSearchCloser.addEventListener("click", () => {
            document.querySelector(".ul-search-form-wrapper").classList.remove("active");
        });
    }
    // header search in mobile end

    // sticky header
    const ulHeader = document.querySelector(".to-be-sticky");
    if (ulHeader) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 80) {
                ulHeader.classList.add("sticky");
            } else {
                ulHeader.classList.remove("sticky");
            }
        });
    }

    // wow js - animation on scroll
    new WOW({}).init();


    // Banner slider
    new Swiper(".ul-banner-slider", {
        slidesPerView: 1,
        autoplay: true,
        loop: true,
        speed: 700,
        allowTouchMove: false
    });

    // if (document.querySelector(".ul-banner-slider")) {
    //     const bannerSlider = new Splide('.ul-banner-slider', {
    //         perPage: 1,
    //         pagination: false,
    //         arrows: false,
    //         type: 'loop',
    //         autoplay: true,
    //         interval: 3500
    //     }).mount();
    // }
    // // banner image slider
    // const bannerImgSlider = new Splide('.ul-banner-img-slider', {
    //     perPage: 4,
    //     pagination: false,
    //     arrows: false,
    //     type: 'loop',
    //     autoplay: true,
    //     interval: 3500,
    //     perMove: 4,
    // }).mount();

    // bannerSlider.sync(bannerImgSlider);
    // // main.mount();
    // // thumbnails.mount();


    // Ticker slider
    if (document.querySelector(".ul-ticker-slider")) {
        new Splide('.ul-ticker-slider', {
            type: 'loop',
            // perPage: "auto",
            perPage: 10,
            pagination: false,
            arrows: false,
            type: 'loop',
        }).mount(window.splide.Extensions);
    }

    // Service Slider
    new Swiper('.ul-services-slider', {
        // slidesPerView: 4.8,
        slidesPerView: 3,
        spaceBetween: 27,
        // centeredSlides: true,
        // loop: true,
        autoplay: true,
        navigation: {
            prevEl: ".ul-services-slider-nav .prev",
            nextEl: ".ul-services-slider-nav .next"
        },
        breakpoints: {
            0: { slidesPerView: 1.2, spaceBetween: 15, centeredSlides: true },
            480: { slidesPerView: 1.8, spaceBetween: 15, centeredSlides: true },
            576: { slidesPerView: 2, spaceBetween: 15, },
            768: { slidesPerView: 3, spaceBetween: 15, },
            992: { slidesPerView: 3, spaceBetween: 15, },
            1200: { slidesPerView: 3, spaceBetween: 20, },
            1400: {
                slidesPerView: 3,
                spaceBetween: 27,
            }
        }
    });

    // case study slider
    new Swiper(".ul-case-study-slider", {
        slidesPerView: 3,
        loop: true,
        autoplay: true,
        watchSlidesProgress: true,
        spaceBetween: 27,
        navigation: {
            prevEl: ".ul-case-study-slider-prev",
            nextEl: ".ul-case-study-slider-next"
        },
        breakpoints: {
            0: { slidesPerView: 1, },
            576: { slidesPerView: 1.5, centeredSlides: true },
            768: { slidesPerView: 2, centeredSlides: false },
            992: { slidesPerView: 2.7, centeredSlides: true },
            1200: { slidesPerView: 3, centeredSlides: true },
        }
    })


    // Reviews slider
    new Swiper(".ul-reviews-slider", {
        slidesPerView: 1,
        loop: true,
        autoplay: true,
        navigation: {
            prevEl: ".ul-reviews-slider-nav .prev",
            nextEl: ".ul-reviews-slider-nav .next"
        }
    });


    // Clients SLider
    new Swiper(".ul-clients-slider", {
        slidesPerView: 5,
        spaceBetween: "37",
        loop: true,
        autoplay: true,
        breakpoints: {
            0: {
                slidesPerView: 2,
            },
            480: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 4,
            },
            992: {
                slidesPerView: 5,
            }
        }
    });


    // TESTIMONIAL SLIDER
    new Swiper(".ul-inner-testimonial-slider", {
        slidesPerView: 2,
        spaceBetween: 27,
        loop: true,
        autoplay: true,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            }
        }
    });

    // project details img slider
    new Swiper(".ul-project-details-img-slider", {
        slidesPerView: 1,
        loop: true,
        autoplay: true,
        navigation: {
            prevEl: ".ul-project-details-slider-nav .prev",
            nextEl: ".ul-project-details-slider-nav .next",
        }
    });


    // scroll spy about section
    if (document.querySelector(".ul-about-content-nav")) {
        scrollSpy('.ul-about-content-nav', {
            sectionClass: '.ul-about-content-tab',
            menuActiveTarget: 'a',
            offset: -420,
            // smooth scroll
            smoothScroll: true,
            smoothScrollBehavior: function (element) {
                element.scrollIntoView({ behavior: 'smooth' }) // default behavior
            }
        });

    }

    // index-2 clients slider
    new Swiper(".ul-clients-2-slider", {
        slidesPerView: 5,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 2,
            },
            576: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 4,
            },
            992: {
                slidesPerView: 5,
            }
        }
    });


    // 
    const accordionItems = document.querySelectorAll(".ul-functions-accordion-item");
    const dynamicImage = document.getElementById("ul-functions-dynamic-img");

    if (accordionItems) {
        accordionItems.forEach((item) => {
            item.addEventListener("click", function () {
                // Remove 'open' class from all items
                accordionItems.forEach((el) => el.classList.remove("open"));

                // Add 'open' class to the clicked item
                item.classList.add("open");

                // Change the image based on the active accordion item
                const newImg = item.getAttribute("data-img");
                if (newImg) {
                    dynamicImage.src = newImg;
                }
            });
        });
    }

    // how it works ss slider
    new Swiper(".ul-how-it-works-img-slider", {
        slidesPerView: 3.75,
        spaceBetween: 17,
        loop: true,
        autoplay: true,
        breakpoints: {
            0: {
                slidesPerView: 2
            },
            480: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 2.05,
            },
            992: {
                slidesPerView: 2.65,
            },
            1200: {
                slidesPerView: 3.05,
            },
            1400: {
                slidesPerView: 3.15,
            },
            1600: {
                slidesPerView: 3.75,
            }
        }
    });

    // index-2 Testimonial slider
    new Swiper(".ul-reviews-2-slider", {
        slidesPerView: 3,
        spaceBetween: 30,
        watchSlidesProgress: true,
        loop: true,
        navigation: {
            prevEl: ".ul-reviews-2-slider-nav .prev",
            nextEl: ".ul-reviews-2-slider-nav .next",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 130,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            }
        }
    })

    // index-3 banner customer slider
    new Swiper(".ul-banner-3-cutomers-slider ", {
        slidesPerView: 5,
        loop: true,
        autoplay: true,
        breakpoints: {
            0: {
                slidesPerView: 2
            },
            576: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 4
            },
            992: {
                slidesPerView: 5
            },
            1200: {
                slidesPerView: 4
            },
            1400: {
                slidesPerView: 5
            }
        }
    });
});

