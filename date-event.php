<?php

$now = time();

$date_format = get_option('date_format');

$time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);

?>
<span class="date">
	<?	if(date("j-F-Y",$now) == date("j-F-Y",$time)):	?>
	<span class="today"><?_e("Today","sfhiv2012");?></span>
	<?	elseif($now+604800 > $time && $now < $time):	?>
	<span class="day"><?=date('l',$time);?></span>
	<?	endif;	?>
	<?=date($date_format,$time);?>
</span>