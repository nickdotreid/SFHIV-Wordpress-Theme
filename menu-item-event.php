<?php $event = em_get_event(get_the_ID());	?>
<?
$location = false;
if($event->location_id){
	$location = em_get_location($event->location_id);
}
?>
<li class="menu-item">
	<span class="date">
		<span class="month"><?=date("M",$event->start);?></span>
		<span class="day"><?=date("d",$event->start)?></span>
	</span>
	<a class="title" href="<?the_permalink();?>"><?the_title();?></a>
</li>