<?php

add_action('get_sidebar','sfhiv_get_contact_user',105);
function sfhiv_get_contact_user(){
	if(is_archive() || is_search()) return;
	$users = get_users( array(
	  'connected_type' => 'contact_user',
	  'connected_items' => get_the_ID(),
	));
	$show_phone = true;
	$show_email = true;
	foreach($users as $user):
		include(locate_template('contact-member.php'));
	endforeach;
}

?>