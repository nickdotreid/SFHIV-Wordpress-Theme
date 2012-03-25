$(document).ready(function(){
	$('#branding').append('<br class="clear" />');
	
	$(window).resize(function(){
		// reset all heights to auto & restore all borders
		$("#splash .preview").css({
			"height":"auto",
			"border-bottom-width":"1px"
		});
		var heights = [];
		var lowest = 0;
		$("#splash .preview").each(function(){
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
		$("#splash .preview").each(function(){
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
	}).resize();
});