$(document).ready(function(){
	$('.slider').addClass("carousel").addClass("slide").wrapInner("carousel-inner");
	$('.slider').carousel({
		interval:5000
	});
});