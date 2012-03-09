$(document).ready(function(){
	$(".groups.filters").delegate(".filter,a","click",function(event){
		event.preventDefault();
		var slug = $(this).attr("slug");
		$(".list article").show().each(function(){
			article = $(this);
			if(slug && article.attr("groups") && article.attr("groups").search(slug)==-1){
				article.hide();
			}
		});
	});
});