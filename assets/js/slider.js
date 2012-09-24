
var sfhiv_slider_count = 0;
function get_slider_id(){
	sfhiv_slider_count++;
	return 'sfhiv-slider-'+sfhiv_slider_count;
}

$(document).ready(function(){
	$('.slider').each(function(){
		var slider = $(this);
		var slider_id = get_slider_id();
		slider.attr("id",slider_id)
			.addClass("carousel")
			.addClass("slide")
			.wrapInner('<div class="carousel-to-remove">')
			.append('<div class="carousel-inner"></div>')
			.append('<a class="carousel-control left" href="#'+slider_id+'" data-slide="prev">&lsaquo;</a>')
			.append('<a class="carousel-control right" href="#'+slider_id+'" data-slide="next">&rsaquo;</a>');
		$('.carousel-to-remove li:not(li li)').each(function(){
			var item = $(this);
			item.wrapInner('<div class="item">');
			$(".item:first",item).appendTo($(".carousel-inner",slider));
		});
		$('.carousel-to-remove',slider).remove();
		$(".item:first",slider).addClass("active");
		slider.bind("slide",function(event){
			$('.item.active',$(this)).fadeOut('slow');
		}).bind("slid",function(event){
			$('.item.active',$(this)).fadeIn('slow');
		});
		slider.carousel({
			interval:5000
		});
	});
});