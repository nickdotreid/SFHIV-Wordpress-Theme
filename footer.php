	</div><!-- #main -->
	<footer id="bottom" class="footer">
		<?
		wp_nav_menu(array(
			'theme_location' => 'footer_menu',
			'container' => 'nav',
			'container_class' => 'footer',
			'depth'=>1,
			));
		?>
		<br class="clear" />
		<div class="footer">
			<section class="sfseal"></section>
			<section>
				<?dynamic_sidebar("Bottom Sidebar");?>
				<br class="clear" />
			</section>
			<section class="thin">
				<?_e("Last updated on");?>
				<?the_modified_date();?>
				<?_e("by");?>
				<?the_modified_author();?>
				<nav>
				<? if ( is_user_logged_in() ): ?>
				<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
				<?	else:	?>
				<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>
				<?	endif;	?>
				</nav>
			</section>
			<br class="clear" />
		</div>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>