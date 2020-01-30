<?php

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	$cat = "";
	if($wp_query->is_category){
		$cat = 'Category: '.ucwords($wp_query->queried_object->name);
	}
	//echo "<pre>";print_r($wp_query);die;
	//echo "<pre>";print_r($wp_query->post_count);die;
	//echo thegem_page_title();
?>

	<div class="block-content<?php echo esc_attr($thegem_no_margins_block); ?>">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thegem_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thegem_center_classes); ?>">
					<main class="main spacing-xxl">
						<?php 
							if($wp_query->post_count > 0){
								$flag1 = $flag2 = 0;
								for($i=0;$i<$wp_query->post_count;$i++){
									if($wp_query->posts[$i]->post_type == 'product'){
										//for product page
										$flag1 = 1;
									}else if($wp_query->posts[$i]->post_type == 'post'){
										//for post page
										$flag2 = 1;
									}
								}
								if($flag1 == 1){
								   echo '<div class="page-header wrap wrap--padding spacing-top spacing-bot">
												<h1>Search Results for <strong>'.$_REQUEST['s'].'</strong></h1>
										</div>
										<div class="wrap wrap--padding range-sensibio">
											<div class="products-list">';
												while ( have_posts() ) : the_post();
													include(locate_template(array('woocommerce/content-post-product.php', 'content-post-product.php')));
												endwhile;
									echo '</div>
										</div>';
								}if($flag2 == 1){
									echo '<section class="wrap wrap--padding spacing-top-huge padding-bot-huge">
											<p class="h1">Articles</p>
											<div class="grid grid--posts padding-top">';
											while ( have_posts() ) : the_post();
														include(locate_template(array('gem-templates/blog/content-blog-item-masonry.php', 'content-blog-item.php')));
													endwhile;	
									echo '</div>
										</section>';
								}	
							}else{
								echo '<div class="wrap wrap--padding">
									      <div class="alert alert-warning" style="margin:5%;">
									        <p class="h4 accent padding-bot-huge">Sorry, no results were found.</p>
									      </div>
									    <section class="wrap essentials essentials--list">
										    <header class="wrap-big">
										      <h1>
										        <span class="h1-lower">EXPLORE OUR NEW RANGE OF <br/> PRODUCTS</span>
										      </h1>
										    </header>
											<div class="products-list wrap wrap--padding spacing-v-huge">';

											$args = array('post_type' => 'product','posts_per_page' => 4,'tax_query' => array( array(
					                        'taxonomy' => 'product_visibility','field'=> 'name','terms'    => 'featured',),),
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
									    echo '</div>
									    	</section>
									    </div>'; 
							}
						?>
					</main>
				</div>
			</div>
		</div>
	</div>
</div><!-- #main-content -->

<?php
get_footer();
