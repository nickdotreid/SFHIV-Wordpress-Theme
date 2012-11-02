<?	$provider = get_post();	?>
<?	$time_format = get_option('time_format');	?>
<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title provider-title"><?=the_title();?></h3>
	</header>
	<ul class="services services-list">
	<?	foreach($provider->services as $service):	?>
		<?	$post = $service;	?>
		<?	get_template_part('list-item','sfhiv_service');	?>
	<?	endforeach; ?>
	<?	$post = $provider;	?>
	</ul>
	<div class="clear"></div>
</article>