<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'group' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
			<?	if(sfhiv_group_has_members()):	?>
			<?	$users = sfhiv_group_get_members();	?>
			<section id="members" class="list">
				<h2>Members</h2>
				<?
				$show_incomplete = false;
				foreach($users as $user):
					if(!p2p_get_meta( $user->p2p_id, 'incomplete', true ))
						include(locate_template('list-member.php'));
					else
						$show_incomplete = true;
				endforeach;
				if($show_incomplete):
				?>
				<h3>Members unable to complete term.</h3>
				<?	foreach($users as $user):
					if(p2p_get_meta( $user->p2p_id, 'incomplete', true ))	include(locate_template('list-member.php'));
				endforeach;
				endif;
				?>
				<br class="clear" />
			</section><!-- #members -->
			<?	endif;	?>
			<?	if(sfhiv_group_has_events()):	?>
			<?	$events = sfhiv_group_get_events();	?>
			<section id="events" class="list">
				<h2>Events</h2>
				<?
				while($events->have_posts()): $events->the_post();
					get_template_part('list','event');
				endwhile;
				wp_reset_postdata();
				?>
			</section><!-- #events -->
			<?	endif;	?>
			<?	if(sfhiv_group_has_services()):	?>
			<?	$services = sfhiv_group_get_services();	?>
			<section id="services" class="list">
				<h2>Services</h2>
				<?
				while($services->have_posts()): $services->the_post();
					get_template_part('list','service');
				endwhile;
				wp_reset_postdata();
				?>
			</section><!-- #services -->
			<?	endif;	?>
		</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>