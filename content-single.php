<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
$magnet = get_post_meta( get_the_ID(), 'magnet_link', true );
parse_str($magnet,$magnet_array);
?>
<article class="col-md-12" id="post-article">
	<header class="col-md-12">
		<h1><?php the_title(); ?></h1>
	</header>
	<div class="col-md-12" id="post-body">
		<div class="col-md-5" id="post-infos">
			<div class="col-md-12 infos">
				<div class="pull-left"><?php _e('Category:','odin'); ?></div><!-- .pull-left -->
				<div class="pull-right"><?php the_category( ', ' ); ?></div><!-- .pull-right -->
			</div><!-- .col-md-6 infos -->
			<div class="col-md-12 infos">
				<div class="pull-left"><?php _e('Size:','odin'); ?></div><!-- .pull-left -->
				<div class="pull-right"><?php echo format_size_units($magnet_array['amp;xl']); ?></div><!-- .pull-right -->
			</div><!-- .col-md-6 infos -->
			<div class="col-md-12 infos">
				<div class="pull-left"><?php _e('Hash:','odin'); ?></div><!-- .pull-left -->
				<div class="pull-right">
					<?php echo str_replace('urn:btih:', '', $magnet_array['magnet:?xt']); ?>
				</div><!-- .pull-right -->
			</div><!-- .col-md-6 infos -->
		</div><!-- #post-infos.col-md-6 col-md-offset-2 -->
		<div class="pull-right" id="post-thumb">
			<img src="http://i.imgur.com/yPvfqRv.jpg">
			<?php the_post_thumbnail( 'medium'); ?>
		</div><!-- #post-thumb.col-md-4 pull-right -->
		<div class="col-md-6 col-md-offset-4">
			<a id="magnet-href" href="<?php echo $magnet; ?>">
				<?php _e('Magnet Link','odin'); ?>
			</a>
		</div><!-- .col-md-12 -->
	</div><!-- #post-body.col-md-12 -->
</article><!-- #post-article.col-md-12 -->
