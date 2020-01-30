<?php

	$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

	$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

	$thegem_categories = get_the_category();
	$thegem_categories_list = array();
	foreach($thegem_categories as $thegem_category) {
		$thegem_categories_list[] = '<a href="'.esc_url(get_category_link( $thegem_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thegem" ), $thegem_category->name ) ).'">'.$thegem_category->cat_name.'</a>';
	}

	$thegem_classes = array();
	$thegem_sources = array();
	$thegem_featured_content = '';
	$has_content_gallery = get_post_format(get_the_ID()) == 'gallery';

	if(is_sticky() && !is_paged()) {
		$thegem_classes = array_merge($thegem_classes, array('sticky'));
		$thegem_featured_content = thegem_get_post_featured_content(get_the_ID(), 'thegem-blog-masonry-sticky');
	} else {
		$thegem_post_gallery_size = 'thegem-blog-masonry';
		if ($has_content_gallery) {
			if ($blog_style == '100%') {
				$thegem_post_gallery_size = 'thegem-blog-masonry-100';
			} elseif ($blog_style == '2x') {
				$thegem_post_gallery_size = 'thegem-blog-masonry-2x';
			} elseif ($blog_style == '3x') {
				$thegem_post_gallery_size = 'thegem-blog-masonry-3x';
			} elseif ($blog_style == '4x') {
				$thegem_post_gallery_size = 'thegem-blog-masonry-4x';
			}
		}

		if (has_post_thumbnail() && !$has_content_gallery) {
			if ($blog_style == '100%') {
				$thegem_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thegem-blog-masonry', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100-medium', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100-small', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100', '2x' => 'thegem-blog-masonry'))
				);
			} elseif ($blog_style == '2x') {
				$thegem_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thegem-blog-masonry', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100-medium', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100', '2x' => 'thegem-blog-masonry'))
				);
			} elseif ($blog_style == '3x') {
				$thegem_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thegem-blog-masonry', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100-medium', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100', '2x' => 'thegem-blog-masonry'))
				);
			} elseif ($blog_style == '4x') {
				$thegem_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thegem-blog-masonry', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-blog-masonry-100-medium', '2x' => 'thegem-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-blog-masonry-4x', '2x' => 'thegem-blog-masonry'))
				);
			}
		}
		$thegem_featured_content = thegem_get_post_featured_content(get_the_ID(), $has_content_gallery ? $thegem_post_gallery_size : 'thegem-blog-masonry', false, $thegem_sources);
	}

	if(empty($thegem_featured_content)) {
		$thegem_classes[] = 'no-image';
	}

	if ($blog_style == '2x') {
		if (is_sticky() && !is_paged())
			$thegem_classes = array_merge($thegem_classes, array('col-lg-12', 'col-md-12', 'col-sm-12', 'col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12'));
	}

	if ($blog_style == '3x') {
		if (is_sticky() && !is_paged())
			$thegem_classes = array_merge($thegem_classes, array('col-lg-8', 'col-md-8', 'col-sm-6', 'col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
	}

	if ($blog_style == '4x' || $blog_style == '100%') {
		if (is_sticky() && !is_paged())
			$thegem_classes = array_merge($thegem_classes, array('col-lg-6', 'col-md-6', 'col-sm-12', 'col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-3', 'col-md-3', 'col-sm-6', 'col-xs-6'));
	}

	$thegem_classes[] = 'item-animations-not-inited';

	if (!empty($item_colors['masonsy_background_transparent'])) {
		$thegem_classes = array_merge($thegem_classes, array('item-transparent-background'));
		$item_colors['background_color'] = 'transparent';
	}
	$image = "";

	if (has_post_thumbnail( $post->ID ) ){
	  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
	}

	global $wp_query;
	//echo "<pre>";print_r($thegem_post_data);die;

	?>

<!-- <article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?>>
	<?php if (isset($params['effects_enabled']) && $params['effects_enabled']): ?>
		<div class="item-lazy-scroll-wrap">
	<?php endif; ?>

	<?php if(get_post_format() == 'quote' && $thegem_featured_content) : ?>
		<?php echo $thegem_featured_content; ?>
	<?php else : ?>
		<?php
			if(!is_single() && is_sticky() && !is_paged()) {
				echo '<div class="sticky-label">&#xe61a;</div>';
			}
		?>
		<?php if($thegem_featured_content): ?>
			<div class="post-image"><?php echo $thegem_featured_content; ?></div>
		<?php endif; ?>
		<div class="description"<?php echo (!empty($item_colors['background_color']) ? ' style="background-color: '.esc_attr($item_colors['background_color']).'"' : ''); ?>>
			<div class="post-meta-conteiner">
				<?php if(!$params['hide_author']) : ?><span class="post-meta-author"><?php printf( esc_html__( "By %s", "thegem" ), get_the_author_link() ) ?></span><?php endif; ?>

				<div class="post-meta-right">
					<?php if(comments_open() && !$params['hide_comments']) : ?>
						<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
					<?php endif; ?>
					<?php if( function_exists('zilla_likes') && !$params['hide_likes'] ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>

				</div>
			</div>
			<div class="post-title">
				<?php the_title('<div class="entry-title title-h4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).'"' : '').(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'>'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'<span class="light">', '</span></a></div>'); ?>
			</div>

			<div class="post-text"<?php echo (!empty($item_colors['post_excerpt_color']) ? ' style="color: '.esc_attr($item_colors['post_excerpt_color']).'"' : ''); ?>>
				<div class="summary">
					<?php if ( !empty( $thegem_post_data['title_excerpt'] ) ): ?>
						<?php echo $thegem_post_data['title_excerpt']; ?>
					<?php else: ?>
						<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="info clearfix">

				<div class="post-footer-sharing"><?php thegem_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny'), 'background_color' => (!empty($item_colors['sharing_button_color']) ? $item_colors['sharing_button_color'] : ''), 'text_color' => (!empty($item_colors['sharing_button_icon_color']) ? $item_colors['sharing_button_icon_color'] : '')), 1); ?><div class="sharing-popup"><?php thegem_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>

				<div class="post-read-more"><?php thegem_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thegem'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php if (isset($params['effects_enabled']) && $params['effects_enabled']): ?>
		</div>
	<?php endif; ?>
</article> -->
	<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>
<!-- <article class="products-list__item " data-href="<?php echo esc_url(get_permalink()); ?>">
    <div class="products-list__front">
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <div class="labels labels--absolute">
                <span class="label label-sizes">3 sizes</span>      
            </div>
            <figure class="lazyload-wrapper">
        		<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image products-list__thumb lazyloaded" data-src="<?php echo $image[0]; ?>" alt="" data-srcset="<?php echo $image[0]; ?> 300w, <?php echo $image[0]; ?> 1024w" data-sizes="(max-width:1500px) 100vw, 1500px" sizes="(max-width:1500px) 100vw, 1500px" srcset="<?php echo $image[0]; ?> 300w, <?php echo $image[0]; ?> 1024w" src="<?php echo $image[0]; ?>">
        
        		<div class="aspect-ratio" style="padding-top: 120%"></div>
      		</figure>
      		<h1 class="products-list__title accent-medium"><?php echo the_title(); ?></h1>
			<span class="products-list__starting primary-medium">Starting at <span class="price">5.90</span></span>
        </a>
    </div>
    <div class="products-list__back">
	    <div class="products-list__grid grid grid--column grid--spaced">
	      	<div class="g-item">
	        	<p class="products-list__title accent-medium"><?php echo the_title(); ?></p>
	                <span class="products-list__sizes primary">3.33oz, 8.33oz or 16.7oz</span>
	        </div>
	      	<div class="products-list__desc g-item small medium">
	        	<p>A cleansing and make-up removing water that respects the fragility of sensitive skin</p>
	      	</div>
	      	<div class="g-item">
	            <span class="products-list__starting primary-medium">Starting at <span class="price">5.90</span></span>
	            <a class="btn btn--cart" href="<?php echo esc_url(get_permalink()); ?>">View more</a>
			</div>
	    </div>
  	</div>
</article> -->

<?php
	global $wp_query;
	$image = "";

	if (has_post_thumbnail( $post->ID ) ){
	  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
	}
	//echo "<pre>";print_r($wp_query->posts);die; 
	if(get_post_type() == 'post'){
?>
<article class="g-item post-<?php the_ID(); ?> page type-page status-<?php echo get_post_status( $post->ID ); ?> hentry">
    <a href="<?php echo get_the_permalink(); ?>">
      	<figure class="lazyload-wrapper" data-ratio="40.63">
            <img class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-full-width lazyloaded" data-src="<?php echo $image[0]; ?>" alt="" data-srcset="<?php echo $image[0]; ?> 300w, <?php echo $image[0]; ?> 768w, <?php echo $image[0]; ?> 1024w, <?php echo $image[0]; ?> 1600w" data-sizes="(max-width: 1600px) 100vw, 1600px" sizes="(max-width: 1600px) 100vw, 1600px" srcset="<?php echo $image[0]; ?> 300w, <?php echo $image[0]; ?> 768w, <?php echo $image[0]; ?> 1024w, <?php echo $image[0]; ?> 1600w" src="<?php echo $image[0]; ?>">
        	<div class="aspect-ratio" style="padding-top: 72%;"></div>
      	</figure>
    </a>
    <header>
      <p class="byline author vcard small padding-v-small">
        <time class="updated primary" datetime="<?php echo get_the_date('Y-m-d H:i:s'); ?>"><?php echo get_the_date('M d Y') ?></time>
      </p>
      <h2 class="h1-upper medium"><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
    </header>
</article>
<?php } ?>
