<?php
/*
Template Name: extra pages
*/
get_header();
?>
<main class="main spacing-xxl">

<?php
			if (has_post_thumbnail( get_the_ID() ) ):
								  $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'single-post-thumbnail' );
									echo'
									<style>.main {padding-top: 38px !important;}</style>
							          <div class="page-image" data-collection-id="5aa6d2400852298bbb35c70c" data-edit-main-image="Banner" data-annotation-alignment="bottom left">
							            <div class="image-wrapper">
							              <img data-src="'.$image['0'].'" data-image-dimensions="1120x400" data-image-focal-point="0.5,0.5" alt="bioderma_club_header_en.jpg" style="" class="" data-image-resolution="1500w" src="'.$image['0'].'">
							            </div>
							          </div>';
									    endif;
		?>
	<div class="page-header wrap-medium wrap--padding spacing-top spacing-bot">
		<h1><?php echo the_title();?></h1>
	</div>
	<div class="wrap-medium wrap--padding small">
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
