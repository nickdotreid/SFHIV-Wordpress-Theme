<article id="post-<?=the_ID();?>" <?php post_class("list-item"); ?> years="<?=implode(",",wp_get_object_terms(get_the_ID(),'year',array("fields"=>"slugs")));?>">
	<header>
		<h1 class="entry-title"><a href="<?=the_permalink();?>"><?=the_title();?></a></h1>
	</header>
	<div class="entry-content">
		<?=the_content();?>
	</div>
	<nav>
		<a href="<?=the_permalink();?>"><?=__('View '.get_the_title(),'sfhiv_theme');?></a>
		<?	$items = sfhiv_group_menu_items();	?>
		<?	foreach($items as $item):	?>
		<a href="<?=the_permalink();?>#<?=$item;?>"><?=__('View '.$item,'sfhiv_theme');?></a>
		<?	endforeach;	?>
		<?php edit_post_link( __( 'Edit', 'sfhiv_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</nav>
</article>