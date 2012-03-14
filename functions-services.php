<?php

add_action('init','sfhiv_add_services_type');
function sfhiv_add_services_type(){
	register_post_type( 'service',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'Service' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'taxonomies' => array('catagories'),
		'register_meta_box_cb' => 'sfhiv_add_services_meta_boxes',
		)
	);
	add_post_type_support( 'service', 'excerpt' );
}

function sfhiv_add_services_meta_boxes(){
	add_meta_box( 'sfhiv_services_hours', 'Hours of Operation', 'sfhiv_services_hours_op_meta', 'service', 'normal' );
}

function sfhiv_services_hours_op_meta($post){
	$days_in_week = array(
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday',
		'Saturday',
		'Sunday',
	);
	$hours = array();
	$num = 0;
	while($num < 12){
		$num ++;
		array_push($hours,$num);
	}
	$minutes = array();
	$num = 0;
	while($num < 60){
		array_push($minutes,$num);
		$num += 15;
	}
	$ampm = array('AM','PM');
	
	$days = get_post_meta($post->ID, 'sfhiv_service_days',true);
	if($days){
		$days = explode(",",$days);	
	}
	$start = get_post_meta($post->ID, 'sfhiv_service_start',true);
	$start = date('g:i a',$start);
	$end = get_post_meta($post->ID, 'sfhiv_service_end',true);
	$end = date('g:i a',$end);
	$appointment = get_post_meta($post->ID, 'sfhiv_service_appointment');
	
	?>
	<fieldset>
		<legend>Hours of Operation</legend>
		<fieldset>
			<legend>Days of Week</legend>
			<?	foreach($days_in_week as $day):	?>
			<label class="checkbox"><input type="checkbox" name="hours[day_of_week][]" value="<?=$day;?>" <?	if(in_array($day,$days)){ echo 'checked="checked"'; }	?>  /><?=$day;?></label>
			<?	endforeach;	?>
		</fieldset>
		<fieldset>
			<legend>Time</legend>
			<label for="hours_start">Start Time</label>
			<input id="hours_start" type="text" name="hours[start]" value="<?=$start;?>" />
			<label for="hours_end">End Time</label>
			<input id="hours_end" type="text" name="hours[end]" value="<?=$end;?>" />
		</fieldset>
		<fieldset>
			<legend>Appointment</legend>
			<label class="radio"><input type="radio" name="hours[appointment]" value="" />No Appointment</label>
			<label class="radio"><input type="radio" name="hours[appointment]" value="recommended" />Appointment Recommended</label>
			<label class="radio"><input type="radio" name="hours[appointment]" value="required" />Appointment Required</label>
		</fieldset>
	</fieldset>
	<?
}

add_action( 'save_post', 'sfhiv_service_hours_save' );
function sfhiv_service_hours_save($post_ID,$post){

	if(isset($_POST['hours']['day_of_week'])){
		$days = implode(",",$_POST['hours']['day_of_week']);
		update_post_meta($post_ID, 'sfhiv_service_days', $days);
	}
	if(isset($_POST['hours']['start'])){
		$seconds = strtotime($_POST['hours']['start']);
		update_post_meta($post_ID, 'sfhiv_service_start', $seconds);
	}
	if(isset($_POST['hours']['end'])){
		$seconds = strtotime($_POST['hours']['end']);
		update_post_meta($post_ID, 'sfhiv_service_end', $seconds);
	}
	if(isset($_POST['hours']['appointment'])){
		update_post_meta($post_ID, 'sfhiv_service_appointment', $_POST['hours']['appointment']);
	}
}

?>