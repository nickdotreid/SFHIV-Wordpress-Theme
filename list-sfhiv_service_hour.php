<?
$service_parents = new WP_Query( array(
	'connected_type' => 'service_time',
	'connected_items' => get_the_ID(),
));
$service_parent = false;
if($service_parents->post_count > 0)	$service_parent = $service_parents->posts[0];

$time_format = get_option('time_format');

?>
<article id="post-<?=the_ID();?>" <?php post_class("list-item sfhiv_service"); ?>
	service-parent="<?=$service_parent->ID;?>"
	>
	<header>
		<h1 class="entry-title"><a href="<?=get_permalink($service_parent->ID);?>"><?=get_the_title($service_parent->ID);?></a></h1>
	</header>
	<div class="entry-content">
		<?=apply_filters('the_excerpt',$service_parent->post_excerpt);?>
	</div>
	<aside class="day_time column">
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
	<aside class="relationships column">
		<? $service_groups = sfhiv_service_get_groups($service_parent->ID);	?>
		<?	if( count($service_groups) > 0):	?>
		<ul class="related_groups">
		<?	foreach($service_groups as $sgroup):	?>
			<li class="group <?=implode(" ",wp_get_object_terms($sgroup->ID,'sfhiv_group_category',array("fields"=>"slugs")));?>">
				<?=get_the_title($sgroup->ID);?>
			</li>
		<?	endforeach;	?>
		</ul>
		<?	endif;	?>
		<!-- LIST SERVICES -->
		<?	$service_types = wp_get_object_terms($service_parent->ID,'sfhiv_service_category');	?>
		<?	if(count($service_types)>0):	?>
		<ul class="service_categories">
		<?	foreach($service_types as $category):	?>
			<li class="category <?=$category->taxonomy;?> <?=$category->slug;?>"><?=$category->name;?></li>
		<?	endforeach;	?>
		</ul>
		<?	endif;	?>
		<!-- LIST POPULATION -->
		<?	$population_types = wp_get_object_terms($service_parent->ID,'sfhiv_population_category');	?>
		<?	if(count($population_types)>0):	?>
		<ul class="population_categories">
		<?	foreach($population_types as $category):	?>
			<li class="category <?=$category->taxonomy;?> <?=$category->slug;?>"><?=$category->name;?></li>
		<?	endforeach;	?>
		</ul>
		<?	endif;	?>
	</aside>
	<nav>
		<a href="<?=get_permalink($service_parent->ID);?>"><?=__('View '.get_the_title($service_parent->ID),'sfhiv_theme');?></a>
		<?php edit_post_link( __( 'Edit', 'sfhiv_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>', $service_parent->ID ); ?>
	</nav>
</article>