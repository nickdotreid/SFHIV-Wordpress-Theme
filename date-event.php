<?php

$now = time();
$time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);

?>
<div class="date">
	<?	if(date("j-F-Y",$now) == date("j-F-Y",$time)):	?>
	<span class="day today"><?_e("Today","sfhiv2012");?></span>
	<?	elseif($now+604800 > $time && $now < $time):	?>
	<span class="day"><?=date('l',$time);?></span>
	<?	endif;	?>
	<span><?=date("F d, Y",$time);?></span>
</div>