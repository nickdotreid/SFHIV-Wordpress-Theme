$(document).ready(function(){
	$('#branding').append('<br class="clear" />');
	
	$(".three-column,.two-column").bind("redraw",function(event){
		var column = $(this);
		var item_selector = ".preview, .widget";
		// reset all heights to auto & restore all borders
		$(item_selector,column).css({
			"height":"auto",
		});
		var heights = [];
		$(item_selector,column).each(function(){
			var position = $(this).position();
			var found = false;
			for(var i=0;i<heights.length;i++){
				if(heights[i]['top']==position.top){
					found = true;
					if($(this).height()>heights[i]['height']){
						heights[i]['height']=$(this).height();
					}
				}
			}
			if(!found){
				heights.push({
					"top":position.top,
					"height":$(this).height()
				});
			}
		});
		$(item_selector,column).each(function(){
			var position = $(this).position();
			for(var i=0;i<heights.length;i++){
				if(heights[i]['top']==position.top){
					$(this).height(heights[i]['height']);
				}
			}
		});
	});
	
	$("#section-top").bind("redraw",function(){
		var section = $(this);
		section.show();
		var new_width = $("#branding").width()-$("#site-title").width();
		if(new_width<150){
			section.css({
				'width':'auto',
				'height':'auto',
				'left':'0px',
				'top':'0px'
			});
			return true;
		}
		section.width(new_width);
		section.css("left",$("#site-title").width()+'px');
		section.css("top",($("#site-title").height()-section.height())+'px');
	});
	
	$("#access ul.menu").bind("redraw",function(){
		var menu = $(this);
		var free_space = menu.width();
		var menu_items = $(".menu-item:not(.sub-menu .menu-item)",menu);
		menu_items.each(function(){
			var item = $(this);
			free_space -= item.width();
		});
		free_space = free_space/menu_items.length;
		menu_items.css("margin-right",free_space+'px');
		$(".menu-item:not(.sub-menu .menu-item):last",menu).css("margin-right",'0px');
	});
	
	$(window).resize(function(){
		$("#section-top").trigger("redraw");
		$(".three-column,.two-column").trigger("redraw");
		$(".list-item").trigger("redraw");
	//	$("#access ul.menu").trigger("redraw");
	}).resize();
});