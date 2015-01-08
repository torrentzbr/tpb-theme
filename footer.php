<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- #main -->

		<footer id="footer" role="contentinfo">
		    <nav class="col-md-8 col-md-offset-3 col-xs-12">
		    	<?php
		    	wp_nav_menu(
		    		array(
		    			'theme_location' => 'main-menu',
		    			'depth' => 1,
		    			'container' => false,
		    			'menu_class' => 'nav navbar-nav',
		    			'fallback_cb' => 'Odin_Bootstrap_Nav_Walker::fallback',
		    			'walker' => new Odin_Bootstrap_Nav_Walker()
		    			)
		    	);
		    	?>
		    </nav><!-- .col-md-6 col-md-offset-4 -->
		</footer><!-- #footer -->
	</div><!-- .container -->

	<?php wp_footer(); ?>
</body>
</html>
