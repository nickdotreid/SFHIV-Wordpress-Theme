$(document).ready(function(){
	$('.slider').addClass("carousel").addClass("slide").wrapInner('<div class="carousel-inner">')
		.append('<a class="carousel-control left" href="#" data-slide="prev">&lsaquo;</a>')
		.append('<a class="carousel-control right" href="#" data-slide="next">&rsaquo;</a>');
	$('.slider').carousel({
		interval:5000
	});
	$(".slider").bind("slid",function(event){
		$(".item.active",$(this)).fadeIn();
	});
});