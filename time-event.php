<?php
$date_status = get_post_meta(get_the_ID(),'sfhiv_event_date_status');
if(count($date_status) > 0){
	$date_status = $date_status[0];
}else{
	$date_status = false;
}
if(in_array($date_status,array('tba','month','day'))):
	if($date_status == 'day'):	?>
<div class="time time-tba tba">
	<span class="tba">Time To Be Announced</span>
</div><?
	endif;
else:
	$time_format = get_option('time_format');
	$start_time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);
	$end_time = get_post_meta(get_the_ID(),'sfhiv_event_end',true);
?>
<div class="time">
<?	if($end_time && $end_time!=$time):	?>
	<span class="start">
		<?=date($time_format,$start_time);?>
	</span>
	<span class=""><?_e("until");?></span>
	<span class="end">
		<?=date($time_format,$end_time);?>
	</span>
<?	else:	?>
	<span class="start">
		<?=date($time_format,$start_time);?>
	</span>
<?	endif;	?>
</div><? 
endif; # !$date_tba	?>