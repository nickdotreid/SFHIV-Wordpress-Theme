$(document).ready(function(){
	$(".list-item.sfhiv_faq").bind("open",function(event){
		var faq = $(this);
		$("a.open").hide();
		$("a.close").show();
		$('.entry-content',faq).show();
	}).bind("close",function(event){
		var faq = $(this);
		$("a.open").show();
		$("a.close").hide();
		$('.entry-content',faq).hide();
	}).trigger("close");
	
	$(".list-item.sfhiv_faq").delegate("h1, h1 a, a.open",'click',function(event){
		event.preventDefault();
		$(this).parents(".sfhiv_faq:first").trigger("open");		
	}).delegate("a.close",'click',function(event){
		event.preventDefault();
		$(this).parents(".sfhiv_faq:first").trigger("close");
	});
});