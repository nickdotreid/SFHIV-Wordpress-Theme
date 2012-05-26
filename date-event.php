<?php

$now = time();

$date_format = get_option('date_format');

$time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);
$end_time = get_post_meta(get_the_ID(),'sfhiv_event_end',true);

?>
<div class="date date-calendar">
	<?	if(date("j-F-Y",$now) == date("j-F-Y",$time)):	?>
	<span class="today"><?_e("Today","sfhiv2012");?></span>
	<?	elseif($now+604800 > $time && $now < $time):	?>
	<span class="day"><?=date('l',$time);?></span>
	<?	endif;	?>
	<span class="date-number"><?=date("j",$time);?></span>
	<span class="month"><?=date("F",$time);?></span>
	<?	if(date("Y",$now) != date("Y",$time)):	?>
	<span class="year"><?=date("Y",$time);?></span>
	<?	endif;	?>
</div>