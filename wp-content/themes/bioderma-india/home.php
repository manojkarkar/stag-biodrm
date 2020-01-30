<?php

get_header();

$thegem_panel_classes = array('panel', 'row');

if(is_active_sidebar('page-sidebar')) {
	$thegem_panel_classes[] = 'panel-sidebar-position-right';
	$thegem_panel_classes[] = 'with-sidebar';
	$thegem_center_classes = 'col-lg-9 col-md-9 col-sm-12';
} else {
	$thegem_center_classes = 'col-xs-12';
}

?>

<div id="main-content" class="main-content main spacing-xxl">

<?php

if(thegem_get_option('home_content_enabled')) :

	thegem_home_content_builder();

else :

	wp_enqueue_style('thegem-blog');
	wp_enqueue_style('thegem-additional-blog');
	wp_enqueue_style('thegem-blog-timeline-new');
	wp_enqueue_script('thegem-scroll-monitor');
	wp_enqueue_script('thegem-items-animations');
	wp_enqueue_script('thegem-blog');
	wp_enqueue_script('thegem-gallery');
	//var_dump(get_post_type());die;

	// check if pagetype is post
	if(get_post_type() == 'post' &&  have_posts()){
		if(!is_singular()) { 
			echo '<div class="block-content">
					<div class="container">
						<main class="main spacing-xxl">';
			$cat_terms = get_terms(array('category'),
								   array('hide_empty'    => false,
		                        		'orderby'       => 'name',
		                        		'order'         => 'ASC',
		                        		'number'        => 6 //specify yours
                    				)
            					);
			
			if( $cat_terms ){
				foreach( $cat_terms as $term ){ 
					if($term->name != 'Uncategorized'){
						$tax = 'category';
						$args = array( 
				            'post_type' => 'post', // Or Custom Post Type, 
				            'order' => 'DESC', 
				            'orderby' => 'date',
				            'taxonomy' => $tax,
				            'term' => $term->slug, // Query posts for each term based on term slug
				        );
				        $category_link = get_category_link($term->term_id);

				        $query = new WP_Query( $args );
				        $posts = $query->get_posts(); 
				        if($posts){
				        	$seeAll = "";
				        	if(count($posts) > 1){
				        		$seeAll = 'See all in '.$term->name.'  >';
				        	}
							echo '<section class="wrap wrap--padding padding-top-large padding-bot-large">
								<div class="grid grid--spaced">
									<h1 class="h1-upper caps">'.$term->name.'</h1>
					               <a class="caps primary xsmall" href="'.esc_url( $category_link ).'"> '.$seeAll.'</a>
					            </div>
					            <div class="grid grid--posts padding-top">';
					            foreach ( $posts as $post ) {
					            	if (has_post_thumbnail( $post->ID ) ){
									  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
									}
					            	echo '<article class="g-item post-'.$post->ID.' post type-post status-'.$post->post_status.' format-standard hentry category-'.$term->slug.'">
						                  <a href="'.get_the_permalink().'">
						                     <figure class="lazyload-wrapper" data-ratio="40.63">
						                        <img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image img-full-height" data-src="'.$image[0].'" alt="" data-srcset="'.$image[0].' 300w, '.$image[0].' 768w, '.$image[0].' 1024w, '.$image[0].' 1600w" data-sizes="(max-width: 1600px) 100vw, 1600px">
						                        <div class="aspect-ratio" style="padding-top: 72%;"></div>
						                     </figure>
						                  </a>
						                  <header>
						                     <p class="byline author vcard small padding-v-small">
						                        <time class="updated primary" datetime="'.get_the_date('Y-m-d H:i:s').'">'.get_the_date('M d Y').'</time>
						                     </p>
						                     <h2 class="h1-upper medium"><a href="'.get_the_permalink().'">'.$post->post_title.'</a></h2>
						                  </header>
						               </article>';
					            }

				        	echo '</div></section>';
				        }
				    }
				}
			}
			echo '</main></div></div>';
		}
?>

<?php }else{ ?>
	<div class="block-content">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thegem_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thegem_center_classes); ?>">
				<?php
					if ( have_posts() ) {

						if(!is_singular()) { echo '<div class="blog blog-style-default item-animation-disabled"><main class="main spacing-xxl">
							 '; 
						}

						while ( have_posts() ) : the_post();

							get_template_part( 'content', 'blog-item' );

						endwhile;
						echo '</main>';
						if(!is_singular()) { thegem_pagination(); echo '</div>'; }

					} else {
						get_template_part( 'content', 'none' );
					}
				?>
				</div>
				<?php
					if(is_active_sidebar('page-sidebar')) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12" role="complementary">';
						get_sidebar('page');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
<?php } ?>
<?php endif; ?>

</div><!-- #main-content -->

<?php

get_footer();
