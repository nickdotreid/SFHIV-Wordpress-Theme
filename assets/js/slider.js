$(document).ready(function(){
	$('#featured').jcarousel({
		'scroll': 1,
		'wrap':'circular',
		'auto':3,
		initCallback: sfhiv_carousel_initCallback,
		itemVisibleInCallback: sfhiv_carousel_visible,
		itemVisibleOutCallback: {
			onBeforeAnimation:sfhiv_carousel_hide
		}
	});
});

function sfhiv_carousel_hide(options,item,index,state){
	item = $(item);
	$(".slider-item",item).animate({
		'margin-top':item.height()+'px'
	},{
		'duration':500
	});
}

function sfhiv_carousel_visible(options,item,index,state){
	item = $(item);
	val = $(item).height() - $(".slider-item",item).outerHeight();
	$(".slider-item",item).css('margin-top',item.height()+'px');
	$(".slider-item",item).animate({
		'margin-top':val+'px'
	},{
		'duration':500
	});
}

function sfhiv_carousel_initCallback(carousel){
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};