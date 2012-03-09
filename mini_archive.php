<aside id="mini_archive" class="list">
	<?	while($query->have_posts()):	$query->the_post();?>
	
	<?	get_template_part( 'list', $archive_type );	?>
	
	<?	endwhile;	?>
</aside><!-- #mini_archive -->