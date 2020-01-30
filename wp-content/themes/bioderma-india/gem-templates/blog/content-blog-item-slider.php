<?php

	$thegem_slider_style = isset($thegem_slider_style) ? $thegem_slider_style : 'fullwidth';

	$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

	$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

	$params = isset($params) ? $params : array(
		'hide_author' => 0,
		'hide_comments' => 0,
		'hide_date' => 0,
	);

	$thegem_classes = array();

	if(is_sticky() && !is_paged()) {
		$thegem_classes = array_merge($thegem_classes, array('sticky'));
	}

	if(has_post_thumbnail()) {
		$thegem_classes[] = 'no-image';
	}

	$thegem_classes[] = 'clearfix';
	$cat_name = $post_image = "";
	$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); 
	$cat_name = get_the_category( get_the_ID() )[0]->name;
?>
<article id="post-<?php the_ID(); ?>" class="swiper-slide swiper-slide-next" style="width: 1364px;">
                        <div class="wrap grid grid--article-slideshow grid--spaced">
                            <div class="g-item">
                                     <figure class="lazyload-wrapper">
                                    <img class="attachment-post-thumbnail size-post-thumbnail wp-post-image article-slideshow__big-media lazyloaded" data-src="<?php echo $post_image[0]; ?>" alt="<?php echo the_title();?>" data-srcset="<?php echo $post_image[0]; ?> 300w, <?php echo $post_image[0]; ?> 768w, <?php echo $post_image[0]; ?> 1024w, <?php echo $post_image[0]; ?> 1600w" data-sizes="(max-width: 1600px) 100vw, 1600px" sizes="(max-width: 1600px) 100vw, 1600px" srcset="<?php echo $post_image[0]; ?> 300w, <?php echo $post_image[0]; ?> 768w, <?php echo $post_image[0]; ?> 1024w, <?php echo $post_image[0]; ?> 1600w" src="<?php echo $post_image[0]; ?>">

                                    <div class="aspect-ratio"></div>
                                </figure>
                            </div>
                            <div class="g-item article-slideshow__content grid grid--center grid--column">
                                <div>
                                    <span class="article-slideshow__categories categories">
                                    <span class="category primary-bold caps"><?php echo $cat_name;?></span>
                                    </span>
                                    <h1 class="h1 accent article-slideshow__title"><?php echo the_title();?></h1>
                                    <p class="article-slideshow__excerpt"><?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?></p>
                                    <a class="btn btn--outline" href="<?php echo esc_url(get_permalink()); ?>">Read more</a>
                                </div>
                            </div>
                        </div>
</article>