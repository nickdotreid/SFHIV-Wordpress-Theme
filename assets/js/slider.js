$(document).ready(function(){
	$('.carousel').each(function(){
		var slider = $(this);
		$(".item:first",slider).addClass("active");
		slider.carousel({
			interval:5000
		});
	});
});