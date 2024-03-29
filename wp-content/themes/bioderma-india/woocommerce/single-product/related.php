<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="related-products clearfix" style="margin-bottom: 40px;"></div>

<!-- 	<div class="gem-button-separator gem-button-separator-type-soft-double"><div class="gem-button-separator-holder"><div style="border-color: #b6c6c9;" class="gem-button-separator-line"></div></div><div class="gem-button-separator-button"><h2 class="light"><?php esc_html_e( 'You may also like', 'thegem' ); ?></h2></div><div class="gem-button-separator-holder"><div style="border-color: #b6c6c9;" class="gem-button-separator-line"></div></div></div> -->
	<section class="wrap wrap--padding">
      <h1 class="accent bold h5">You may also like</h1>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
