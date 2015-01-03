<?php
/**
 * The template for displaying Category Results pages.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<div id="primary" class="col-md-12">
		<div id="content" class="site-content" role="main">
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( '<span class="search-query">Category %s</span>', 'odin' ), single_cat_title( '', false ) ); ?></h1>
				</header><!-- .page-header -->
				<?php
				// Post navigation.
				odin_paging_nav();
				?>
				<table id="post-views" class="col-md-12">
					<thead>
						<tr>
							<th class="title-row" id="serps_ctitle">Torrents</th>
							<th class="title-row">Seeders/Leechers</th>
							<th class="date-row" id="serps_ccreated_at"><a class="sort-link"><?php _e('Date','odin');?></a></th>
							<th class="size-row" id="serps_csize"><a class="sort-link"><?php _e('Size','odin'); ?></a></th>
						</tr>
					</thead>
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );

						endwhile; ?>


				</table>
				<?php
				// Post navigation.
				odin_paging_nav();
				?>
					<?php

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

				endif;
			?>

		</div><!-- #content -->
	</section><!-- #primary -->

</div><!-- #primary -->
<?php
get_footer();
