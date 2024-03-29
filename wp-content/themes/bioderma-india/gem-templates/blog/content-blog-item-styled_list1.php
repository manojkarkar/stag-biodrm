<?php

	$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

	$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

	$thegem_categories = get_the_category();
	$thegem_categories_list = array();
	foreach($thegem_categories as $thegem_category) {
		$thegem_categories_list[] = '<a href="'.esc_url(get_category_link( $thegem_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thegem" ), $thegem_category->name ) ).'">'.$thegem_category->cat_name.'</a>';
	}

	$thegem_classes = array();

	if(is_sticky() && !is_paged()) {
		$thegem_classes = array_merge($thegem_classes, array('sticky', 'default-background'));
	}

	$thegem_link = get_permalink();
	if (!has_post_thumbnail())
		$thegem_classes[] = 'no-image';

	$thegem_classes[] = 'item-animations-not-inited';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?><?php echo (!empty($item_colors['additional_background_color']) ? ' style="background-color: '.esc_attr($item_colors['additional_background_color']).'"' : ''); ?>>
		<div class="item-post-container">
			<div class="post-item clearfix" style="<?php echo (!empty($item_colors['background_color']) ? 'background-color: '.esc_attr($item_colors['background_color']).';' : ''); ?><?php echo (!empty($item_colors['border_color']) ? 'border-color: '.esc_attr($item_colors['border_color']).';' : ''); ?>">
				<?php
					if(!is_single() && is_sticky()) {
						echo '<div class="sticky-label">&#xe61a;</div>';
					}
				?>
				<div class="post-info-wrap">
					<div class="post-info">
						<?php if(has_post_thumbnail()): ?>
							<div class="post-img"<?php echo (!empty($item_colors['border_color']) ? ' style="border-color: '.esc_attr($item_colors['border_color']).'"' : ''); ?>>
								<a href="<?php echo esc_url($thegem_link); ?>" class="default"><?php thegem_post_thumbnail('thegem-post-thumb-large', true, 'img-responsive', array('srcset' => array('1x' => 'thegem-post-thumb-small', '2x' => 'thegem-post-thumb-large'))); ?></a>
							</div>
						<?php else: ?>
							<div class="post-img"<?php echo (!empty($item_colors['border_color']) ? ' style="border-color: '.esc_attr($item_colors['border_color']).'"' : ''); ?>>
								<a href="<?php echo esc_url($thegem_link); ?>" class="default"><span class="dummy">&#xe640</span></a>
							</div>
						<?php endif; ?>
						<div class="post-date"<?php echo (!empty($item_colors['date_color']) ? ' style="color: '.esc_attr($item_colors['date_color']).'"' : ''); ?>><?php echo get_the_date('d F') ?></div>
						<div class="post-time"<?php echo (!empty($item_colors['time_color']) ? ' style="color: '.esc_attr($item_colors['time_color']).'"' : ''); ?>><?php echo get_the_date('H:i') ?></div>
					</div>
				</div>
				<svg class="wrap-style" style="<?php echo (!empty($item_colors['background_color']) ? 'fill: '.esc_attr($item_colors['background_color']).';' : ''); ?><?php echo (!empty($item_colors['border_color']) ? 'stroke: '.esc_attr($item_colors['border_color']).';' : ''); ?>">
					<use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use>
				</svg>
				<div class="post-text-wrap">
					<div class="post-title">
						<?php the_title('<'.(is_sticky() && !is_paged() ? 'h2' : 'h3').' class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).'"' : '').(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'><span class="light">', '</span></a></'.(is_sticky() && !is_paged() ? 'h2' : 'h3').'>'); ?>
					</div>
					<div class="post-content"<?php echo (!empty($item_colors['post_excerpt_color']) ? ' style="color: '.esc_attr($item_colors['post_excerpt_color']).'"' : ''); ?>>
						<div class="summary">
							<?php if ( !empty( $thegem_post_data['title_excerpt'] ) ): ?>
								<?php echo $thegem_post_data['title_excerpt']; ?>
							<?php else: ?>
								<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="post-misc">
						<div class="post-author">
							<span class="post-meta-author"><?php printf( esc_html__( "By %s", "thegem" ), get_the_author_link() ); echo esc_html__( " in", "thegem" ); ?></span>
							<?php if($thegem_categories): ?>
								<span class="post-meta-categories"><?php echo implode('<span class="sep"></span>', $thegem_categories_list); ?></span>
							<?php endif ?>
						</div>
						<div class="post-soc-info">
							<span class="post-comments">
								<?php if(comments_open()): ?>
									<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
								<?php endif; ?>
								<?php if(comments_open() && function_exists('zilla_likes')): ?><span class="sep"></span><?php endif; ?>
							</span>
							<span class="post-likes">
								<?php if( function_exists('zilla_likes') ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
							</span>
						</div>
						<div class="post-links">
							<div class="post-footer-sharing"><?php thegem_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? '' : 'tiny'), 'background_color' => (!empty($item_colors['sharing_button_color']) ? $item_colors['sharing_button_color'] : ''), 'text_color' => (!empty($item_colors['sharing_button_icon_color']) ? $item_colors['sharing_button_icon_color'] : '')), 1); ?><div class="sharing-popup"><?php thegem_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
							<div class="post-read-more"><?php thegem_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thegem'), 'size' => (is_sticky() && !is_paged() ? '' : 'tiny')), 1); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
