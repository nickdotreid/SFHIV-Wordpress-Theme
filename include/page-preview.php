<?php

add_action('sfhiv-preview-menu','sfhiv_add_mini_archive_menu');
function sfhiv_add_mini_archive_menu(){
	$archive_type = mini_archive_on_page(get_the_ID());
	if($archive_type):
		$output_archive = false;
		$query = mini_archive_get_query(get_the_ID());
		if(in_array($archive_type,array(
			'event',
		))){
			$groups = sfhiv_get_related_in($query,'group_events');
			if(count($groups) > 0){
				$output_archive = true;
				sfhiv_draw_menu($groups);
			}
		}
		$archive_filters = mini_archive_get_filters();
		foreach($archive_filters as $filter){
			if(!$output_archive){
				$years = sfhiv_get_taxonomy_in($query,'sfhiv_years');
				if(count($years) > 1){
					$output_archive = true;
					sfhiv_draw_taxonomy_menu(array(
						'taxonomy' => 'sfhiv_years',
						
					));
					?>
					<nav><ul class="menu">
					<?
					foreach($years as $year){
						?>
						<li class="menu-item"><a href="<?the_permalink();?>#<?=$year->slug;?>"><?=$year->name;?></a></li>
						<?
					}
					?>
					</ul></nav>
					<?
				}
			}
		}
		if(!$output_archive):
			$query = mini_archive_get_query(get_the_ID(),3);
			?><nav><ul class="menu"><?
			while($query && $query->have_posts()){
				$query->the_post();
				get_template_part( 'menu-item', $archive_type );
			}
			?></ul></nav><?
		endif;
	endif;
}




?>