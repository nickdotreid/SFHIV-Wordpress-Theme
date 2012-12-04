<?php

add_action('short_after_content','sfhiv_service_provider_list_hours');
function sfhiv_service_provider_list_hours(){
	global $post;
	if(get_post_type() != 'sfhiv_provider') return;
	$provider = get_post();
	$time_format = get_option('time_format');
	?><ul class="services services-list"><?
	foreach($provider->services as $service){
		$post = $service;
		get_template_part('list-item','sfhiv_service');		
	}
	$post = $provider;
	?></ul><?
}

add_action('get_service_provider_title','sfhiv_service_get_provider_title');
function sfhiv_service_get_provider_title(){
	if(!in_array(get_post_type(),array('sfhiv_service_hour','sfhiv_service'))) return;
	if(get_post_type() == 'sfhiv_service_hour'){
		$service = sfhiv_service_hour_get_service(get_post(get_the_ID()));
		if(!$service) return;
	}else{
		$service = get_post(get_the_ID());	
	}
	if(count($service->providers) < 1) return;
	echo '<div class="provider-title">'.get_the_title($service->providers[0]->ID).'</div>';
}

//add_filter('the_title','sfhiv_service_filter_provider_title',10,2);
function sfhiv_service_filter_provider_title($title,$id){
	if(is_admin()) return $title;
	if(!in_array(get_post_type($id),array('sfhiv_service_hour','sfhiv_service'))) return $title;
	if(get_post_type() == 'sfhiv_service_hour'){
		$service = sfhiv_service_hour_get_service(get_post(get_the_ID()));
		if(!$service) return $title;
	}else{
		$service = get_post(get_the_ID());	
	}
	if(count($service->providers) < 1) return $title;
	return get_the_title($service->providers[0]->ID);
}


add_filter('the_permalink','sfhiv_service_hour_change_permalink',1);
function sfhiv_service_hour_change_permalink($link){
	if(get_post_type() != 'sfhiv_service_hour') return $link;
	$parent = sfhiv_service_hour_get_parent(get_post(get_the_ID()));
	if($parent){
		return get_permalink($parent->ID);
	}
	return $link;
}

add_action('short_navigation','sfhiv_service_hour_show_edit_link',1);
function sfhiv_service_hour_show_edit_link(){
	if(get_post_type() != 'sfhiv_service_hour') return;
	$service = sfhiv_service_hour_get_parent(get_post());
	if(!$service) return;
	edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>', $service->ID );
}

add_action('list-item_content','sfhiv_service_population_display',2);
add_action('short_after_content','sfhiv_service_population_display',2);
function sfhiv_service_population_display(){
	if(!in_array(get_post_type(),array('sfhiv_service_hour','sfhiv_service'))) return;
	sfhiv_population_cat_sentence(get_post(get_the_ID()));
}

function sfhiv_population_cat_display($post){
	$population_terms = wp_get_post_terms($post->ID,'sfhiv_population_category',array(
		'orderby' => 'term_order',
	));
	if(count($population_terms)<1) return;
	echo '<section class="populations categories">';
	echo '<ul>';
	foreach($population_terms as $term){
		echo '<li class="population '.$term->slug.'">'.$term->name.'</li>';
	}
	echo '</ul>';
	echo '<div class="clear"></div>';
	echo '</section>';
}

function sfhiv_population_cat_sentence($post){
	$population_terms = wp_get_post_terms($post->ID,'sfhiv_population_category',array(
		'orderby' => 'term_order',
	));
	if(count($population_terms)<1) return;
	echo '<section class="populations populations-sentence">';
	if(count($population_terms) == 1 && $population_terms[0]->slug == 'anyone'){
		echo '<p><strong>Open to Everyone</strong></p>';
	}else{
		echo '<p><span><strong>Only serves</strong> </span>';
		for($i=0;$i<sizeof($population_terms);$i++){
			echo $population_terms[$i]->name;
			if($i+1<sizeof($population_terms)){
				echo ", ";
			}
			if($i!=0 && $i+2 == sizeof($population_terms)){
				echo "and ";
			}
		}
		echo '</p>';		
	}
	echo '</section>';
}


add_action('list-item_content','sfhiv_service_hour_service_cat_display',2);
add_action('short_after_content','sfhiv_service_hour_service_cat_display',2);
function sfhiv_service_hour_service_cat_display(){
	if(!in_array(get_post_type(),array('sfhiv_service_hour','sfhiv_service'))) return;
	sfhiv_service_cat_display(get_post(get_the_ID()));
}
function sfhiv_service_cat_display($post){
	$service_terms = wp_get_post_terms($post->ID,'sfhiv_service_category',array(
		'orderby' => 'term_order',
	));
	if(count($service_terms)<1) return;
	echo '<section class="services categories">';
	echo '<ul>';
	foreach($service_terms as $term){
		echo '<li class="service '.$term->slug.'">'.$term->name.'</li>';
	}
	echo '</ul>';
	echo '<div class="clear"></div>';
	echo '</section>';
}

add_action('after_list-item','sfhiv_service_hour_display_time',7);
add_action('short_after_content','sfhiv_service_hour_display_time',7);
function sfhiv_service_hour_display_time(){
	if (get_post_type()!='sfhiv_service_hour') return;
	sfhiv_service_hours_print_list(array(
		get_post(get_the_ID())
		));
}


add_action('get_sidebar','sfhiv_service_page_parent_groups',20);
function sfhiv_service_page_parent_groups(){
	if (!is_singular('sfhiv_service')) return;
	$groups = sfhiv_service_get_groups(get_the_ID());
	if(count($groups)<1) return;
	$group_ids = array();
	foreach($groups as $group){
		$group_ids[] = $group->ID;
	}
	sfhiv_draw_menu($groups,array(
		'selected_items' => $group_ids,
	));
}

add_action('short_after_content','sfhiv_service_page_service_hours',20);
add_action('get_footer','sfhiv_service_page_service_hours',20);
function sfhiv_service_page_service_hours(){
	if( get_post_type() != 'sfhiv_service' ) return;
	$service = get_post(get_the_ID());
	sfhiv_service_hours_print_list($service->times);
}

function sfhiv_service_hours_print_list($times){
	$time_format = get_option('time_format');
	echo '<ul class="list sfhiv_service_time_hour service-time-list">';
	$locations = sfhiv_service_hours_sort_by_location($times);
	foreach($locations as $location){
		echo '<li class="sfhiv_service_hour type-sfhiv_service_hour status-publish hentry list-item">';
		$days = sfhiv_service_hours_sort_by_day($location->times);
		echo '<div class="times-list">';
		foreach($days as $day){
			echo '<div class="time-container">';
			echo '<div class="date date-float">';
			sfhiv_service_hour_markup_day($day['day']);
			echo '</div>';
			foreach($day['times'] as $time){
				sfhiv_service_hour_display_time_markup($time->start,$time->end,$time_format);	
			}
			echo '<div class="clear">&nbsp;</div>';
			echo '</div><!-- end .time-container -->';
		}
		echo '</div><!-- end .times-list -->';
		sfhiv_location_format($location);
		echo '<div class="clear">&nbsp;</div>';
		echo '</li>';
	}
	echo '</ul>';
	echo '<div class="clear">&nbsp;</div>';
}

function sfhiv_service_hour_display_day_markup($post_id){
	$days = sfhiv_service_get_service_days(get_post($post_id));
	foreach($days as $day){
		sfhiv_service_hour_markup_day($day);
	}
}

function sfhiv_service_hour_markup_day($day){
	$term = get_term_by('slug',$day,'sfhiv_day_of_week_taxonomy');
	echo '<span class="day">'.$term->name.'</span>';
}

function sfhiv_service_hour_display_time_markup($start,$end,$format){
	echo '<div class="time time-float">';
	echo '<span class="start">'.date($format,$start).'</span>';
	if($start != $end){
		echo '<span class=""> until </span>';
		echo '<span class="end">'.date($format,$end).'</span>';		
	}
	echo '</div>';
}

?>