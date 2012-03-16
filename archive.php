<section id="archive" class="list">
	<?	while($query->have_posts()):	$query->the_post();?>
	
	<?	get_template_part( 'list', $archive_type );	?>
	
	<?	endwhile;	?>
</section><!-- #mini_archive -->