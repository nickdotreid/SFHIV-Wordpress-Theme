<?php

add_action('sfhiv_post_loop','sfhiv_archive_show_pages',10,2);
function sfhiv_archive_show_pages($query,$args){
	if($query->max_num_pages<2) return;
	$args = array(
		'total'        => $query->max_num_pages,
		'current'      => intval(get_query_var('paged')),
	);
	echo paginate_links( $args );
}

?>