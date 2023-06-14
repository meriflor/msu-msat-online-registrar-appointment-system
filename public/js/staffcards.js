$(document).ready(function () {
    $(".card-carousel").owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: true,
        margin: 20,
        responsive: {
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
    });
});
