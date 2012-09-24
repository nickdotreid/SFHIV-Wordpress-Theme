<?	$post = get_post();	?>
<article id="post-<?=the_ID();?>" <?php 
	post_class("short");
	do_action("short_attributes");
	?>>
	<header>
		<h3 class="entry-title"><?=the_title();?></h3>
	</header>
	<div class="services">
	<?	foreach($post->services as $service):	?>
		<div id="sfhiv-service-<?=$service->ID;?>" class="service">
			<header><a href="#"><?=get_the_title($service->ID);?></a></header>
			<div class="entry-content">
				<?=apply_filters("content",$service->post_content);?>
			</div>
			<?	foreach($service->times as $time):	?>
			<?	print_r($time); ?>
			<?	endforeach; ?>
		</div>
	<?	endforeach; ?>
	</div>
	<br class="clear" />
</article>