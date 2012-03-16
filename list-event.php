<?php $event = em_get_event(get_the_ID());	?>
<?
$location = false;
if($event->location_id){
	$location = em_get_location($event->location_id);
}

$attachments = get_posts(array(
	'post_type' => 'attachment',
	'numberposts' => -1,
	'post_status' => null,
	'post_parent' => get_the_ID(),
	));


$groups = new WP_Query( array(
  'connected_type' => 'group_events',
  'connected_items' => get_the_ID(),
  'nopaging' => true,
));
$group_slugs = array();
foreach($groups->posts as $group){
	array_push($group_slugs,$group->post_name);
}

?>
<article id="post-<?=the_ID();?>" <?php post_class("list-item"); ?> start="<?=$event->start*1000;?>" end="<?=$event->end*1000;?>" groups="<?=implode(",",$group_slugs);?>">
	<header>
		<h1 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h1>
	</header>
	<div class="event_date_time">
		<?=sfhiv_get_date($event->start,$event->end);?>
	</div>
	<?	if($location):	?>
	<div class="event-location">
		<span class="street"><?=$location->location_address;?></span>
		<span class="city"><?=$location->location_town;?></span>
	</div>
	<?	endif;	?>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<nav>
		<a href="<?=the_permalink();?>"><?_e("View Event");?></a>
	</nav>
	<?	if ($attachments):	?>
	<nav>
	<ul class="attachments">
	<?	foreach ( $attachments as $attachment ):	?>
			<li class="attachment"><?	the_attachment_link( $attachment->ID , true );	?></li>
	<?	endforeach;	?>
	</ul>
	</nav>
	<?	endif;	?>
</article>