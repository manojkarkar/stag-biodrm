<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

wp_enqueue_script('thegem-woocommerce');

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);
}

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

if (isset($GLOBALS['thegem_grid_params'])) {
	$params = $GLOBALS['thegem_grid_params'];
	wc_get_template_part( 'content', 'product-grid-item' . ($params['layout'] == '1x' ? '-' . $params['layout'] : '') );
	return;
}

if (isset($GLOBALS['thegem_slider_params'])) {
	$params = $GLOBALS['thegem_slider_params'];
	wc_get_template_part( 'content', 'product-carusel-item' );
	return;
}

// Extra post classes
$classes = array('inline-column');
if($woocommerce_loop['columns'] == 2) {
	$classes[] = 'col-xs-6';
} elseif($woocommerce_loop['columns'] == 3) {
	$classes[] = 'col-sm-4 col-xs-6';
} elseif($woocommerce_loop['columns'] == 4) {
	$classes[] = 'col-sm-3 col-xs-6';
} elseif($woocommerce_loop['columns'] == 6) {
	$classes[] = 'col-lg-2 col-md-4 col-sm-4 col-xs-4';
} else {
	$classes[] = 'col-xs-12';
}
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
if(thegem_get_option('catalog_view')) {
	$classes[] = 'catalog-view';
}

$sizeLabel = $label_custom = "";
if($product->get_attribute( 'Custom Label' ) !=""){
	$label_custom='<span class="label label-new"> '.$product->get_attribute( 'Custom Label' ).' </span>';
}else{
if($product->get_attribute( 'Size' ) !=""){
$Size = $product->get_attribute( 'Size' );
$SizeCount = count(explode(",",$Size));
$sizeLabel = '<span class="products-list__sizes primary">'.$Size.'</span>';
if($SizeCount > 1){
$label_custom = '<span class="label label-sizes">'.$SizeCount.'sizes</span>';
}
}
}	
?>
   <article class="products-list__item " data-href="<?php the_permalink(); ?>">
   <?php do_action('woocommerce_before_shop_loop_item'); ?>
    <div class="products-list__front">

            <div class="labels labels--absolute">
        	<?php echo $label_custom;?>
        	</div>
            <figure class="lazyload-wrapper">
		        <img class="lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image products-list__thumb" data-src="<?php echo   the_post_thumbnail_url( $size );?>" alt="" data-srcset="<?php echo   the_post_thumbnail_url( $size );?> 300w, <?php echo   the_post_thumbnail_url( $size );?> 1024w" data-sizes="(max-width:1500px) 100vw, 1500px">
		        <div class="aspect-ratio" style="padding-top: 120%"></div>
		       </figure>
		    <h1 class="products-list__title accent-medium"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		    </h1>
		    <span class="products-list__starting primary-medium">Starting at <?php echo do_action('woocommerce_after_shop_loop_item_title'); ?>
		    </span>

      </div>

    <div class="products-list__back">
    <div class="products-list__grid grid grid--column grid--spaced">
      <div class="g-item">
        <p class="products-list__title accent-medium"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        <?php echo $sizeLabel;?>
       </div>
      <div class="products-list__desc g-item small medium">
        <?php the_excerpt();?>
      </div>
      <div class="g-item">
                  <span class="products-list__starting primary-medium">Starting at <?php echo do_action('woocommerce_after_shop_loop_item_title'); ?></span></span>
                  <a class="btn btn--cart" href="<?php the_permalink(); ?>">View more</a>

          
      </div>
    </div>
  </div>
  </article>

