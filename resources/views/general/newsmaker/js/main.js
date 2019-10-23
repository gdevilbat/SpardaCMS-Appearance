function sidebar() {
    var sideBar = document.getElementById("sidebar");
    sideBar.classList.toggle("sidebar-none");
}

$('.slider').slick({
    dots: true,
    nextArrow: '.slider-arrow-right',
    prevArrow: '.slider-arrow-left'
});

$('.image-slider').slick({
    centerMode: true,
    slidesToShow: 3,
    nextArrow: '.slider-arrow-right-round',
    prevArrow: '.slider-arrow-left-round',
    responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1
          }
        },
    ]
});

function myFunction() {
    var element = document.getElementById("body");
    element.classList.toggle("dark");
}
