<?php

add_action('get_footer','sfhiv_get_contact_user',10);
function sfhiv_get_contact_user(){
	if(in_array(get_post_type(),array('event','group','page','post'))):
	$users = get_users( array(
	  'connected_type' => 'contact_user',
	  'connected_items' => get_the_ID(),
	));
	?>
	<aside id="contact_user">
	<?
	foreach($users as $user):
		include(locate_template('list-member.php'));
	endforeach;
	?>
	</aside>
	<?
	endif;
}

?>