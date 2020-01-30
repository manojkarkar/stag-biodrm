<?php
/*
Template Name: Bioderma Team
*/
get_header();
?>
	<link rel="stylesheet" type="text/css" href="<?php echo content_url(); ?>/plugins/js_composer/assets/css/js_composer.min.css">
<main class="main spacing-xxl">
	<?php
	  	$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $related[0]->ID ), 'single-post-thumbnail' ); ?>
	  	<?php if(!empty($post_image) && $post_image[0]!=""): ?>
	  	<header>
	        <figure class="lazyload-wrapper lazyload-wrapper--banner">
	      		<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyloaded" data-src="<?php echo $post_image[0];?>" alt="" src="<?php echo $post_image[0];?>">
	      		<div class="aspect-ratio" style="padding-top: 35%"></div>
	    	</figure>
	  	</header>
  	<?php endif; ?>
  	<div class="wrap-medium">
      	<div class="article-margin">
        	<div class="article__header">
          		<div class="article-padding padding-bot-huge">
            		<div class="article__text">
                        <h1 class="h1 accent spacing-bot"><?php echo the_title();?></h1>
                    </div>
          		</div>
        	</div>
      	</div>
    </div>
	<div class="wrap-medium article__text article-padding spacing-bot-huge">
	   <?php
		  while ( have_posts() ) : the_post();?>
		    <?php echo the_content(); ?>
		  <?php  
		  endwhile;
		?>  
	</div>        
</main>
<?php 
get_footer();
?>
