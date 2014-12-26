<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header('home'); ?>
	<header class="col-md-12 home">
	</header><!-- .col-md-12 home -->
	<form method="get" id="searchform-home" class="col-md-12" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="col-md-12" name="s" id="s" placeholder="<?php esc_attr_e( 'Search Pirate', 'odin' ); ?>" required />
		<div class="col-md-6 col-md-offset-2 col-xs-12">
			<?php
			$categories = get_categories('hide_empty=0');
			foreach ($categories as $category) {
				$option = '<input type="radio" name="category_name" value="'.$category->slug.'"/>'.$category->cat_name;
				echo $option;
			}
			?>
		</div><!-- col-md-6 col-md-offset-4 -->
		<div class="col-md-4 col-md-offset-4 col-xs-12">
			<input id="submit" type="submit" class="btn btn-default btn-lg btn-tpb col-md-12 pull-left" value="<?php esc_attr_e( 'Search', 'odin' ); ?>" />
		</div><!-- .col-md-6 col-md-offset-4 -->

	</form>

<?php
//get_sidebar();
get_footer();
