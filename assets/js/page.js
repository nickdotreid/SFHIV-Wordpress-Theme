$(document).ready(function(){
	$('#branding').append('<br class="clear" />');
	
	$(".three-column,.two-column").bind("redraw",function(event){
		var column = $(this);
		var item_selector = ".preview, .widget";
		// reset all heights to auto & restore all borders
		$(item_selector,column).css({
			"height":"auto",
			"border-bottom-width":"1px"
		});
		var heights = [];
		var lowest = 0;
		$(item_selector,column).each(function(){
			var position = $(this).position();
			if(position.top>lowest){
				lowest = position.top;
			}
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
			if(position.top>=lowest){
				$(this).css("border-bottom-width","0px");
			}
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
	
	$(".list-item").bind("redraw",function(){
		var item = $(this);
		if($(".column",item).length<1){
			return true;
		}
		var height = item.height();
		$(".column",item).each(function(){
			var column = $(this);
			if(column.height()>height){
				height = column.height();
			}
		});
		$(".column",item).each(function(){
			var column = $(this);
			if(column.height()<height){
				column.height(height);
			}
		});
		item.height(height);
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
		$("#access ul.menu").trigger("redraw");
	}).resize();
});