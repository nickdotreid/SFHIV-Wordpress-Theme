<?php

add_action('get_sidebar','sfhiv_add_document_navigation',22);
function sfhiv_add_document_navigation(){
	if(is_singular('sfhiv_document')){
		sfhiv_draw_page_navigation(array(get_the_ID()));
	}
}

add_action('get_sidebar','sfhiv_document_studies_sidebar',23);
function sfhiv_document_studies_sidebar(){
	if(!is_singular('sfhiv_document')) return;
	$studies = sfhiv_document_get_studies();
	if($studies->post_count < 1) return;
	sfhiv_draw_menu($studies->posts,array(
		'show_parents' => true,
	));
}

add_action('before_content','sfhiv_document_show_date');
add_action('short_before_content','sfhiv_document_show_date');
add_action('before_list-item','sfhiv_document_show_date');
function sfhiv_document_show_date(){
	if(get_post_type() != 'sfhiv_document') return;
	$pub_date = sfhiv_document_get_pub_date();
	if(!$pub_date) return;
	echo '<span class="date date-calendar">';
	echo '<span class="month">'.date("F",$pub_date).'</span>';
	echo '<span class="year">'.date("Y",$pub_date).'</span>';
	echo '</span>';
}

add_action('after_list-item','sfhiv_document_clear_date');
function sfhiv_document_clear_date(){
	if(get_post_type() != 'sfhiv_document') return;
	echo '<br class="clear" />';
}
?>