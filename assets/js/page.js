$(document).ready(function(){
	$(".three-column,.two-column").bind("redraw",function(event){
		var column = $(this);
		var item_selector = ".preview, .widget";
		// reset all heights to auto & restore all borders
		$(item_selector,column).css({
			"height":"auto"
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
	
	$("#members").bind("redraw",function(){
		var _top = 0;
		var _height = 0;
		var _in_row = [];
		$(".member",$(this)).each(function(){
			member = $(this);
			if(member.offset().top != _top){
				_top = member.offset().top;
				_height = member.height();
				_in_row = [];
			}
			if(member.height() > _height){
				_height = member.height();
				for(index in _in_row){
					_in_row[index].height(_height);
				}
			}
			_in_row.push(member);
			member.height(_height);
		});
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
		$(".three-column,.two-column,#members").trigger("redraw");
		$(".list-item").trigger("redraw");
	}).resize();
});