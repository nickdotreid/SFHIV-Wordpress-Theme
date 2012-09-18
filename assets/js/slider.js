$(document).ready(function(){
	var slider_id = "slider";
	$('.slider').attr("id",slider_id).addClass("carousel").addClass("slide").wrapInner('<div class="carousel-inner">')
		.append('<a class="carousel-control left" href="#'+slider_id+'" data-slide="prev">&lsaquo;</a>')
		.append('<a class="carousel-control right" href="#'+slider_id+'" data-slide="next">&rsaquo;</a>');
	$('.slider').carousel({
		interval:5000
	});
	$(".slider").bind("slid",function(event){
		$(".item.active",$(this)).fadeIn();
	});
});