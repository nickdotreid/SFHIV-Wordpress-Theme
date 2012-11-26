<?php

$date_status = get_post_meta(get_the_ID(),'sfhiv_event_date_status');
if(count($date_status) > 0){
	$date_status = $date_status[0];
}else{
	$date_status = false;
}
if($date_status == 'tba'):	?>
<div class="date date-tba tba">
	<span class="tba">Date To Be Announced</span>
</div>
<?	else:
$now = time();
$time = get_post_meta(get_the_ID(),'sfhiv_event_start',true);
	if($date_status == 'month'):
?>
<div class="date date-tba tba">
	<span><?=date("F, Y",$time);?></span>
	<span class="tba">Day To Be Announced</span>
</div><?	
	else:
?>
<div class="date">
	<?	if(date("j-F-Y",$now) == date("j-F-Y",$time)):	?>
	<span class="day today"><?_e("Today","sfhiv2012");?></span>
	<?	elseif($now+604800 > $time && $now < $time):	?>
	<span class="day"><?=date('l',$time);?></span>
	<?	endif;	?>
	<span><?=date("F d, Y",$time);?></span>
</div><?
	endif;	# MONTH
endif; # TBA 
?>