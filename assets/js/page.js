$(document).ready(function(){
	$('#branding').append('<br class="clear" />');
	
	$(window).resize(function(){
		// reset all heights to auto & restore all borders
		$("#splash .preview").css({
			"height":"auto",
			"border-right-width":"1px",
			"border-bottom-width":"1px"
		});
		var left = 0;
		var top = 0;
		var heights = [];
		$("#splash .preview").each(function(){
			var position = $(this).offset();
			if(position.left>left){
				left = position.left;
			}
			if(position.top>top){
				top = position.top;
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
			var position = $(this).offset();
			if(left==position.left){
				$(this).css("border-right-width","0px");
			}
			if(top==position.top){
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