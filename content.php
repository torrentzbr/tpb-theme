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
<tbody>
	<tr class="tr-content">
		<td class="title-row col-md-10 pull-left">
			<div style="float: right; height: 16px;">
				<a href="<?php echo $magnet; ?>">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/magnet.png">
				</a>
			</div>
			<a href="<?php the_permalink(); ?>">
				<span><?php the_title(); ?></span>
			</a>
			<br>
			<em>
				<small><?php _e('Category: '); ?>
					<?php the_category( ', ' ); ?>
				</small>
			</em>
		</td>
		<td class="seeders-row">
			<?php echo get_post_meta(get_the_ID(),'torrent_info',true); ?>
		</td>
		<td class="date-row"><?php the_time(get_option('date_format')); ?></td>
		<td class="size-row">
			<?php if(!empty($magnet_array['amp;xl'])): ?>
			    <?php echo format_size_units($magnet_array['amp;xl']); ?>
			<?php endif; ?>
			<?php if(empty($magnet_array['amp;xl'])): ?>
			     <?php echo format_size_units(get_torrent_size(get_post_meta( get_the_ID(), 'torrent_file', true ))); ?>
		    <?php endif; ?>
		</td>
	</tr>
</tbody>
