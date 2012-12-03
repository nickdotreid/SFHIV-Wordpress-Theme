<?	$service = get_post();	?>
<li id="sfhiv-service-<?=get_the_ID();?>" <?
	post_class("list-item");
	do_action("list-item_attributes"); ?>>
	<h3><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
	<div class="entry-content">
		<?	the_content();	?>
	</div>
	<?	do_action("list-item_after_content");	?>
	<?	sfhiv_population_cat_sentence($service);	?>
	<?	sfhiv_service_cat_display($service);	?>
	<?	sfhiv_service_hours_print_list($service->times); ?>
	<nav class="entry-navigation">
		<?	do_action("short_navigation");	?>
	</nav>
	<div class="clear"></div>
</li>