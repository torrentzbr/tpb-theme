<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="container">
		<div id="main" class="site-main row">
			<?php $header_image = get_header_image(); ?>
			<?php $header_style = ''; ?>
			<?php if(!empty($header_image)): ?>
			    <?php $header_style = 'url("'.esc_url($header_image).'") no-repeat scroll center center transparent;'; ?>
            <?php endif; ?>
	        <header class="col-md-12 home" style="<?php echo $header_style; ?>">
		        <?php get_template_part('content','social'); ?>
	        </header><!-- .col-md-12 home -->
			<div class="col-md-5 col-md-offset-4 col-xs-12" id="home-menu">
				<a href="#" class="active"><?php _e('Search','odin'); ?></a> |
				<a href="#" id="categories" data-toggle="modal" data-target="#categories-modal"><?php _e('Categories','odin'); ?></a>
				<?php if(!is_user_logged_in()): ?>
				   | <a href="<?php echo wp_login_url(); ?>"><?php _e('Create Account/Login','odin'); ?></a>
				<?php endif; ?>
				<?php if(is_user_logged_in()): ?>
				   | <a href="<?php echo admin_url('post-new.php'); ?>"><?php _e('Upload Torrent','odin'); ?></a>
				<?php endif; ?>
				<?php $count_posts = wp_count_posts(); ?>
				<?php echo ' | ' . $count_posts->publish . ' Torrents'; ?>
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
