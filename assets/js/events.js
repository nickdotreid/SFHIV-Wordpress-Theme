$(document).ready(function(){
	$(".events.filters").delegate(".filter","click",function(event){
		event.preventDefault();
		$(".filter",$(this).parents(".events.filters:first")).removeClass("selected");
		$(this).addClass("selected");
		$(".mini_archive.event").trigger("filter");
	});
	$(".mini_archive.event").bind("filter",function(event){
		var archive = $(this);
		var filters = {};
		$(".events.filters .filter.selected").each(function(){
			var filter = $(this);
			filters[filter.attr("type")] = filter.attr("value");
		});
		var now = new Date();
		$(".event",archive).show().each(function(){
			var item = $(this);
			if(filters['time'] == 'upcoming'){
				if(new Date(Number(item.attr("start")))<now){
					item.hide();
				}
			}
			if(filters['time'] == 'past'){
				if(new Date(Number(item.attr("end")))>now){
					item.hide();
				}
			}
			if(filters['group']!='all'){
				if(item.attr("groups").search(filters['group'])==-1){
					item.hide();
				}
			}
		});
		if($(".event:visible",archive).length<1){
			$(".events.alert.none").show();
		}else{
			$(".events.alert.none").hide();
		}
	});
	
	$(".events.filters").each(function(){
		$(".filter:first",$(this)).click();
		$(".filter.default",$(this)).click();
	});
	
	$(window).resize(function(){

	});
});