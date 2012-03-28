<?php

$date_format = get_option('date_format');
$time_format = get_option('time_format');

$start_time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);
$end_time = get_post_meta(get_the_ID(),'sfhiv_event_end',true);

?>
<div class="date">
	<span class="full_string"><?=date($date_format,$start_time);?></span>
</div>
<div class="time">
<?	if($end_time && $end_time!=$time):	?>
	<span class="start">
		<span class="label"><?_e('Starts:');?></span>
		<?=date($time_format,$start_time);?>
	</span>
	<span class="end">
		<span class="label"><?_e('Ends:');?></span>
		<?=date($time_format,$end_time);?>
	</span>
<?	else:	?>
	<span class="start">
		<?=date($time_format,$start_time);?>
	</span>
<?	endif;	?>
</div>