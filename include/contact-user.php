<?php

add_action('get_sidebar','sfhiv_get_contact_user',105);
function sfhiv_get_contact_user(){
	if(in_array(get_post_type(),array('event','group','page','post'))):
	$users = get_users( array(
	  'connected_type' => 'contact_user',
	  'connected_items' => get_the_ID(),
	));
	foreach($users as $user):
		include(locate_template('contact-member.php'));
	endforeach;
	endif;
}

?>