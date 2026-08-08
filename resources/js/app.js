import './bootstrap';
import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

window.Alpine = Alpine;
Alpine.start();

// Initialize Swiper carousels when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Services Carousel
    const servicesSwiper = new Swiper('.pesaro-services-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.pesaro-services-next',
            prevEl: '.pesaro-services-prev',
        },
        pagination: {
            el: '.pesaro-services-pagination',
            clickable: true,
        },
        breakpoints: {
            480: {
                slidesPerView: 1.5,
            },
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2.5,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // News Carousel
    const newsSwiper = new Swiper('.pesaro-news-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.pesaro-news-next',
            prevEl: '.pesaro-news-prev',
        },
        pagination: {
            el: '.pesaro-news-pagination',
            clickable: true,
        },
        breakpoints: {
            480: {
                slidesPerView: 1.5,
            },
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2.5,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Service Index Page Carousels (one per service card)
    const serviceCarousels = document.querySelectorAll('.pesaro-service-carousel');
    serviceCarousels.forEach((carousel) => {
        new Swiper(carousel, {
            modules: [Autoplay],
            slidesPerView: 1,
            spaceBetween: 16,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 1.8,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 2.2,
                    spaceBetween: 30,
                },
            },
        });
    });

    // Service List Block Carousels (on services page - one carousel per service)
    const serviceListCarousels = document.querySelectorAll('.pesaro-service-list-carousel');
    serviceListCarousels.forEach((carousel) => {
        new Swiper(carousel, {
            modules: [Autoplay],
            slidesPerView: 1,
            spaceBetween: 24,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.3,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 1.5,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 2.5,
                    spaceBetween: 24,
                },
            },
        });
    });
});
