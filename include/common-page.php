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
	$page = false;
	
	switch(get_post_type()){
		case 'sfhiv_group':
			if(has_term('hiv-prevention-planning-council','sfhiv_group_category',get_the_ID())){
				$page = get_page_by_title('HIV Prevention Planning Council');
			}
			if(has_term('hps-units','sfhiv_group_category',get_the_ID())){
				$page = get_page_by_title('Our Units');
			}
			break;
		case 'sfhiv_study':
			$page = get_page_by_title('Studies');
			break;
	}
	
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

add_action('before_content','sfhiv_content_add_navigation');
function sfhiv_content_add_navigation(){
	echo '<nav class="entry-navigation top">';
	$links = sfhiv_extract_toc(get_the_content(get_the_ID()));
	foreach($links as $link){
		echo '<a href="#'.$link['anchor'].'">'.$link['title'].'</a>';
	}
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


?>