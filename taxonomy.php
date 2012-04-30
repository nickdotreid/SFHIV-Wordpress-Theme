<?php
/**
 * The template for displaying Custom Taxonomy pages.
 *
 * @package SFHIV_THEME
 * @since SFHIV_THEME 0.1
 */

$term =	get_queried_object();
$post_types = array();
if(isset($wp_query->query_vars['post_type'])){
	$post_type = $wp_query->query_vars['post_type'];
	$post_types[$post_type] = get_post_type_object($post_type);
}else{
	foreach(get_post_types() as $post_type){
		foreach(get_object_taxonomies( $post_type ) as $tax){
			if($tax == $term->taxonomy && $post_type != 'sfhiv_service_hour'){
				$post_types[$post_type] = get_post_type_object($post_type);;
			}
		}
	}	
}

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">
				<article class="post entry">
					<header class="entry-header">
						<h1 class="entry-title"><?php
							printf( __( '%s Archive', 'sfhiv_theme' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						?></h1>
					</header>
					<div class="entry-content">
						<?php
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
						?>
					</div>
					<nav>
						<!-- toc of post types? -->
					</nav>
				</article>
				<?
				foreach($post_types as $name => $object):
					$query = new WP_Query(array(
						'post_type'=>$name,
						$term->taxonomy => $term->slug,
					));
					do_action('sfhiv_loop',$query,array(
						"id" => $name,
						"title" => $object->label,
					));
				endforeach;
				?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>