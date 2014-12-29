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
	<div class="col-md-4 col-md-offset-4 col-xs-12" id="home-menu">
		<a href="#" class="active"><?php _e('Search','odin'); ?></a> |
		<a href="#" id="categories" data-toggle="modal" data-target="#categories-modal"><?php _e('Categories','odin'); ?></a>
		<?php if(!is_user_logged_in()): ?>
		    | <a href="<?php echo wp_login_url(); ?>"><?php _e('Create Account/Login','odin'); ?></a>
		<?php endif; ?>
		<?php if(is_user_logged_in()): ?>
		    | <a href="<?php echo admin_url('post-new.php'); ?>"><?php _e('Upload Torrent','odin'); ?></a>
		<?php endif; ?>
	</div><!-- .col-md-6 col-md-offset-4 -->
	<form method="get" id="searchform-home" class="col-md-12" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="col-md-12" name="s" id="s" placeholder="<?php esc_attr_e( 'Search Pirate', 'odin' ); ?>" required />
		<div class="col-md-11 col-md-offset-1 col-xs-12">
			<?php
			$categories = get_categories('hide_empty=0');
			foreach ($categories as $category) {
				$option = '<input type="radio" name="category_name" value="'.$category->slug.'"/><label>'.$category->cat_name.'</label>';
				echo $option;
			}
			?>
		</div><!-- col-md-6 col-md-offset-4 -->
		<div class="col-md-4 col-md-offset-4 col-xs-12">
			<input id="submit" type="submit" class="btn btn-default btn-lg btn-tpb col-md-12 pull-left" value="<?php esc_attr_e( 'Search', 'odin' ); ?>" />
		</div><!-- .col-md-6 col-md-offset-4 -->
	</form>
	<!-- Modal -->
	<div class="modal fade" id="categories-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"><?php _e('Categories','odin'); ?></h4>
				</div>
			<div class="modal-body">
			<?php $categories = get_categories('hide_empty=0'); ?>
			<?php foreach ($categories as $category): ?>
			    <a href="<?php echo get_category_link($category->cat_ID); ?>">
			    	<?php echo $category->name . ' (' .$category->category_count. ')'; ?>
			    </a>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<?php
//get_sidebar();
get_footer();
