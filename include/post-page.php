<?php

add_action('get_sidebar','sfhiv_post_sidebar',27);
function sfhiv_post_sidebar(){
	if(!is_singular("post")) return;
	dynamic_sidebar("Blog Sidebar");
}

add_action('before_content','sfhiv_post_meta',7);
function sfhiv_post_meta(){
	if(!is_singular("post")) return;
	$user = get_user_by('login', get_the_author_meta('user_login'));
	if(!$user) return;
	echo '<div class="post-meta">';
	echo 'Posted by ';
	echo get_the_author_meta("first_name",$user->ID).' '.get_the_author_meta("last_name",$user->ID);
	echo ' on ';
	echo get_the_date();
	echo '</div>';
}

?>