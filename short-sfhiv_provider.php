<?	$post = get_post();	?>
<?	$time_format = get_option('time_format');	?>
<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title"><?=the_title();?></h3>
	</header>
	<div class="services services-list">
	<?	foreach($post->services as $service):	?>
		<div id="sfhiv-service-<?=$service->ID;?>" class="service service-list-item">
			<h4><a href="<?=get_permalink($service->ID);?>"><?=get_the_title($service->ID);?></a></h4>
			<?	sfhiv_service_cat_display($service);	?>
			<?	sfhiv_population_cat_sentence($service);	?>
			<div class="entry-content">
				<?=apply_filters("content",$service->post_content);?>
			</div>
			<?	sfhiv_service_hours_print_list($service->times); ?>
		</div>
	<?	endforeach; ?>
	</div>
	<div class="clear"></div>
</article>