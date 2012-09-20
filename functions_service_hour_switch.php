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
	if ( is_admin() || $query_vars['post_type'] != 'sfhiv_service_hour' ) return;
	if(!sfhiv_services_day_taxonomy_in_query_vars($query_vars)){
		$query_vars = $query_vars;
		$query_vars['post_type'] = 'sfhiv_service';
	}
	return $query_vars;
}

?>