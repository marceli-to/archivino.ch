'use strict';

(function (){
    $('.testimonial-carousel').owlCarousel({
        loop: true,
        items: 1,
        autoplay: true,
        autoplayHoverPause: true,
        smartSpeed: 600,
        autoplayTimeout: 7000
    });
    var productCarousel = $('.product-carousel').owlCarousel({
        loop: false,
        items: 1,
        nav: true,
        navText: ['<span class="prev-icon nav-icon"></span>','<span class="next-icon nav-icon"></span>']
    });



    lightbox.option({
        albumLabel: "Bild %1 von %2"
    });

    $('body').on('onChangeItem', () => {
        console.log(productCarousel);
        if(productCarousel){
            productCarousel.trigger('to.owl.carousel',[lightbox.currentImageIndex,250])
        }
    });

    // Popup
    $('.popup-trigger').click(function (){
        $(this).parent().children('.popup-wrapper').css({
            visibility: 'visible',
            opacity: 1,
        })
    });

    $('.popup-wrapper, .popup-close').click(function (){
        $('.popup-wrapper').css({
            visibility: 'hidden',
            opacity: 0,
        })
    });

    $('.popup').click(function (e){
        e.stopPropagation();
    });
})();

document.addEventListener('snipcart.ready', () => {
    $('body').addClass('snipcart-ready');
    Snipcart.store.subscribe(() => {
        if (Snipcart.store.getState().cart.items.count){
            $('.nav-link-cart').addClass('has-products');
        }else{
            $('.nav-link-cart').removeClass('has-products');
        }
    });
});



let lastKnownScrollPosition = 0;
let ticking = false;

let offset = 200;

const navigation = document.querySelector('.main-header');

// element animation
activateElementsInViewport();
document.addEventListener('scroll', () => {
    lastKnownScrollPosition = window.scrollY;

    if(!ticking) {
        window.requestAnimationFrame(() => {
            activateElementsInViewport()
            changeNavbarClass(lastKnownScrollPosition);
            ticking = false;
        });
        ticking = true;
    }
});

function activateElementsInViewport(){
    $('.animate-elements > *').each(function(index, e){
        const top_of_element = $(e).offset().top;
        const bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();

        if ((bottom_of_screen - offset > top_of_element)){
            // the element is visible, do something
            $(e).removeClass('hidden');
            $(e).addClass('visible');
        }
    })
}


// srolling

function changeNavbarClass(scrollPosition){
    if(scrollPosition > 0) {
        // add Class
        navigation.classList.add('scrolled');
    } else {
        navigation.classList.remove('scrolled');
    }
}
