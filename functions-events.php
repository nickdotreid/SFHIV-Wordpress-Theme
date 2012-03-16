<?


function sfhiv_em_custom_formats( $array ){
	$my_formats = array('dbem_single_event_format'); //the format you want to override, corresponding to file above.
	return $array + $my_formats; //return the default array and your formats.
}
add_filter('em_formats_filter', 'sfhiv_em_custom_formats', 1, 1);


function sfhiv_get_date($time,$end_time=false){
	$date_format = get_option('date_format');
	$time_format = get_option('time_format');
	
	$formatted = '<div class="date">';
	$formatted .= '<span class="full_string">';
	$formatted .= date($date_format,$time);
	$formatted .= '</span>';
	$formatted .= '</div>';
	$formatted .= '<div class="time">';
	if($end_time && $end_time!=$time){
		$formatted .= '<span class="start"><span class="label">Starts:</span>'.date($time_format,$time).'</span>';
		$formatted .= '<span class="end"><span class="label">Ends:</span>'.date($time_format,$end_time).'</span>';
	}else{
		$formatted .= '<span class="start">'.date($time_format,$time).'</span>';
	}
	$formatted .= '</div>';
	return $formatted;
}

function sfhiv_date($time,$end_time=false){
	echo sfhiv_get_date($time,$end_time);
}

add_action('mini_archive_before','sfhiv_add_event_filter');
function sfhiv_add_event_filter(){
	$archive_type = mini_archive_on_page(get_the_ID());
	if(is_page() && $archive_type && $archive_type=='event'):
		get_template_part("nav","event");
	endif;
}


?>