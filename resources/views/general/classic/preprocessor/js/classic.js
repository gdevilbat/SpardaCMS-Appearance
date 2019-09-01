$ = window.$;
jQuery = window.jQuery;

jQuery.fn.exists = function(){return this.length>0;}

//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
	affix();
});

$(document).ready(function() {
	affix();
});

function affix() {
	navbar_height = $(".navbar-spy").height();
    $(".nav-space").css('min-height', navbar_height+30+'px');
    if ($(document).scrollTop() > (navbar_height+100)) {
        $(".nav-space").removeClass("d-none");
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".nav-space").addClass("d-none");
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
}

$('.scroll_to').click(function(e){
    var jump = $(this).attr('href');
    var new_position = $(jump).offset();
    var navbar_height = $("nav").height();
    window.console.log(navbar_height);
    $('html, body').stop().animate({ scrollTop: (new_position.top - navbar_height - 105) }, 500);
    e.preventDefault();
});