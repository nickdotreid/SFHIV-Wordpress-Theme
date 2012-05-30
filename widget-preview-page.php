<?php

class SFHIV_Page_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			 		'sfhiv_page_widget', // Base ID
					'Page Preview', // Name
					array( 'description' => __( 'Display Preview Version of any page', 'text_domain' ), ) // Args
				);
	}

 	public function form( $instance ) {
		$pages = get_pages(array(
			'nopaging' => true,
		));
		?>
		<select name="<?=$this->get_field_name( 'page_ID' );?>">
			<?
			foreach($pages as $page):
		?><option value="<?=$page->ID;?>"	<?
			if($instance['page_ID'] == $page->ID) echo 'selected="true"';
		?>><?=apply_filters('the_title',$page->post_title);?></option><?
			endforeach
			?>
		</select>
		<?
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['page_ID'] = $new_instance['page_ID'];
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$query = new WP_Query( 'page_id='.$instance['page_ID'] );
		if($query->is_posts_page):
			echo $before_widget;
			$page_id = $instance['page_ID'];
			echo '<header class="entry-header">';
			echo '<h2 class="entry-title"><a href="'.get_permalink($page_id).'">'.get_the_title($page_id).'</a></h2>';
			echo '<div class="entry-content">';
			
			echo '</div>';
			echo '<ul class="list">';
			while($query->have_posts()):
				$query->the_post();
				echo '<li class="post">';
				echo '<a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a>';
				echo '<span class="date">'.get_the_date().'</span>';
//				echo '<span class="entry-content">'.get_the_excerpt().'</span>';
				'</li>';
			endwhile;
			echo '</ul>';
			wp_reset_postdata();
			echo $after_widget;
		else:
		while($query->have_posts()):
			$query->the_post();
			echo $before_widget;
		?>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<? the_excerpt(); ?>
		</div><!-- .entry-content -->
		<?	do_action("sfhiv-preview-menu");	?>
		<?
			echo $after_widget;
		endwhile;
		wp_reset_postdata();
		endif;
	}

}
register_widget( 'SFHIV_Page_Widget' );

?>