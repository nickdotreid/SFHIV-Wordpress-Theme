<?php
$time_format = get_option('time_format');

$start_time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);
$end_time = get_post_meta(get_the_ID(),'sfhiv_event_end',true);
?>
<div class="time time-float">
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
</div>