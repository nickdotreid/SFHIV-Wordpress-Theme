<?php

$now = time();

$date_format = get_option('date_format');

$start_time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);
$end_time = get_post_meta(get_the_ID(),'sfhiv_event_end',true);

?>
<div class="date">
	<?	if(date($date_format,$now)==date($date_format,$start_time)):	?>
	<span class="line now">Today</span>
	<?	elseif($now+604800 > $start_time && $now < $start_time):	?>
	<span class="day"><?=date('l',$start_time);?></span>
	<?	endif;	?>
	<span class="full_string"><?=date(str_replace(array("y","Y",","),"",$date_format),$start_time);?></span>
	<?	if(date("Y",$now) != date("Y",$start_time)):	?>
	<span class="year"><?=date("Y",$start_time);?></span>
	<?	endif;	?>
</div>