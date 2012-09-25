<?php

function sfhiv_services_day_taxonomy_in_query_vars($query_vars){
	if($query_vars['tax_query']){
		foreach($query_vars['tax_query'] as $num => $que){
			if(is_array($que)){
				if( $que['taxonomy'] == 'sfhiv_day_of_week_taxonomy' ){
					return true;
				}
			}
		}
	}
	return false;
}

add_filter('mini_archive_pre_get_posts','sfhiv_service_hour_replace_with_sfhiv_service',10);
function sfhiv_service_hour_replace_with_sfhiv_service( $query_vars ) {
	if ( is_admin() || $query_vars['post_type'] != 'sfhiv_service_hour' ) return $query_vars;
	if(!sfhiv_services_day_taxonomy_in_query_vars($query_vars)){
		$query_vars = $query_vars;
		$query_vars['post_type'] = 'sfhiv_service';
	}
	return $query_vars;
}

add_filter('sfhiv_loop_pre_display','sfhiv_service_list_by_providers',10);
function sfhiv_service_list_by_providers($query){
	if($query->query_vars['post_type'] != 'sfhiv_service') return $query;
		
	$providers = array();
	$services = array();
	foreach( $query->posts as $service){
		$has_provider = false;
		foreach($service->providers as $provider){
			$has_provider = true;
			$found = false;
			foreach($providers as $_p){
				if($_p->ID == $provider->ID){
					$_p->services[] = $service;
					$found = true;
				}
			}
			if(!$found){
				$provider->services = array($service);
				$providers[] = $provider;
			}
		}
		if(!$has_provider){
			$services[] = $service;
		}
		$service->providers = array();
	}
	// sort providers??
	$query->posts = array_merge($providers,$services);
	$query->post_count = count($query->posts);
	return $query;
}

?>