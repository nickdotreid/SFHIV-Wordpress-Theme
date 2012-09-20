$(document).ready(function(){
	var slider_id = "slider";
	$('.slider').attr("id",slider_id).addClass("carousel").addClass("slide").wrapInner('<div class="carousel-inner">')
		.append('<a class="carousel-control left" href="#'+slider_id+'" data-slide="prev">&lsaquo;</a>')
		.append('<a class="carousel-control right" href="#'+slider_id+'" data-slide="next">&rsaquo;</a>');
	$(".carousel .item:first").addClass("active");
	$('.slider').bind("slide",function(event){
		$('.item.active',$(this)).fadeOut('slow');
	}).bind("slid",function(event){
		$('.item.active',$(this)).fadeIn('slow');
	});
	$('.slider').carousel({
		interval:5000
	});
});