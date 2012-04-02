<?
$service_parents = new WP_Query( array(
	'connected_type' => 'service_time',
	'connected_items' => get_the_ID(),
));
$service_parent = false;
if($service_parents->post_count > 0)	$service_parent = $service_parents->posts[0];

$time_format = get_option('time_format');

$location = sfhiv_location_get_related_location(get_the_ID());
?>
<article id="post-<?=the_ID();?>" <?php post_class("list-item sfhiv_service"); ?>
	service-parent="<?=$service_parent->ID;?>"
	>
	<section class="group">
		<aside class="day_time">
			<? $days = get_post_meta(get_the_ID(),"sfhiv_service_days");?>
			<?	if(count($days)>0):	?>
			<div class="days">
				<ul>
				<?	foreach($days as $day):	?>
				<li class="day"><?=$day;?></li>
				<?	endforeach;	?>
				</ul>
			</div>
			<?	endif;	?>
			<div class="time">
				<span class="start"><span class="label">Start:</span><?=date($time_format,get_post_meta(get_the_ID(),"sfhiv_service_start",true));?></span>
				<span class="end"><span class="label">End:</span><?=date($time_format,get_post_meta(get_the_ID(),"sfhiv_service_end",true));?></span>
			</div>
		</aside>
		<?	if($location):	?>
		<aside class="location">
			<h3><?=apply_filters("the_title",$location->post_title);?></h3>
			<span class="address line"><?=get_post_meta($location->ID,'sfhiv_room',true);?></span>
			<span class="address line"><?=get_post_meta($location->ID,'sfhiv_address',true);?></span>
			<?	$city = get_post_meta($location->ID,'sfhiv_city',true);?>
			<?	if($city != 'San Francisco'):	?>
			<span class="address line"><?=get_post_meta($location->ID,'sfhiv_city',true);?>, <?=get_post_meta($location->ID,'sfhiv_state',true);?> <?=get_post_meta($location->ID,'sfhiv_zip_code',true);?></span>
			<?	endif;	?>
			<!-- View on Google Maps Link here -->
			<span class="address line hint"><?apply_filters('the_content',get_post_meta($location->ID,'sfhiv_location_hint',true));?></span>
		</aside>
		<?	endif;	?>
		<br class="clear" />
	</section>
	<aside class="relationships column">
		<?	$service_types = wp_get_object_terms($service_parent->ID,'sfhiv_service_category');	?>
		<?	if(count($service_types)>0):	?>
		<ul class="service_categories">
		<?	foreach($service_types as $category):	?>
			<li class="category <?=$category->taxonomy;?> <?=$category->slug;?>"><?=$category->name;?></li>
		<?	endforeach;	?>
		</ul>
		<?	endif;	?>
		<?	$population_types = wp_get_object_terms($service_parent->ID,'sfhiv_population_category');	?>
		<?	if(count($population_types)>0):	?>
		<ul class="population_categories">
		<?	foreach($population_types as $category):	?>
			<li class="category <?=$category->taxonomy;?> <?=$category->slug;?>"><?=$category->name;?></li>
		<?	endforeach;	?>
		</ul>
		<?	endif;	?>
	</aside>
</article>