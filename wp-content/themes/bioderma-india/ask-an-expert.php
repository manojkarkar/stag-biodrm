<?php
/*
Template Name: Ask an Expert
*/
get_header();

?>
<main class="main spacing-xxl">
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