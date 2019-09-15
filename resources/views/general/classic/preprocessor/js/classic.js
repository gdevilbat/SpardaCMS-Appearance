$ = window.$;
jQuery = window.jQuery;

jQuery.fn.exists = function(){return this.length>0;}

//jQuery to collapse the navbar on scroll
/*$(window).scroll(function() {
	affix();
});*/

$(window).resize(function(event) {
    //affix();
});

$(".navbar").ready(function() {
	//affix();
});

function affix() {
	navbar_height = $(".navbar-spy").height();
    $(".nav-space").css('min-height', navbar_height+30+'px');
    /*if ($(document).scrollTop() > (navbar_height+100)) {
        $(".nav-space").removeClass("d-none");
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".nav-space").addClass("d-none");
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }*/
}

$('.scroll_to').click(function(e){
    var jump = $(this).attr('href');
    var new_position = $(jump).offset();
    var navbar_height = $("nav").height();
    $('html, body').stop().animate({ scrollTop: (new_position.top - navbar_height - 105) }, 500);
    e.preventDefault();
});

/*=======================================
=            Lazy Load Image            =
=======================================*/

    document.addEventListener("DOMContentLoaded", function() {
        var lazyloadImages;    

        if ("IntersectionObserver" in window) {
            lazyloadImages = document.querySelectorAll(".lazy");
            var imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        image.src = image.dataset.src;
                        image.classList.remove("lazy");
                        imageObserver.unobserve(image);
                    }
                });
            });

            lazyloadImages.forEach(function(image) {
                imageObserver.observe(image);
            });
        } else {  
            var lazyloadThrottleTimeout;
            lazyloadImages = document.querySelectorAll(".lazy");

            function lazyload () {
                if(lazyloadThrottleTimeout) {
                    clearTimeout(lazyloadThrottleTimeout);
                }    

                lazyloadThrottleTimeout = setTimeout(function() {
                    var scrollTop = window.pageYOffset;
                    lazyloadImages.forEach(function(img) {
                        if(img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                        }
                    });
                    if(lazyloadImages.length == 0) { 
                        document.removeEventListener("scroll", lazyload);
                        window.removeEventListener("resize", lazyload);
                        window.removeEventListener("orientationChange", lazyload);
                    }
                }, 20);
            }

            document.addEventListener("scroll", lazyload);
            window.addEventListener("resize", lazyload);
            window.addEventListener("orientationChange", lazyload);
        }
    })
    $('.lazy-bg').lazy();

/*=====  End of Lazy Load Image  ======*/