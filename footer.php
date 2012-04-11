	</div><!-- #main -->
	<footer id="bottom" class="footer">
		<section class="left">
			<?_e("Last updated on");?>
			<?the_modified_date();?>
			<?_e("by");?>
			<?the_modified_author();?>
		</section>
		<section class="right">
			<nav>
			<? if ( is_user_logged_in() ): ?>
			<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
			<?	else:	?>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>
			<?	endif;	?>
			</nav>
		</section>
	</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>