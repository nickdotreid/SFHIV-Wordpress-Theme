<article id="post-<?=the_ID();?>" <?php post_class("list-item"); ?> 
	populations="<?=implode(",",wp_get_object_terms(get_the_ID(),'sfhiv_population_category',array("fields"=>"slugs")));?>"
	services="<?=implode(",",wp_get_object_terms(get_the_ID(),'sfhiv_service_category',array("fields"=>"slugs")));?>"
	>
	<header>
		<h1 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h1>
	</header>
	<div class="entry-content">
		<?=the_excerpt();?>
	</div>
	<?	$service_types = wp_get_object_terms(get_the_ID(),'sfhiv_service_category');	?>
	<?	if(count($service_types)>0):	?>
	<aside class="category-list">
		<h3>Services Offered</h3>
	<ul class="service_categories">
	<?	foreach($service_types as $category):	?>
		<li class="category <?=$category->taxonomy;?> <?=$category->slug;?>"><?=$category->name;?></li>
	<?	endforeach;	?>
	</ul>
	</aside>
	<?	endif;	?>
	<?	$population_types = wp_get_object_terms(get_the_ID(),'sfhiv_population_category');	?>
	<?	if(count($population_types)>0):	?>
	<aside class="category-list">
		<h3>Population Specific</h3>
	<ul class="population_categories">
	<?	foreach($population_types as $category):	?>
		<li class="category <?=$category->taxonomy;?> <?=$category->slug;?>"><?=$category->name;?></li>
	<?	endforeach;	?>
	</ul>
	</aside>
	<?	endif;	?>
	<nav>
		<a href="<?=the_permalink();?>"><?=__('View '.get_the_title(),'sfhiv_theme');?></a>
		<?	$items = sfhiv_group_menu_items();	?>
		<?	foreach($items as $item):	?>
		<a href="<?=the_permalink();?>#<?=$item;?>"><?=__('View '.$item,'sfhiv_theme');?></a>
		<?	endforeach;	?>
		<?php edit_post_link( __( 'Edit', 'sfhiv_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</nav>
</article>