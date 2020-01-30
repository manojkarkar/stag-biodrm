<?php
/*
Template Name: Our expertise
*/
get_header();
?>
<main class="main spacing-xxl">
   <?php
  while ( have_posts() ) : the_post();
 $post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $related[0]->ID ), 'single-post-thumbnail' ); 
  ?>
  <?php if(!empty($post_image) && $post_image[0]!=""):?>
  	  <header>
        <figure class="lazyload-wrapper lazyload-wrapper--banner">
      <img class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyloaded" data-src="<?php echo $post_image[0];?>" alt="Bioderma" src="<?php echo $post_image[0];?>">
      <div class="aspect-ratio" style="padding-top: 35%"></div>
    </figure>
  </header>
  <?php endif;?>
  <div class="article wrap">
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
      <?php echo the_content();?>
<?php  
  endwhile;
?>
</div>     
</main>
<?php 
get_footer();
?>