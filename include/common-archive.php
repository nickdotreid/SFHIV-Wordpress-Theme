<?php

add_action('sfhiv_pre_loop','sfhiv_archive_show_pages',2,2);
add_action('sfhiv_post_loop','sfhiv_archive_show_pages',10,2);
function sfhiv_archive_show_pages($query=false,$args=array()){
	global $wp_rewrite, $wp_query;
	
	if(!$query){
		$query = $wp_query;
	}
	$current_page = 1;
	if(isset($query->query_vars['paged'])){
		$current_page = intval($query->query_vars['paged']);
	}
	if($current_page < 1){
		$current_page = 1;
	}
	$args = array(
		'base' => @add_query_arg('page','%#%'),
		'total'        => $query->max_num_pages,
		'current'      => $current_page,
	);
	
	if( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo '<section class="info-query">';
	echo '<span class="results">';
	_e("Showing ".$query->post_count." of ".$query->found_posts.' results');
	echo '</span>';
	echo '<nav class="filters pagnate">';
	if($query->max_num_pages>1) echo paginate_links( $args );
		echo '<br class="clear" />';
	echo '</nav>';
	echo '<div class="clear" ></div>';
	echo '</section>';
}

add_action( 'pre_get_posts', 'sfhiv_archive_page_query' );
function sfhiv_archive_page_query( $query ) {
	if(is_admin()) return;
	if(isset($_GET['page']) && (!isset($query->query_vars['posts_per_page']) || $query->query_vars['posts_per_page'] >= 1)){
		$query->query_vars['paged'] = $_GET['page'];
	}
}

?>