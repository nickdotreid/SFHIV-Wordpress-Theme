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

add_action('get_sidebar','sfhiv_page_show_linked_page',11);
function sfhiv_page_show_linked_page(){
	if(!is_singular()) return;
	$page = sfhiv_link_to_page_get_page(get_the_ID());
	if(!$page) return;
	sfhiv_draw_menu(array($page),array(
		"show_parents" => true,
	));
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
		'post_mime_type' => 'application/pdf,application/msword'
		) );
	do_action('sfhiv_loop',$attachments,array(
		"id" => "attachments",
		"classes" => array("list","attachments"),
		"list_element" => "list",
	));
}

add_action('get_footer','sfhiv_page_list_related',10);
function sfhiv_page_list_related(){
	if(!is_singular() || is_front_page()) return;
	$related = sfhiv_get_related_pages();
	do_action('sfhiv_loop',$related,array(
		"id" => "related",
		"title" => 'Related',
		"classes" => array("list","related"),
		"list_element" => "list",
	));
}

?>