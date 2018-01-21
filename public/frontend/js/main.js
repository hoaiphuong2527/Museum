// JavaScript Document
// Resize height equal
function carouselNormalization() {
    var items = $('.swiper-slide .height-equal'), //grab all slides
        heights = [], //create empty array to store height values
        tallest; //create variable to make note of the tallest slide

    if (items.length) {
        function normalizeHeights() {
            items.each(function () { //add heights to array
                heights.push($(this).height());
            });
            tallest = Math.max.apply(null, heights); //cache largest value
            items.each(function () {
                $(this).css('min-height', tallest + 'px');
            });
        };
        normalizeHeights();

        $(window).on('resize orientationchange', function () {
            tallest = 0, heights.length = 0; //reset vars
            items.each(function () {
                $(this).css('min-height', '0'); //reset min-height
            });
            normalizeHeights(); //run it again
        });
    }
}

window.onload = function () {
    carouselNormalization();
};
// End Resize height equal

/// ======= Slideshow Floor
jQuery(document).ready(function() {
    var swiper = new Swiper('.swiper-container', {
	    pagination: '.swiper-pagination',
	    paginationClickable: true,
		nextButton: '.swiper-button-next',
	    prevButton: '.swiper-button-prev',
	    spaceBetween: 30,
	    slidesPerView: 1,
	});
});

$(document).ready(function() {
    $('.search').affix({
        offset: {
			top: $('.topmenu-left').height()
		}
	});	
});