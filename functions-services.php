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
		$num += 15;
		array_push($minutes,$num);
	}
	$ampm = array('AM','PM');
	
	$days = get_post_meta($post->ID, 'sfhiv_service_days',true);
	if($days){
		$days = explode(",",$days);	
	}
	$start = get_post_meta($post->ID, 'sfhiv_service_start');
	$end = get_post_meta($post->ID, 'sfhiv_service_end');
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
			<legend>Start Time</legend>
			<label>Hour
				<select name="hours[start][hour]">
				<?	foreach($hours as $hour):	?>
					<option value="<?=$hour;?>"><?=$hour;?></option>
				<?	endforeach;	?>
				</select>
			</label>
			<label>Minute
				<select name="hours[start][minute]">
				<?	foreach($minutes as $minute):	?>
					<option value="<?=$minute;?>"><?=$minute;?></option>
				<?	endforeach;	?>
				</select>
			</label>
			<label>
				<select name="hours[start][ampm]">
				<?	foreach($ampm as $time):	?>
					<option value="<?=$time;?>"><?=$time;?></option>
				<?	endforeach;	?>
				</select>
			</label>
		</fieldset>
		<fieldset>
			<legend>End Time</legend>
			<label>Hour
				<select name="hours[end][hour]">
				<?	foreach($hours as $hour):	?>
					<option value="<?=$hour;?>"><?=$hour;?></option>
				<?	endforeach;	?>
				</select>
			</label>
			<label>Minute
				<select name="hours[end][minute]">
				<?	foreach($minutes as $minute):	?>
					<option value="<?=$minute;?>"><?=$minute;?></option>
				<?	endforeach;	?>
				</select>
			</label>
			<label>
				<select name="hours[end][ampm]">
				<?	foreach($ampm as $time):	?>
					<option value="<?=$time;?>"><?=$time;?></option>
				<?	endforeach;	?>
				</select>
			</label>
		</fieldset>
		<fieldset>
			<legend>Appointment</legend>
			<label class="radio"><input type="radio" name="hours[appointment]" value="" />No Appointment</label>
			<label class="radio"><input type="radio" name="hours[appointment]" value="" />Appointment Recommended</label>
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
	if(isset($_POST['hours']['start']) && 
		isset($_POST['hours']['start']['hour']) &&
		isset($_POST['hours']['start']['minute']) &&
		isset($_POST['hours']['start']['ampm'])
	){
		$time = $_POST['hours']['start']['hour'].":".$_POST['hours']['start']['minute']." ".$_POST['hours']['start']['ampm'];
		update_post_meta($post_ID, 'sfhiv_service_start', $time);
	}
	if(isset($_POST['hours']['end']) && 
		isset($_POST['hours']['end']['hour']) &&
		isset($_POST['hours']['end']['minute']) &&
		isset($_POST['hours']['end']['ampm'])
	){
		$time = $_POST['hours']['end']['hour'].":".$_POST['hours']['end']['minute']." ".$_POST['hours']['end']['ampm'];
		update_post_meta($post_ID, 'sfhiv_service_end', $time);
	}
	if(isset($_POST['hours']['appointment'])){
		update_post_meta($post_ID, 'sfhiv_service_appointment', $_POST['hours']['appointment']);
	}
}

?>