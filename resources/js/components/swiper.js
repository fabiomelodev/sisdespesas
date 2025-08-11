import Swiper from "swiper";
import { Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";

new Swiper(".js-swiper-report-general-banks", {
    slidesPerView: 4.5,
    spaceBetween: 30,

    breakpoints: {
        320: {
            slidesPerView: 1.2,
        },
        640: {
            slidesPerView: 2.5,
        },
        768: {
            slidesPerView: 3.5,
        },
        1024: {
            slidesPerView: 4.5,
        },
    },
});
