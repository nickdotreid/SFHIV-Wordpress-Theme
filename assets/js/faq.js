$(document).ready(function(){
	$(".short.sfhiv_faq").bind("open",function(event){
		var faq = $(this);
		$("a.open",faq).hide();
		$("a.close",faq).show();
		$('.entry-content',faq).slideDown();
	}).bind("close",function(event){
		var faq = $(this);
		$("a.open",faq).show();
		$("a.close",faq).hide();
		$('.entry-content',faq).slideUp();
	}).trigger("close");
	
	$(".short.sfhiv_faq").delegate(".entry-title, a.open",'click',function(event){
		event.preventDefault();
		$(this).parents(".sfhiv_faq:first").trigger("open");		
	}).delegate("a.close",'click',function(event){
		event.preventDefault();
		$(this).parents(".sfhiv_faq:first").trigger("close");
	});
});