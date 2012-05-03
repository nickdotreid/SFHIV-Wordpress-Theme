<?php

function sfhiv_display_location(){
	$location = sfhiv_location_get_related_location(get_the_ID());
	if($location){
		sfhiv_location_format($location);
	}
}

function sfhiv_location_format($post){
	$location = sfhiv_location_get_address($post);
	echo '<div class="address">';
	echo '<i class="icon-map-marker"></i>';
	sfhiv_location_format_line('room',$location);
	sfhiv_location_format_line('address',$location);
	sfhiv_location_format_line('zip_code',$location);
	sfhiv_location_format_line('city',$location);
	sfhiv_location_format_line('state',$location);
	sfhiv_location_format_line('country',$location);
	sfhiv_location_format_line('hint',$location);
	echo '</div>';
}
function sfhiv_location_format_line($key,$data){
	if(!$data[$key]) return;
	$dont_display = array("san francisco","united states","california");
	if(in_array(strtolower($data[$key]),$dont_display)) return;
	$value = $data[$key];
	if($key == 'address') $key = 'street';
	echo '<span class="'.$key.'">'.$value.'</span>';
}


?>
