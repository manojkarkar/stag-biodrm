<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

$thegem_use_custom = get_post(thegem_get_option('404_page'));

$thegem_q = new WP_Query(array('page_id' => thegem_get_option('404_page')));

get_header(); ?>

<div id="main-content" class="main-content" style="margin-top: 10% ">

<?php if(thegem_get_option('404_page') && $thegem_use_custom && $thegem_q->have_posts()) : $thegem_q->the_post(); ?>

<?php
	get_template_part( 'content', 'page' );
?>

<?php else : ?>
<?php //echo thegem_page_title(); ?>

<div class="page-header wrap wrap--padding spacing-top spacing-bot">
  <h1>Not found</h1>
</div>
<div class="wrap wrap--padding">
      <div class="alert alert-warning">
        <p class="h4 accent padding-bot-huge">Sorry, but the page you were trying to view does not exist.</p>
      </div>
	<div class="products-list wrap wrap--padding spacing-v-huge">
	<?php
		$args = array(
	            'post_type' => 'product',
	            'posts_per_page' => 4,
	            'tax_query' => array(
	                    array(
	                        'taxonomy' => 'product_visibility',
	                        'field'    => 'name',
	                        'terms'    => 'featured',
	                    ),
	                ),
	            );
	        $loop = new WP_Query( $args );
	        if ( $loop->have_posts() ) {
	            while ( $loop->have_posts() ) : $loop->the_post();
	               wc_get_template_part( 'content', 'product' );
	            endwhile;
	        } else {
	        	$args = array(
					'post_type' => 'product',
					'stock' => 1,
					'posts_per_page' => 4,
					'orderby' =>'date',
					'order' => 'DESC' );
					$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
					wc_get_template_part( 'content', 'product' );
	            endwhile;
	        }
	?>
	</div>
</div>
<?php endif; ?>

</div><!-- #main-content -->

<?php
get_footer();