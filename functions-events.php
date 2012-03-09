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
	$formatted .= '<span class="start">'.date($time_format,$time).'</span>';
	if($end_time && $end_time!=$time){
		$formatted .= '<span class="end">';
		$formatted .= '<span class="connector">'.__("until").'</span>';
		$formatted .= date($time_format,$end_time).'</span>';
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

add_action('get_sidebar','sfhiv_add_event_groups',30);
function sfhiv_add_event_groups(){
	$archive_type = mini_archive_on_page(get_the_ID());
	if(is_page() && $archive_type && $archive_type=='event'):
		$events = mini_archive_get_query();
		$event_ids = array();
		foreach($events->posts as $event){
			array_push($event_ids,$event->ID);
		}
		
		$groups = new WP_Query( array(
		  'connected_type' => 'group_events',
		  'connected_items' => implode(",",$event_ids),
		  'nopaging' => true,
		));
		?>
		<nav>
			<ul class="menu filters events">
				<li class="menu-item"><a class="filter default" type="group" value="all" href="#all"><?_e("All Groups");?></a>
				<?	foreach($groups->posts as $group):	?>
				<li class="menu-item"><a class="filter" type="group" value="<?=$group->ID;?>" href="#group-<?=$group->ID;?>"><?=$group->post_title;?></a></li>
				<?	endforeach;	?>
			</ul>
		</nav>
		<?
	endif;
}


?>