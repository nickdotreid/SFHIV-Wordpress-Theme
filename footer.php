		<div class="clear"></div>
	</div><!-- #main -->
	<footer id="bottom" class="container pretty-top">
		<?
		wp_nav_menu(array(
			'theme_location' => 'footer_menu',
			'container' => 'nav',
			'container_class' => 'footer first menu-justified',
			'depth'=>1,
			));
		?>
		<br class="clear" />
		<div class="footer sfseal">
			<?dynamic_sidebar("Bottom Sidebar");?>
		</div>
		<?
		if ( is_user_logged_in() ){
			wp_nav_menu(array(
				'theme_location' => 'admin_menu',
				'container' => 'nav',
				'container_class' => 'footer first menu-justified',
				'depth'=>1,
				));			
		}
		?>
		<br class="clear" />
		<div class="footer small">
			<div style="float:left;">
			<?_e("Last updated on");?>
			<?the_modified_date();?>
			<?_e("by");?> <?the_modified_author();?>
			</div>
			<div style="float:right;">
				Icons courtesy of the <a href="http://thenounproject.com">Noun Project</a>
			</div>
			<div class="clear"></div>
			<nav>
			<? if ( is_user_logged_in() ): ?>
			<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
			<?	else:	?>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>
			<?	endif;	?>
			</nav>
		</div>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>