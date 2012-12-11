<aside class="location">
	<h3><?=the_title();?></h3>
	<span class="address line"><?=get_post_meta(get_the_ID(),'sfhiv_address',true);?></span>
	<span class="address line"><?=get_post_meta(get_the_ID(),'sfhiv_room',true);?></span>
	<?	$city = get_post_meta(get_the_ID(),'sfhiv_city',true);?>
	<?	if($city != 'San Francisco'):	?>
	<span class="address line"><?=get_post_meta(get_the_ID(),'sfhiv_city',true);?>, <?=get_post_meta(get_the_ID(),'sfhiv_state',true);?> <?=get_post_meta(get_the_ID(),'sfhiv_zip_code',true);?></span>
	<?	endif;	?>
	<!-- View on Google Maps Link here -->
	<span class="address line hint"><?apply_filters('the_content',get_post_meta(get_the_ID(),'sfhiv_location_hint',true));?></span>
</aside>