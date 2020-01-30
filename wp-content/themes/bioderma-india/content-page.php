<?php
/**
 * The template used for displaying page content on home page
 */

$thegem_page_data = array(
	'title' => thegem_get_sanitize_page_title_data(get_the_ID()),
	'effects' => thegem_get_sanitize_page_effects_data(get_the_ID()),
	'slideshow' => thegem_get_sanitize_page_slideshow_data(get_the_ID()),
	'sidebar' => thegem_get_sanitize_page_sidebar_data(get_the_ID())
);
if ($thegem_page_data['effects']['effects_page_scroller']) {
	wp_enqueue_script('thegem-page-scroller');
	$thegem_page_data['effects']['effects_no_bottom_margin'] = true;
	$thegem_page_data['effects']['effects_no_top_margin'] = true;
}
$thegem_no_margins_block = '';
if ($thegem_page_data['effects']['effects_no_bottom_margin']) {
	$thegem_no_margins_block .= ' no-bottom-margin';
}
if ($thegem_page_data['effects']['effects_no_top_margin']) {
	$thegem_no_margins_block .= ' no-top-margin';
}

$thegem_panel_classes = array('panel', 'row');
$thegem_center_classes = 'panel-center';
$thegem_sidebar_classes = '';
if (is_active_sidebar('page-sidebar') && $thegem_page_data['sidebar']['sidebar_position']) {
	$thegem_panel_classes[] = 'panel-sidebar-position-' . $thegem_page_data['sidebar']['sidebar_position'];
	$thegem_panel_classes[] = 'with-sidebar';
	$thegem_center_classes .= ' col-lg-9 col-md-9 col-sm-12';
	if ($thegem_page_data['sidebar']['sidebar_position'] == 'left') {
		$thegem_center_classes .= ' col-md-push-3 col-sm-push-0';
		$thegem_sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
	}
} else {
	$thegem_center_classes .= ' col-xs-12';
}
if ($thegem_page_data['sidebar']['sidebar_sticky']) {
	$thegem_panel_classes[] = 'panel-sidebar-sticky';
	wp_enqueue_script('thegem-sticky');
}
$thegem_pf_data = array();
if (get_post_type() == 'thegem_pf_item') {
	$thegem_pf_data = thegem_get_sanitize_pf_item_data(get_the_ID());
}
if ($thegem_page_data['slideshow']['slideshow_type']) {
	thegem_slideshow_block(array('slideshow_type' => $thegem_page_data['slideshow']['slideshow_type'], 'slideshow' => $thegem_page_data['slideshow']['slideshow_slideshow'], 'lslider' => $thegem_page_data['slideshow']['slideshow_layerslider'], 'slider' => $thegem_page_data['slideshow']['slideshow_revslider']));
}
$image = "";
if (has_post_thumbnail( get_the_ID() ) ){
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); 
}

$thegem_categories = get_the_category();
$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 1, 'post__not_in' => array($post->ID) ) );

if(get_post_type() == 'post'){ ?>
         <article class="post-<?php the_ID(); ?> post type-post status-<?php echo get_post_status( $post->ID ); ?> format-standard hentry category-<?php echo $thegem_categories[0]->slug; ?>">
            <header>
               <figure class="lazyload-wrapper lazyload-wrapper--banner">
                  <img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo $image[0]; ?>" data-src="<?php echo $image[0]; ?>" alt="Bioderma India" >
                  <div class="aspect-ratio" style="padding-top: 35%"></div>
               </figure>
            </header>
            <div class="article wrap">
               <div class="wrap-medium">
                  <div class="article-margin">
                     <div class="article__header">
                        <div class="article-padding padding-bot-huge">
                           <div class="article__text">
                              <div class="categories spacing-bot-medium">
                                 <span class="caps bold primary"><?php echo $thegem_categories[0]->cat_name; ?></span>
                              </div>
                              <h1 class="h1 accent spacing-bot"><?php echo the_title(); ?></h1>
                              <p class="byline author vcard small padding-v-small">
                                 <time class="updated primary" datetime="<?php echo get_the_date('Y-m-d H:i:s') ?>"><?php echo get_the_date('M d Y') ?></time>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                  <?php echo the_content(); ?>
               </div>
            </div>
         </article>
		<footer class="wrap-medium article-padding article__footer">
			<div class="tags padding-bot-small">
				<?php 
					$tags = get_the_tags();
					if(!empty($tags)){
						foreach ($tags as $tag) {
						  echo '<a class="tag primary-bold caps" href="'.get_tag_link($tag->term_id).'">#'.$tag->name.' </a>';
						}
					}
				?>
			</div>
			<div class="wrap grid grid--center grid--wrap padding-top-medium">
				<p class="g-item g-item--full caps xsmall accent bold">Share this article</p>
				<a class="btn-circle" target="_blank" href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink())); ?>"><svg width="24" height="30"><use xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-facebook"></use></svg></a>

				<a class="btn-circle js-share-twitter" href="https://twitter.com/intent/tweet?text=<?php echo the_title(); ?>%20<?php echo get_the_permalink(); ?>"><svg width="28" height="24"><use xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-twitter"></use></svg></a>
				<a class="btn-circle" href="mailto:?subject=<?php echo the_title(); ?>&amp;body=<?php echo get_the_permalink(); ?>" target="_blank"><svg width="24" height="30"><use xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-email"></use></svg></a>
			</div>
		</footer>
		<?php if($related[0]->ID > 0){ 
				//$shortDesc = substr($related[0]->post_content,50).' ...';
				$shortDesc = "";
				if($related[0]->post_excerpt != ""){
					$shortDesc = $related[0]->post_excerpt;
				}
				$post_image = "";
				$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $related[0]->ID ), 'single-post-thumbnail' ); 
				//echo "<pre>";print_r($post_image);die;
			?>
			<section>
				<div class="articles-slideshow ">
				    <div class="">
				        <article class="">
				          <div class="wrap grid grid--article-slideshow grid--spaced">
				            <div class="g-item">
				              <figure class="lazyload-wrapper">
				                <img class="attachment-post-thumbnail size-post-thumbnail wp-post-image article-slideshow__big-media lazyloaded" src="<?php echo $post_image[0]; ?>" data-src="<?php echo $post_image[0]; ?>" alt="<?php echo the_title(); ?>" data-srcset="<?php echo $post_image[0]; ?> 300w, <?php echo $post_image[0]; ?> 768w, <?php echo $post_image[0]; ?> 1024w, <?php echo $post_image[0]; ?> 1600w" data-sizes="(max-width: 1600px) 100vw, 1600px" sizes="(max-width: 1600px) 100vw, 1600px" srcset="<?php echo $post_image[0]; ?> 300w, <?php echo $post_image[0]; ?> 768w, <?php echo $post_image[0]; ?> 1024w, <?php echo $post_image[0]; ?> 1600w" src="<?php echo $post_image[0]; ?>">
				                
				                <div class="aspect-ratio"></div>
				              </figure>
				            </div>
				            <div class="g-item article-slideshow__content grid grid--center grid--column">
				              	<div>
					                <span class="article-slideshow__categories categories">
					                    <span class="category primary-bold caps"><?php echo $thegem_categories[0]->name; ?></span>
					                </span>
					                <h1 class="h1 accent article-slideshow__title"><?php echo $related[0]->post_title; ?></h1>
					                <p class="article-slideshow__excerpt"><?php echo $shortDesc; ?></p>
					                <a class="btn btn--outline" href="<?php echo get_page_uri($related[0]->ID); ?>">Read more</a>
				                </div>
				            </div>
				          </div>
				        </article>
				    </div>
				</div>
			</section>
<?php } }else if(get_post_type() == 'thegem_news'){ 
		$post_id = get_the_ID();
		if (has_post_thumbnail( $post_id ) ){
		  	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); 
		}
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo content_url(); ?>/plugins/js_composer/assets/css/js_composer.min.css">
	<main class="main spacing-xxl">
		<article class="post-<?php echo $post_id; ?> page type-<?php echo get_post_type(); ?> status-<?php echo get_post_status();?> hentry">
			<header>
               <figure class="lazyload-wrapper lazyload-wrapper--banner">
                  <img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image" data-src="<?php echo $image[0]; ?>" alt="<?php echo the_title(); ?>" >
                  <div class="aspect-ratio" style="padding-top: 35%"></div>
               </figure>
            </header>
            <div class="article wrap">
               <div class="wrap-medium">
                  <div class="article-margin">
                     <div class="article__header">
                        <div class="article-padding padding-bot-huge">
                           <div class="article__text">
                              <h1 class="h1 accent spacing-bot"><?php echo the_title(); ?></h1>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="wrap-medium article__text article-padding spacing-bot-huge">
               	<?php echo the_content(); ?>
               </div>
            </div>
		</article>
	</main>
<?php }else{

?>

<div class="block-content<?php echo esc_attr($thegem_no_margins_block); ?>">
    <div class="container<?php if (get_post_type() == 'thegem_pf_item' && $thegem_pf_data['fullwidth']) {
		echo '-fullwidth';
	} ?>">
        <div class="<?php echo esc_attr(implode(' ', $thegem_panel_classes)); ?>">

            <div class="<?php echo esc_attr($thegem_center_classes); ?>">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="entry-content post-content">
						<?php
						if ((get_post_type() == 'post' || get_post_type() == 'thegem_news') && $thegem_featured_content = thegem_get_post_featured_content(get_the_ID(), 'thegem-blog-default', true)) {
							echo '<div class="blog-post-image centered-box">';
							echo $thegem_featured_content;
							echo '</div>';
						}
						?>

						<?php if (get_post_type() == 'post'):
							$thegem_categories = get_the_category();
							$thegem_categories_list = array();
							foreach ($thegem_categories as $thegem_category) {
								$thegem_categories_list[] = '<a href="' . esc_url(get_category_link($thegem_category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", "thegem"), $thegem_category->name)) . '">' . $thegem_category->cat_name . '</a>';
							}
							$print_block = false;
							ob_start();
							?>
							<?php
							$post_block_print = ob_get_clean();
							if ($print_block) {
								echo $post_block_print;
							}
						endif;
						?>

						<?php if (get_post_type() == 'thegem_pf_item') :
							$thegem_categories = get_the_terms(get_the_ID(), 'thegem_portfolios');
							$thegem_categories_list = array();
							if ($thegem_categories) {
								foreach ($thegem_categories as $thegem_category) {
									$thegem_categories_list[] = '<span class="gem-date-color">' . $thegem_category->name . '</span>';
								}
							}
							?>

                            <div class="post-meta date-color">
                                <div class="entry-meta single-post-meta clearfix gem-post-date">
                                    <div class="post-meta-right">
										<?php if (!thegem_get_option('portfolio_hide_top_navigation')): ?>
                                            <span class="post-meta-navigation">
												<?php previous_post_link('<span class="post-meta-navigation-prev" title="' . esc_attr__('Previous post', 'thegem') . '">%link</span>', '&#xe603;', false, '', 'thegem_portfolios'); ?>
												<?php if ($thegem_pf_data['back_url']) : ?><span
                                                        class="post-meta-category-link"><a
                                                            href="<?php echo esc_url($thegem_pf_data['back_url']); ?>">&#xe66d;</a>
                                                    </span><?php endif; ?>
												<?php next_post_link('<span class="post-meta-navigation-next" title="' . esc_attr__('Next post', 'thegem') . '">%link</span>', '&#xe601;', false, '', 'thegem_portfolios'); ?>
											</span>
										<?php endif ?>
                                    </div>
                                    <div class="post-meta-left">
										<?php if (!thegem_get_option('portfolio_hide_date')): ?>
                                            <span class="post-meta-date"><?php the_date(); ?></span>
										<?php endif ?>
										<?php if ($thegem_categories && !thegem_get_option('portfolio_hide_sets')): ?>
											<?php if (!thegem_get_option('portfolio_hide_date')): ?><span
                                                    class="sep"></span> <?php endif ?><span
                                                    class="post-meta-categories"><?php echo implode(' <span class="sep"></span> ', $thegem_categories_list); ?></span>
										<?php endif ?>
										<?php if (function_exists('zilla_likes') && !thegem_get_option('portfolio_hide_likes')) {
											echo '<span class="sep"></span> <span class="post-meta-likes">';
											zilla_likes();
											echo '</span>';
										} ?>
                                    </div>
                                </div><!-- .entry-meta -->
                            </div>
						<?php endif ?>
						<?php

						?>
						<?php
						if(is_front_page()){
							if (has_post_thumbnail( $post->ID ) ):
						  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						   $page_title = thegem_get_sanitize_page_title_data(get_the_ID());
						   $bannerTitle="";
						   if(!empty($page_title) && $page_title['title_excerpt']!=""){
						   	$bannerTitle=$page_title['title_excerpt'];
						   }
							echo' <section class="banner ">
							<h1 class="h1 caps banner__title grid grid--center"  >'.$bannerTitle.'</h1><figure class="lazyload-wrapper">
								<img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image lazyloaded" src="'.$image[0].'" data-src="'.$image[0].'" alt="Bioderma India">
							        <div class="h1 aspect-ratio"></div>
							      </figure>
							    </section>';
							    endif;
						}
						the_content();
						wp_link_pages(array(
							'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'thegem') . '</span>',
							'after' => '</div>',
							'link_before' => '<span>',
							'link_after' => '</span>',
						));
						?>
                    </div><!-- .entry-content -->

					<?php if (get_post_type() == 'post') {
						if (!thegem_get_option('blog_hide_tags')) {
							echo get_the_tag_list('<div class="post-tags-list date-color">', '', '</div>');
						}
						if (!thegem_get_option('blog_hide_socials')) {
							thegem_socials_sharing();
						}
					} ?>

					<?php if (get_post_type() == 'post') {
						thegem_author_info(get_the_ID(), true);
					} ?>

					<?php if (get_post_type() == 'post' && !thegem_get_option('blog_hide_realted')) {
						thegem_related_posts();
					} ?>

					<?php if (get_post_type() == 'thegem_pf_item') : ?>
                        <div class="portfolio-item-page-bottom clearfix">
							<?php if (!thegem_get_option('portfolio_hide_socials')) : ?>
                                <div class="<?php if (!thegem_get_option('socials_colors_posts')) : ?>socials-colored <?php endif; ?>socials-rounded<?php if (get_post_type() == 'thegem_pf_item' && $thegem_pf_data['fullwidth']) {
									echo ' centered-box';
								} ?>">
									<?php thegem_socials_sharing(); ?>
                                </div>
							<?php endif; ?>
							<?php if ($thegem_pf_data['project_link']) {
								thegem_button(array('size' => 'tiny', 'href' => $thegem_pf_data['project_link'], 'position' => $thegem_pf_data['fullwidth'] ? 'center' : 'right', 'text' => ($thegem_pf_data['project_text'] ? $thegem_pf_data['project_text'] : __('Go to project', 'thegem')), 'extra_class' => 'project-button'), 1);
							} ?>
                        </div>
						<?php if (!thegem_get_option('portfolio_hide_bottom_navigation')): ?>
                            <div class="block-divider gem-default-divider"></div>
                            <div class="block-navigation<?php if (get_post_type() == 'thegem_pf_item' && $thegem_pf_data['fullwidth']) {
								echo ' centered-box';
							} ?>">
								<?php if ($thegem_nav_post = get_previous_post(true, '', 'thegem_portfolios')) : ?>
									<?php thegem_button(array(
										'text' => __('Prev', 'thegem'),
										'href' => get_permalink($thegem_nav_post->ID),
										'style' => 'outline',
										'size' => 'tiny',
										'position' => $thegem_pf_data['fullwidth'] ? 'inline' : 'left',
										'icon' => 'prev',
										'border_color' => thegem_get_option('button_background_hover_color'),
										'text_color' => thegem_get_option('button_background_hover_color'),
										'hover_background_color' => thegem_get_option('button_background_hover_color'),
										'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
										'extra_class' => 'block-portfolio-navigation-prev'
									), 1); ?>
								<?php endif; ?>
								<?php if ($thegem_nav_post = get_next_post(true, '', 'thegem_portfolios')) : ?>
									<?php thegem_button(array(
										'text' => __('Next', 'thegem'),
										'href' => get_permalink($thegem_nav_post->ID),
										'style' => 'outline',
										'size' => 'tiny',
										'position' => $thegem_pf_data['fullwidth'] ? 'inline' : 'right',
										'icon' => 'next',
										'icon_position' => 'right',
										'border_color' => thegem_get_option('button_background_hover_color'),
										'text_color' => thegem_get_option('button_background_hover_color'),
										'hover_background_color' => thegem_get_option('button_background_hover_color'),
										'hover_text_color' => thegem_get_option('button_outline_text_hover_color'),
										'extra_class' => 'block-portfolio-navigation-next'
									), 1); ?>
								<?php endif; ?>
                            </div>
						<?php endif; ?>
					<?php endif; ?>

					<?php
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
					?>

                </article><!-- #post-## -->

            </div>

			<?php
			if (is_active_sidebar('page-sidebar') && $thegem_page_data['sidebar']['sidebar_position']) {
				echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12' . esc_attr($thegem_sidebar_classes) . '" role="complementary">';
				get_sidebar('page');
				echo '</div><!-- .sidebar -->';
			}
			?>

        </div>

    </div>
</div><!-- .block-content -->
<?php } ?>