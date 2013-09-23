// http://www.thomaslanciaux.pro/jquery/jquery_carousel.htm
// Usage
// Options can be passed to the jquery.carousel method in the form of an associative array:
// direction determines the direction of the carousel (horizontal by default)
// loop, set to true, allows you to define a carousel that loops (false by default)
// dispItems determines the number of items to display per step (default 1)
// pagination, set to true, allows you to display a paginated carousel. (false by default)
// paginationPosition (depends on pagination) determines the page position relative to the main slide container. (inside by default)
// nextBtn sets the html needed to render the 'Next' button. ("Next" span by default)
// prevBtn sets the html needed to render the 'Previous' button. ("Previous" span by default)
// btnsPosition determines the position of buttons relative to the main slide container. (inside by default)
// nextBtnInsert (depends on btnsPosition) determines how the nextBtn element is inserted into the DOM. (appendTo par défaut)
// prevBtnInsert (depends on btnsPosition) determines how the prevBtn element is inserted into the DOM. (prependTo by default)
// autoSlide, set to true, allows you to automatically click the Next button at a given interval. (false by default)
// autoSlideInterval (depends on autoSlide) determines the delay between each click using the autoSlide option (3000 default)
// delayAutoSlide (depends on autoSlide) allows you to set a time delay between two co-existing carousels (0 default)
// combinedClasses, set to true, allows you to emulate multiple classes in IE6 (false by default)
// effect allows you to define animated effects that use jQuery to transition from one item in the carousel to the next (slide by default, effects integrated into jQuery - see the documentation).
// slideEasing (if: effect="slide"), enables the easing effect in the slide animation (swing by default, see the documentation for the plugin easing.js for combinations if necessary)
// animSpeed (if: effect="slide") determines the speed of the animation when using slide. (normal by default)

$(document).ready(function() {
/*////////////////////////////////////////////////////////////////////////////////////////////
// Carousel
///////////////////////////////////////////////////////////////////////////////////////////*/
	$('.carousel_vertical').carousel({
		dispItems: 1,
		nextBtn: false,
		prevBtn: false,
		direction: 'vertical',
		pagination: true
	});
});