<?php

add_action('get_sidebar','sfhiv_page_show_website_link',12);
function sfhiv_page_show_website_link(){
	if(!is_singular()) return;
	$link = sfhiv_website_link_get_link();
	if(!$link) return;
	?>
	<nav>
		<ul class="menu">
			<li class="menu-item">
				<a class="external" href="<?=$link->link;?>"><?
				if($link->name) echo $link->name;
				else echo $link->link;
				?></a>
			</li>
		</ul>
	</nav>
	<?
}

add_action('after_content','sfhiv_page_list_attachments',5);
function sfhiv_page_list_attachments(){
	if(!is_singular()) return;
	$attachments = new WP_Query(array(
		'post_status' => 'any',
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'nopaging' => true,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_mime_type' => 'application'
		) );
	do_action('sfhiv_loop',$attachments,array(
		"id" => "attachments",
		"classes" => array("list","attachments"),
		"list_element" => "short",
		"show_filters" => false,
	));
}

add_action('after_content','sfhiv_page_list_related',10);
function sfhiv_page_list_related(){
	if(!is_singular() || is_front_page()) return;
	$related = sfhiv_get_related_pages();
	do_action('sfhiv_loop',$related,array(
		"id" => "related",
		"title" => sfhiv_get_related_title(),
		"classes" => array("list","related"),
		"list_element" => "short",
		'show_empty' => false,
		'show_filters' => false,
	));
}
add_action('navigation','sfhiv_navigation_related_link',1);
function sfhiv_navigation_related_link(){
	if(!is_singular() || is_front_page()) return;
	$related = sfhiv_get_related_pages();
	if($related->post_count < 1) return;
	$related_title = sfhiv_get_related_title();
	if(!$related_title) return;
	echo '<a href="#related">'.$related_title.'</a>';
}

add_action('before_content','sfhiv_content_add_navigation');
function sfhiv_content_add_navigation(){
	echo '<nav class="entry-navigation">';
	do_action('navigation');
	echo '<br class="clear" />';
	echo '</nav>';
}

add_action('short_navigation','sfhiv_navigation_view_link',1);
function sfhiv_navigation_view_link(){
	if(in_array(get_post_type(),array('sfhiv_faq','sfhiv_document'))) return;
	echo '<a href="';
	the_permalink();
	echo '">';
	_e("View ");
	the_title();
	echo '</a>';
}


add_action('short_navigation','sfhiv_navigation_edit_link',1);
function sfhiv_navigation_edit_link(){
	if(get_post_type() == 'sfhiv_service_hour') return;
	edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>', get_the_ID() );
}

if(function_exists('cf7mb_remove_display_action')){
	cf7mb_remove_display_action();
}

add_action('get_footer','sfhiv_footer_add_contact_form_7',20);
function sfhiv_footer_add_contact_form_7(){
	if(!is_singular()) return;
	$form = cf7mb_get_post_contact_form();
	if(!$form) return;
	echo '<div class="main-column contact-form">';
	echo $form;
	echo '</div>';
}


?>