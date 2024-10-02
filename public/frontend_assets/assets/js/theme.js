// JavaScript Document
//Banner Carousel
/* var bs = $('#banner-carousel');
bs.owlCarousel({
    autoplay: true,
    //autoplayTimeout:1000,
    //autoplaySpeed:700,
    loop: true,
    nav: true,
    dots: true,
    //animateOut: 'fadeOut',
    items: 1,
    navText: ['<i class="fa fa-chevron--left"></i>', '<i class="fa fa-chevron--right"></i>'],
}); */

//Destination Carousel
var ds = $('.destination-carousel');
ds.owlCarousel({
    autoplay: false,
    //autoplayTimeout:1000,
    //autoplaySpeed:700,
    loop: true,
    nav: true,
    dots: false,
    //animateOut: 'fadeOut',
    items: 1,
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
});