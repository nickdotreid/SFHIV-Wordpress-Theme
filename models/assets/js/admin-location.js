jQuery(document).ready(function($){
	jQuery(".sfhiv_location.new.button").click(function(event){
		event.preventDefault();
		var button = jQuery(this);
		jQuery.post(ajaxurl, {
			'action':'sfhiv_location_form'
		}, function(response) {
				button.hide();
				jQuery('.sfhiv_location.list',button.parent()).hide();
				button.after(response);
			});
	});
	$('form').delegate("form.sfhiv_location .close",'click',function(event){
		event.preventDefault();
		$('.sfhiv_location').show();
		$(this).parents("form:first").remove();
	}).delegate(".sfhiv_location.create .submit.button",'click',function(event){
		event.preventDefault();
		var form = $(this).parents("form:first");
		$.post(ajaxurl,
			form.serialize(),
			function(response){
				$('.sfhiv_location').show();
				$('.sfhiv_location.list',form.parent()).append(response);
				form.remove();
		});
		form.hide();
	});
});