(function($) {
    "use strict";

    // Preloader
    $(window).on('load', function() {
        $("#loading").fadeOut(1200);
    });

    // Sticky Nav1
    $(document).on("scroll", function() {
        if ($(document).scrollTop() > 150) {
            $(".main-nav").addClass("black");
        } else {
            $(".main-nav").removeClass("black");
        }
    });

    // Sticky Nav2
    $(document).on("scroll", function() {
        if ($(document).scrollTop() > 0) {
            $(".mobile-nav").addClass("black");
        } else {
            $(".mobile-nav").removeClass("black");
        }
    });

    // Scroll Top
    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 0) {
            $('.scroll-top').fadeIn();
        } else {
            $('.scroll-top').fadeOut();
        }
    });
    $('.scroll-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    // Mean Menu
    jQuery('.mean-menu').meanmenu({
        meanScreenWidth: "991"
    });

    // Wow  JS
    new WOW({
        offset: 100,
        mobile: true
    }).init();

    // Magnific PopUp
    $(".video-pop").magnificPopup({
        disableOn: 320,
        type: 'iframe',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // Owl Carausel 
    $('.home-course-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        autoplay: true,
        nav: true,
        navText: ["<i class='flaticon-left-arrow'></i>", "<i class='flaticon-next'></i>"],
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            768: {
                items: 2,
            },
            1000: {
                items: 3,
            },
            1300: {
                items: 4,
            }
        }
    });

    $('.course-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        autoplay: false,
        nav: true,
        navText: ["<i class='flaticon-left-arrow'></i>", "<i class='flaticon-next'></i>"],
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            }
        }
    });

    $(".home-slider").owlCarousel({
        animateOut: 'animate__animated animate__slideOutDown',
        animateIn: 'animate__animated animate__slideInDown',
        items: 1,
        loop: true,
        autoplay: false,
        dots: false,
        nav: true,
        navText: ["<i class='flaticon-left-arrow'></i>", "<i class='flaticon-next'></i>"],
        autoHeight: true,
        autoplaySpeed: 800,
        mouseDrag: false,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            }
        }

    });

    $('.event-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        autoplay: false,
        dots: false,
        autoplayHoverPause: true,
        mouseDrag: false,
        navText: ["<i class='flaticon-left-arrow'></i>", "<i class='flaticon-next'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            }
        }
    });
    $('.news-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        autoplay: false,
        dots: false,
        autoplayHoverPause: true,
        mouseDrag: false,
        navText: ["<i class='flaticon-left-arrow'></i>", "<i class='flaticon-next'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            }
        }
    });

    $('.teacher-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        autoplay: false,
        dots: false,
        autoplayHoverPause: true,
        mouseDrag: false,
        navText: ["<i class='flaticon-left-arrow'></i>", "<i class='flaticon-next'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            }
        }
    });

    // Gallery
    $('.image-pop').magnificPopup({
        type: 'image',
        removalDelay: 300,
        gallery: {
            enabled: true
        },
    });

    // FAQ Accordion
    $('.accordion').find('.accordion-title').on('click', function() {
        $(this).toggleClass('active');
        $(this).next().slideToggle('fast');
        $('.accordion-content').not($(this).next()).slideUp('fast');
        $('.accordion-title').not($(this)).removeClass('active');
    });

    // Set the target date for registration end
const targetDate = new Date("2024-12-31T23:59:59");

// Function to update countdown
function updateCountdown() {
    const now = new Date();
    const timeDifference = targetDate - now;

    if (timeDifference <= 0) {
        document.getElementById("days").textContent = "0";
        document.getElementById("hours").textContent = "0";
        document.getElementById("minutes").textContent = "0";
        document.getElementById("seconds").textContent = "0";
        return;
    }

    // Calculate time components
    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    // Update HTML elements
    document.getElementById("days").textContent = days;
    document.getElementById("hours").textContent = hours;
    document.getElementById("minutes").textContent = minutes;
    document.getElementById("seconds").textContent = seconds;
}

// Update the countdown every second
setInterval(updateCountdown, 1000);


    // Switch Btn
	$('body').append("<div class='switch-box'><label id='switch' class='switch'><input type='checkbox' onchange='toggleTheme()' id='slider'><span class='slider round'></span></label></div>");

}(jQuery));

