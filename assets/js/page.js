$(document).ready(function(){
	
	$(".filters.collapsable").bind("open",function(){
		var menu = $(this);
		$(this).addClass("collapse-open");
		$(".item,.cat-item",menu).slideDown();
	}).bind("close",function(){
		var menu = $(this);
		$(this).removeClass("collapse-open");
		$(".item,.cat-item:not(.current-cat)",menu).slideUp();
	}).mouseenter(function(){
		var list = $(this).parents(".list:first");
		if(list.data("timeout")){
			clearTimeout(list.data("timeout"));
		}
		list.data("timeout",setTimeout(function(){
			$(".collapsable",list).trigger("open");
		},500));
	}).mouseleave(function(){
		var list = $(this).parents(".list:first");
		if(list.data("timeout")){
			clearTimeout(list.data("timeout"));
		}
		$(".collapsable",list).trigger("close");
	}).trigger("close");
	
	$("#members,.three-column,.two-column").bind("redraw",function(){
		var item_selector = ".preview, .widget, .member";

		$(item_selector,$(this)).css({
			"height":"auto"
		});
		var _top = 0;
		var _height = 0;
		var _in_row = [];
		$(item_selector,$(this)).each(function(){
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
		$(this).height(member.outerHeight()+member.position().top);
	});
	
	$(".menu-justified").bind("redraw",function(){
		var menu = $(this);
		var free_space = menu.width();
		var menu_items = $(".menu-item:not(.sub-menu .menu-item)",menu);
		if(!menu_items.css("float") || menu_items.css("float") == "" || menu_items.css("float") == "none"){
			menu_items.css("margin-right","0px");
			return;
		}
		menu_items.each(function(){
			if(!$(this).data("orig-padding")){
				$(this).data("orig-padding",Number($(this).css("padding-right").replace("px","")));
			}
			free_space = free_space - $(this).outerWidth();
		});
		var num_items = menu_items.length-1;
		if(num_items<1){
			return;
		}
		free_space = Math.floor(free_space/num_items);
		menu_items.each(function(){
			m_space = free_space;
			p_space = $(this).data("orig-padding");
			if(Number($(this).css("padding-right").replace("px","")) != p_space){
				p_space = Number($(this).css("padding-right").replace("px",""));
			}
			if(free_space<0){
				m_space = 0;
				p_space = Math.floor($(this).data("orig-padding") + free_space/2);
			}
			$(this).css({
				"margin-right":m_space+'px',
				'padding-left':p_space+'px',
				'padding-right':p_space+'px'
			});
		});
		$(".menu-item:not(.sub-menu .menu-item):last",menu).css("margin-right",'0px');
	});
	
	$(".sticky").each(function(){
		$(this).data("top",$(this).offset().top);
	});
	$(window).scroll(function(event){
		$(".sticky").each(function(){
			var sticky = $(this)
			if($(window).scrollTop() > sticky.data("top")){
				sticky.addClass("fixed");
			}else{
				sticky.removeClass("fixed");
			}
		});
	});
	
	$(window).resize(function(){
		$(".three-column,.two-column,#members").trigger("redraw");
		$(".list-item").trigger("redraw");
		$(".menu-justified").trigger("redraw");
	}).resize();
	setTimeout('$(window).resize()',500);
});