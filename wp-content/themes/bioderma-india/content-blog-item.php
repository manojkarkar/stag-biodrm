<?php

$thegem_blog_style = isset($thegem_blog_style) ? $thegem_blog_style : 'default';

$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

$params = isset($params) ? $params : array(
	'hide_author' => 0,
	'hide_comments' => 0,
	'hide_date' => 0,
	'hide_likes' => 0,
);

if (is_archive() && (thegem_get_option('blog_hide_date_in_blog_cat'))) {
	$params =  array('hide_date' => 1);
}

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

$thegem_featured_content = thegem_get_post_featured_content(get_the_ID());
if(empty($thegem_featured_content)) {
	$thegem_classes[] = 'no-image';
}

$thegem_classes[] = 'item-animations-not-inited';

$image = "";

if (has_post_thumbnail( $post->ID ) ){
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
}

?>

	<article class="g-item post-<?php the_ID(); ?> post type-post status-<?php echo get_post_status( $post->ID ); ?> format-standard hentry category-<?php echo $thegem_categories[0]->slug; ?>">
		  <a href="<?php echo get_the_permalink(); ?>">
		     <figure class="lazyload-wrapper" data-ratio="40.63">
		        <img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image img-full-height" data-src="<?php echo $image[0]; ?>" alt="" data-srcset="<?php echo $image[0]; ?> 300w, <?php echo $image[0]; ?> 768w, <?php echo $image[0]; ?> 1024w, <?php echo $image[0]; ?> 1600w" data-sizes="(max-width: 1600px) 100vw, 1600px">
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
