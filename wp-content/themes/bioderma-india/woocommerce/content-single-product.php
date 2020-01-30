<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $product, $woocommerce_loop,$woocommerce,$post;
$sidebar_data = thegem_get_sanitize_page_sidebar_data(get_the_ID());
$sidebar_position = thegem_check_array_value(array('', 'left', 'right'), $sidebar_data['sidebar_position'], '');
$left_classes = 'col-sm-6 col-xs-12';
$right_classes = 'col-sm-6 col-xs-12';
if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
	$left_classes = 'col-sm-5 col-xs-12';
	$right_classes = 'col-sm-7 col-xs-12';
}
$label_custom=$Class_active="";
$currency = get_woocommerce_currency_symbol();
$price = get_post_meta( get_the_ID(), '_regular_price', true);
$sale = get_post_meta( get_the_ID(), '_sale_price', true);
if($product->get_attribute( 'Custom Label' ) !=""){
   $label_custom='<span class="label label-new"> '.$product->get_attribute( 'Custom Label' ).' </span>';
}
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$terms = get_the_terms( $post->ID, 'product_cat' );
        $thegem_term_id = $terms[0]->term_id;
        $thegem_page_data = array(
            'title' => thegem_get_sanitize_page_title_data($thegem_term_id, array(), 'term'),
            'effects' => thegem_get_sanitize_page_effects_data($thegem_term_id, array(), 'term'),
            'slideshow' => thegem_get_sanitize_page_slideshow_data($thegem_term_id, array(), 'term'),
            'sidebar' => thegem_get_sanitize_page_sidebar_data($thegem_term_id, array(), 'term')
          );
        $tq_custom_page_data = $thegem_page_data['title'];
        $background_color ='#fff';
        $title_color = '#23282d';
        if($tq_custom_page_data['title_background_color'] !=""){$background_color = $tq_custom_page_data['title_background_color'];}
        if($tq_custom_page_data['title_text_color'] !=""){$title_color =  $tq_custom_page_data['title_text_color'];}
        $variations = array();
        if($product->is_type( 'variable' )){$variations = $product->get_available_variations();}
?>
<?php
	/**
 * Hook: woocommerce_before_single_product.
	 *
	 * @hooked wc_print_notices - 10
	 */
	//do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form(); // WPCS: XSS ok.
		return;
	}
?>
 <div class="wrap wrap--padding padding-top-small">
            <span xmlns:v="http://rdf.data-vocabulary.org/#">
            <span typeof="v:Breadcrumb"><a href="<?php echo get_site_url();?>" rel="v:url" property="v:title">Home</a> 
            <?php if($terms[0]->name!=""){
              $category = $terms[0]->name;
            ?>
            / <span rel="v:child" typeof="v:Breadcrumb">
            <a href="<?php echo get_category_link( $terms[0]->term_id );?>" rel="v:url" property="v:title"><?php echo $category;?></a>
            
            <?php }?>
            / <span class="breadcrumb_last"><?php echo preg_replace( '/\w+/', '', get_the_title(), 2 );?></span>
            </span>
            </span>
            </span>
            </span>
</div>
 <article class="">
            <div class="product-header grid grid--product-header wrap wrap--padding spacing-top">
               <div class="g-item product-gallery">
                  <div class="grid grid--gallery grid--spaced">
                  <?php do_action('tq_woocommerce_single_product_left'); ?>
                     <div class="g-item product-gallery__main">
                        <div class="labels labels--absolute">
                        <?php echo  $label_custom;?>
                        </div>
                        <!-- icons social -->
                        <div class="icons">
                           <div class="btn btn--icon product-share" title="Share product">
                              <span class="btn__icon icon-share">
                                 <svg width='29' height='29'>
                                    <use xlink:href='<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-share' />
                                 </svg>
                              </span>
                              <span class="btn__label">Share product</span>
                              <a class=" btn-circle socials-item" target="_blank" href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_permalink())); ?>">
                                 <svg width='12' height='30'>
                                    <use xlink:href='<?php bloginfo('template_url'); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-facebook' />
                                 </svg>
                              </a>
                              <a target="_blank" class=" btn-circle socials-item" href="<?php echo esc_url('https://twitter.com/share?url='.$share_link_url.'&amp;text='.$share_twitter_summary); ?>">
                                 <svg width='20' height='24'>
                                    <use xlink:href='<?php bloginfo('template_url'); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-twitter' />
                                 </svg>
                              </a>
                              <a class="btn-circle" href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" target="_blank">
                                 <svg width='18' height='30'>
                                    <use xlink:href='<?php bloginfo('template_url'); ?>/images/icons/sprite-social_d3bfd09b.svg#icn-email' />
                                 </svg>
                              </a>
                           </div>
                        </div>
                        <!-- icons social -->
                        <!-- Default image -->
                        <figure class="lazyload-wrapper">
                           <img class="product-gallery__image lazyload attachment-post-thumbnail size-post-thumbnail wp-post-image products-list__thumb" src="<?php echo   the_post_thumbnail_url( $size );?>" data-src="<?php echo   the_post_thumbnail_url( $size );?>" alt="<?php echo get_the_title();?>" data-srcset="<?php echo   the_post_thumbnail_url( $size );?> 300w, <?php echo   the_post_thumbnail_url( $size );?> 1024w" data-sizes="(max-width:1500px) 100vw, 1500px">
                           <div class="aspect-ratio"></div>
                        </figure>
                        <!-- Default image -->
                        <div class="video"></div>
                     </div>
                  </div>
               </div>
               <div class="g-item product-info">
                  <h1 class="product-info__title h3 accent-medium">
                    <?php echo $category;?>
                  <br />
                    <?php echo preg_replace( '/\w+/', '', get_the_title(), 2 );?>
                  </h1>
                  <div>
                     <?php if($product->get_attribute( 'Price' ) !=""){?>
                     <ul class="product-prices reset">
                     <?php 
                     $Price= array();
                     $Price = $product->get_attribute( 'Price' );
                     $Price = explode("|",$Price);
                     for($i=0; $i<count($Price) ; $i++){
                        if($i==0){$Class_active="active";}
                        $str .='<li class="price h4 medium primary  '.$Class_active.'">'.$currency. $Price[$i].'</li>';
                        unset($Class_active);                     
                         }
                         echo $str;
                         unset($str);
                     ?>
                     </ul>
                     <?php }else{?>
                      <ul class="product-prices reset">
                        <?php if($sale) : ?>
                        <i style="text-decoration: line-through;"><?php echo $currency; echo $sale; ?></i>
                        <?php endif; ?>
                       <span class="item_price">
                        <?php echo $currency; echo $price; ?>                          
                       </span></h4>
                      </ul>
                     <?php }?>
                     <?php if($product->get_attribute( 'Size' ) !=""){?>
                     <ul class="product-labels labels small ">
                     <?php 
                     $Size = array();
                     $Size = $product->get_attribute( 'Size' );
                     $Size = explode("|",$Size);
                     for($i=0; $i<count($Size) ; $i++){
                     $data_value = explode(' ',trim($Size[$i]));
                     if($i==0){$Class_active="active";}
                     echo ' <li class="label-size '.$Class_active.'" data-value='.$data_value["0"].'> '.$Size[$i].' </li>';
                        unset($Class_active);
                     }
                     ?>
                     </ul>
                     <?php }?>
                  </div>
                  <div class="product-info__desc small medium">
                     <p><?php the_excerpt();?></p>
                  </div>
                  <!-- tags -->
                  <?php if($product->get_attribute( 'Skin types' ) !=""){?>
                  <p class="primary">
                     <span> Skin types:</span>
                     <span> <?php echo $product->get_attribute( 'Skin types' );?></span>
                  </p>
                  <?php }?>
                   <?php if($product->get_attribute( 'Skin concerns' ) !=""){?>
                  <p class="primary">
                     <span> Skin concerns:</span>
                     <span> <?php echo $product->get_attribute( 'Skin concerns' );?></span>
                  </p>
                  <?php }?>
                  <!-- tags -->
                  <!-- button static -->
                  <button class="btn btn--popin btn--big js-open-popin" data-popin="product-retailer">
                    <span class="btn__label">Buy1 online</span>
                  </button>
                  <!-- <a class="btn btn--big" href="<?php echo get_site_url();?>/store-locator/">
                  <span class="btn__label">Find a retailer</span>
                  </a> -->
                  <!-- button static -->
               </div>
            </div>
             <section class="product-side-info chameleon">
               <div class="wrap grid grid--side-info grid--spaced">
                   <?php if($product->get_attribute( 'Good to know' ) != "") : ?>
                     <div class="g-item toggle">
                     <button class="btn-toggle">Good to know</button>
                     <div class="toggle__content">
                        <p class="h-underline accent bold">Good to know</p>
                        <ul class="list list-2-cols list--inline-bullets small"> 
                         <?php 
                           $few_words = array();
                           $few_words = $product->get_attribute( 'Good to know' );
                           $few_words = explode(",",$few_words);
                           for($j=0; $j< count($few_words) ; $j++){?>
                                    <li>
                                    <span class="list__bullet branding">
                                    <svg width="17" height="17">
                                    <use xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"/>
                                    </svg>
                                    </span>
                                   <?php echo $few_words[$j];?>
                                    </li>
                           <?php 
                             }
                           ?>
                        </ul>
                      </div>
                  </div>
                  <?php endif; ?>
                  <?php if(get_the_content() != "") : ?>
                  <div class="g-item toggle">
                     <button class="btn-toggle">Awards</button>
                     <div class="toggle__content">
                        <p class="h-underline accent bold">Awards</p>
                        <ul class="reset list list--awards">
                        <?php 
                         $style = array("padding-top:100.00%","padding-top:108.58%","padding-top:97.87%","padding-top:155.30%","padding-top:97.62%");
                              // read all image tags into an array
                              preg_match_all('/<img[^>]+>/i',apply_filters( 'the_content', get_the_content() ), $imgTags); 
                              for ($i = 0; $i < count($imgTags[0]); $i++) {
                                preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
                                $origImageSrc[] = str_ireplace( 'src="', '',  $imgage[0]);
                              }
                              $k=0;
                              for ($i=0; $i < count($origImageSrc) ; $i++) { 
                         ?>
                           <li>
                              <figure class="lazyload-wrapper">
                                 <img class="lazyload image-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo str_replace('-150x150', '', $origImageSrc[$i]); ?>" data-src="<?php echo str_replace('-150x150', '', $origImageSrc[$i]); ?>" alt="<?php echo get_the_title();?>" data-srcset="<?php echo str_replace('-150x150', '', $origImageSrc[$i]); ?> 300w, <?php echo str_replace('-150x150', '', $origImageSrc[$i]); ?> 150w, <?php echo str_replace('-150x150', '', $origImageSrc[$i]); ?> 768w, <?php echo str_replace('-150x150', '', $origImageSrc[$i]); ?> 1024w" data-sizes="(max-width: 1840px) 100vw, 1840px">
                                 <div class="aspect-ratio" style="<?php echo $style[$k]?>"></div>
                              </figure>
                           </li>
                           <?php
                             $k++;
                             if($k==5){ $k=0;}   
                              }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </section>
            <section class="product-utils grid grid--how-to wrap">
               <div class="g-item">
               <?php if ( ! empty( $tabs['biological-mode-of-action'] ) ) :?>
                  <div class="toggle">
                  <?php
                  $title=""; 
                  if ( ! empty( $tabs['biological-mode-of-action']['title']) ) :
                   $title = $tabs['biological-mode-of-action']['title'];
                        endif;
                  ?>
                     <button class="btn-toggle"><?php echo $title;?></button>
                     <div class="toggle__content">
                        <p class="h4 accent medium no-xlarge"><?php echo $title;?></p>
                        <div class="small">
                        <?php if($product->get_attribute( 'mode of action' ) != "") :?>
                           <ul class="taxonomy reset">
                           <?php $mode_of_action = $product->get_attribute( 'mode of action' );
                           $mode_of_action = explode(",",$mode_of_action);
                           for($j=0; $j< count($mode_of_action) ; $j++){
                           $icn= strtolower(trim($mode_of_action[$j]));
                           $icn =  preg_replace('/\s+/', '-', $icn);
                           ?>
                           <li>
                                 <svg class="taxonomy__icon" width="32" height="32">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-targets_66bfed96.svg#icn-<?php echo $icn;?>"></use>
                                 </svg>
                                 <span class="taxonomy__label"><?php echo $mode_of_action[$j];?></span>
                           </li>

                           <?php 
                           }
                           ?>
                           </ul>
                        <?php endif;?>
                           <?php if ( ! empty( $tabs['biological-mode-of-action']['content']) ) :?>
                           <p><?php echo $tabs['biological-mode-of-action']['content'];?></p>
                           <?php endif;?>
                        </div>
                     </div>
                  </div>
                <?php  endif;?>
                <?php if ( ! empty( $tabs['use-in-a-routine'] ) ) :?>
                  <div class="toggle">
                     <?php
                     $title=""; 
                     if ( ! empty( $tabs['use-in-a-routine']['title']) ) :
                      $title = $tabs['use-in-a-routine']['title'];
                           endif;
                     ?>
                     <button class="btn-toggle"><?php echo $title;?></button>
                     <div class="toggle__content">
                        <p class="h4 accent medium no-xlarge"><?php echo $title;?></p>
                        <div class="small">
                          <?php if($product->get_attribute( 'routine' ) != "") :?>
                           <ul class="taxonomy reset">
                           <?php $routine = $product->get_attribute( 'routine' );
                           $routine = explode(",",$routine);
                           for($j=0; $j< count($routine) ; $j++){
                              $icon = strtolower(trim($routine[$j]));
                              $icon =  preg_replace('/\s+/', '-', $icon);
                              if($routine[$j]=='7 days / week'){
                                 $icon="7-days-week";
                              }
                              ?>
                              <li>
                                    <svg class="taxonomy__icon" width="32" height="32">
                                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-frequencies_92ba736c.svg#icn-<?php echo $icon;?>"></use>
                                    </svg>
                                    <span class="taxonomy__label"><?php echo $routine[$j];?></span>
                              </li>
                           <?php 
                           }
                           ?>
                           </ul>
                           <?php  endif;?>
                           <?php if ( ! empty( $tabs['use-in-a-routine']['content']) ) :?>
                           <p><?php echo $tabs['use-in-a-routine']['content'];?></p>
                           <?php endif;?>
                        </div>
                     </div>
                  </div>
                  <?php  endif;?>
               </div>
               <?php if($product->get_attribute( 'Youtube video Id' ) != "") : 
               $video_id = $product->get_attribute( 'Youtube video Id');
               $thumbnail="https://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
               ?>

               <div class="g-item product-utils__video">
                  <p class="product-utils__video-title h4 accent medium"><?php echo the_title(); ?>
                  <a class="js-product-video" href="https://www.youtube.com/watch?v=<?php echo $video_id;?>">
                     <figure class="lazyload-wrapper icn-play">
                        <span class="wp-post-image-wrapper">
                        <img class="lazyload image-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo $thumbnail;?>" data-src="<?php echo $thumbnail;?>" alt="<?php echo the_title(); ?>" data-srcset="<?php echo $thumbnail;?> 300w, <?php echo $thumbnail;?> 768w, <?php echo $thumbnail;?> 1024w, <?php echo $thumbnail;?> 1352w" data-sizes="(max-width: 1352px) 100vw, 1352px"></span>
                        <div class="aspect-ratio" style="padding-top: 52.22%"></div>
                        <div class="video" id="player"></div>
                     </figure>
                  </a>
               </div>
               <?php  endif;?>
            </section>
            <?php 
            $product_description =  wpautop(do_shortcode(get_post_meta($post->ID, 'thegem_product_description', true)));
            if ($product_description !="" ) :?>
            <div class="toggle toggle--always wrap">
               <button class="btn-toggle h4">More information</button>
               <div class="toggle__content">
                  <div class="grid grid--cols">
                     <div class="g-item">
                        <p class="h-underline bold accent">Product Description</p>
                        <p><?php  echo $product_description;?></p>
                     </div>
                     <?php if ( ! empty( $tabs['product-benefits'] ) ) :?>
                     <div class="g-item">
                     <?php
                     $title=""; 
                     if ( ! empty( $tabs['product-benefits']['title']) ) :
                      $title = $tabs['product-benefits']['title'];
                           endif;
                     ?>
                        <p class="h-underline bold accent"><?php echo $title;?></p>
                        <?php 
                        if ( ! empty( $tabs['product-benefits']['content']) ) :
                        echo  $tabs['product-benefits']['content'];
                        endif;
                        ?>
                     </div>
                     <?php  endif;?>
                  </div>
                  <?php if ( ! empty( $tabs['ingredients'] ) ) :
                     $title=""; 
                     if ( ! empty( $tabs['ingredients']['title']) ) :
                      $title = $tabs['ingredients']['title'];
                           endif;
                     ?>
                  <p class="h-underline bold accent"><?php echo $title;?></p>
                  <?php 
                        if ( ! empty( $tabs['ingredients']['content']) ) :
                        echo '<p>'.$tabs['ingredients']['content'].'<p>';
                        endif;
                        ?>
                  <?php  endif;?>
               </div>
            </div>
            <?php  endif;?>
            <div class="single-product-content-bottom">
            </div>
         </article>


<?php if (!empty($variations)):?>
<!-- Seller Popups -->        
   <div class="grid grid--center popin-wrapper" data-popin="product-retailer">
            <div class="popin grid">
               <span class="popin__close">
                  <svg width="19" height="19">
                  <use xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-close">
                  </svg>
               </span>
               <div class="popin__content">
                  <section class="">
                     <span class="h1-upper caps">Buy online on:</span>
                     <?php
                      for($i=0; $i<count($variations) ; $i++):
                        $Class_active="";
                        if($i==0){$Class_active="active";}
                        $id_value = explode(' ',trim($variations[$i]['attributes']['attribute_size']));
                        ?>
                       <div class="grid grid--wrap grid--spaced seller <?php echo $Class_active;?>" id='<?php echo $id_value["0"];?>'>
                        <?php
                        if(!empty($variations[$i]["amazon_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["amazon_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/amazon.png" alt="amazon">
                        </a>
                       <?php  endif;  

                       if(!empty($variations[$i]["flipkart_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["flipkart_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/flipkart.png" alt="flipkart" >
                        </a>
                       <?php  endif;  
                       if(!empty($variations[$i]["nykaa_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["nykaa_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/nykaa.png" alt="nykaa">
                        </a>
                       <?php  endif;
                         if(!empty($variations[$i]["snapdeal_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["snapdeal_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/snapdeal.png" alt="snapdeal">
                        </a>
                       <?php  endif;
                         if(!empty($variations[$i]["netmeds_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo$variations[$i]["netmeds_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/netmeds-logo.png" alt="netmeds">
                        </a>
                       <?php  endif;
                         if(!empty($variations[$i]["care_to_beauty_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["care_to_beauty_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/care-to-beauty.png" alt="care-to-beauty">
                        </a>
                       <?php  endif;
                       if(!empty($variations[$i]["medlife_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["medlife_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/medlife.png" alt="medlife">
                        </a>
                       <?php  endif;
                       if(!empty($variations[$i]["1mg_Url"])):?>
                        <a class="btn btn--shop btn--amazoncom btn__buyonline" href="<?php echo $variations[$i]["1mg_Url"];?>" target="_blank">
                        <img src="<?php bloginfo('template_url'); ?>/images/logos/1mg.png" alt="1mg">
                        </a>
                       <?php  endif;?>
                       </div>
                       <?php
                        unset($Class_active); 
                        endfor;
                     ?>
                  </section>
               </div>
            </div>
            <div class="overlay"></div>
   </div>    
<!-- Seller Popups -->  
 <?php  endif;?>
 <style>@media only print, only screen and (min-width: 900px){.range-side-info {background-color:<?php echo $background_color;?>;}}
  .branding {color: <?php echo $title_color;?>;}
  .seller {
  display: none;
  }
  .seller.active {
    display: block;
  }
</style>
<script type="text/javascript">
   jQuery(".product-labels li").click(function(){
      var attr = jQuery(this).attr("data-value");
      jQuery('.seller').removeClass('active');
      jQuery('#'+attr).addClass('active');
  });
</script>