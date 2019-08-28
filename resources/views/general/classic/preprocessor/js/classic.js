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
    if ($(document).scrollTop() > (navbar_height+20)) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
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