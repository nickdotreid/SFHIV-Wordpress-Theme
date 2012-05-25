$(document).ready(function(){
	$(".years.filters").delegate(".filter,a","click",function(event){
		event.preventDefault();
		var year_slug = get_last_url_argument($(this).attr("href"));
		$(".list article").show().each(function(){
			article = $(this);
			if(year_slug && article.attr("years") && article.attr("years").search(year_slug)==-1){
				article.hide();
			}
		});
	});
});

function get_last_url_argument(uri){
	pieces = uri.replace('http://',"").replace("www.","").split("/");
	if(pieces.length<1){
		return false;
	}
	pieces = pieces.reverse();
	for(var index in pieces){
		piece = pieces[index];
		if(piece == '#'){
			return false;
		}else if(piece != ""){
			return piece;
		}
	}
	return false;
}