<?php

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	$post_detail = array();
	$post_detail = get_post();
	if($post_detail->post_name == 'laboratory'){ 
		$params = array_merge(array('count' => '', 'news_set' => ''), $params);
		$args = array(
			'post_type' => 'thegem_news',
			'posts_per_page' => $params['count'],
		);
		if ($params['news_set'] != '') {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'thegem_news_sets',
					'field' => 'slug',
					'terms' => $params['news_set']
				)
			);
		}
		$loop = new WP_Query($args);
		//echo "<pre>";print_r($loop);die;
		if (has_post_thumbnail( $post_detail->ID ) ){
		  	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_detail->ID ), 'single-post-thumbnail' ); 
		}
		?>

		<style type="text/css">
			.lab_title{ font-size: 25px;margin-bottom: 20px; }
			p.article-slideshow__excerpt{ line-height: 1.45em; }
			hr.seperator-line{display: block;height: 1px;border: 0;border-top: 1px solid #cccccc8c;margin: 1em 0;padding: 0;}
			div.padding-grid{padding: 20px;}
		</style>

		<?php echo ' <main class="main spacing-xxl">
				<article class="post-'.get_the_ID().' page type-page status-publish hentry">
					<header>
		               	<figure class="lazyload-wrapper lazyload-wrapper--banner">
		                  <img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image" data-src="'.$image[0].'" alt="laboratoty" >
		                  <div class="aspect-ratio" style="padding-top: 35%"></div>
		               	</figure>
		            </header>
		            <div class="article wrap">
				        <div class="wrap-medium">
		                  <div class="article-margin">
		                     <div class="article__header">
		                        <div class="article-padding padding-bot-huge">
		                           <div class="article__text">
		                              <h1 class="h1 accent spacing-bot">The Laboratory</h1>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		               	</div>';

		while ($loop->have_posts()) : $loop->the_post();
			$thumb_image = "";
			if (has_post_thumbnail( get_the_ID() ) ){
			  $thumb_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); 
			  //echo "<pre>";print_r($loop);die;
			  //echo "<pre>";print_r($thumb_image[0]);die;
			  $excerpt_str = get_the_excerpt();
			}
		?>	
		<div class="grid grid--posts padding-top padding-grid">
			<article id="<?php echo get_the_ID(); ?>" class="swiper-slide swiper-slide-active" style="width: 1361px;"> 
				<div class="wrap grid grid--article-slideshow grid--spaced"> 
				<div class="g-item"> 
					<figure class="lazyload-wrapper"> 
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image products-list__thumb" data-src="<?php echo $thumb_image[0]; ?>" alt="<?php echo the_title();?>" data-srcset="<?php echo $thumb_image[0]; ?> 300w, <?php echo $thumb_image[0]; ?> 1024w" data-sizes="(max-width:1500px) 100vw, 1500px" sizes="(max-width:1500px) 100vw, 1500px" srcset="<?php echo $thumb_image[0]; ?> 300w, <?php echo $thumb_image[0]; ?> 1024w" src="<?php echo $thumb_image[0]; ?>">
					</figure> 
				</div>
				<div class="g-item grid grid--center grid--column"> 
					<div> 
						<a href="<?php echo the_permalink(); ?>">
						<h2 class="h1-upper medium lab_title"><?php echo the_title();?></h2> </a>
						<p class="article-slideshow__excerpt"><?php echo substr($excerpt_str,0,300); ?>...</p> 
						<a class="btn btn--outline" href="<?php echo the_permalink(); ?>">Read more</a> 
					</div> 
				</div> 
				</div> 
			</article>
		</div>
		<hr class="seperator-line">
		<?php
			endwhile;
			echo '</div></article></main>';
	
	}else{
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
		endwhile;
	}
?>

</div><!-- #main-content -->

<?php
get_footer();
