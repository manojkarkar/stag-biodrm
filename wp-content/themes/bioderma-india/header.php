<?php
	$thegem_page_id = is_singular() ? get_the_ID() : 0;
  	$template = get_post_meta( $thegem_page_id, '_wp_page_template', true );
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$thegem_page_id = thegem_get_option('404_page');
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$thegem_page_id = wc_get_page_id('shop');
	}
	$thegem_header_params = thegem_get_sanitize_page_header_data($thegem_page_id);
	$thegem_effects_params = thegem_get_sanitize_page_effects_data($thegem_page_id);
	if(is_archive()) {
		$thegem_header_params = thegem_theme_options_get_page_settings('blog');
		$thegem_effects_params = thegem_theme_options_get_page_settings('blog');
	}
	if(is_tax() || is_category() || is_tag()) {
		$thegem_term_id = get_queried_object()->term_id;
		if(get_term_meta($thegem_term_id , 'thegem_taxonomy_custom_page_options', true)) {
			$thegem_header_params = thegem_get_sanitize_page_header_data($thegem_term_id, array(), 'term');
			$thegem_effects_params = thegem_get_sanitize_page_effects_data($thegem_term_id, array(), 'term');
		}
	}
	if($thegem_effects_params['effects_page_scroller']) {
		$thegem_header_params['header_hide_top_area'] = true;
		$thegem_header_params['header_transparent'] = true;
	}
	$thegem_header_light = $thegem_header_params['header_menu_logo_light'] ? '_light' : '';
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US"  xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US"  xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="en-US"  xmlns="http://www.w3.org/1999/xhtml"
  prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
<!--<![endif]-->
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-16x16.png">
  <link rel="mask-icon" color="#5bbad5" href="<?php bloginfo('template_url'); ?>/images/favicons/safari.svg">
  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon.ico">
  <meta name="msapplication-config" content="<?php bloginfo('template_url'); ?>/images/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <title><?php echo bloginfo('title');?></title>
  <link rel='dns-prefetch' href='//s.w.org' />
  <link rel="alternate" type="application/rss+xml" title="Bioderma &raquo; Homepage Comments Feed" href="<?php echo get_site_url();?>/feed/" />
  <link rel='stylesheet' id='wp-block-library-css'  href='<?php bloginfo("template_url"); ?>/css/theme-styles.css' type='text/css' media='all' />
  <link rel='stylesheet' id='sage/main.css-css'  href='<?php bloginfo("template_url"); ?>/css/main.css?v=2.3' type='text/css' media='all' />
  <script type='text/javascript' src='<?php bloginfo("template_url"); ?>/js/jquery/jquery.min.js?ver=1.12.4'></script>
  <?php wp_head();
  
      if(trim($template) != 'ask-an-expert.php'){
      		remove_action('wp_head', 'wp_enqueue_scripts', 1);
  	}
  ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142771870-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142771870-1');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
</head>
<body  <?php body_class(); ?>>
<header class="header site-header">
<div class="banner-not top-banner text-right">
  <div class="banner__inner">
    <span><strong><a href="https://www.nykaa.com/bioderma-sebium-h2o/p/478102?ptype=product&productId=478102&skuId=478102">Sebium H2O</a></strong>  Now In India - Only At <strong><a href="https://www.nykaa.com/bioderma-sebium-h2o/p/478102?ptype=product&productId=478102&skuId=478102">Nykaa</a></strong></span>
  </div>
</div>
  <div class="grid grid--column">
    <div class="wrap wrap--padding header--sec grid grid--spaced">
      <nav class="nav-primary grid">
        <a class="brand" href="<?php echo get_site_url();?>"><img width="154" src="<?php bloginfo('template_url'); ?>/images/bioderma-corporate.svg" alt="Bioderma India"></a>       
          <ul id="menu-primary" class="reset grid-inline">
          <li id="menu-item-211" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-211"><a href="#">Our products</a><div class="submenu hidden"><div class="wrap grid"><div class="submenu__ranges"><p class="submenu__title accent-bold">Explore our ranges</p><a class="submenu__link range-sensibio" href="<?php echo get_site_url();?>/product-category/sensibio/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Sensitive skin</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Sensibio</span></a>
         <!--  <a class="submenu__link range-hydrabio" href="<?php echo get_site_url();?>/product-category/hydrabio/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Dehydrated sensitive skin</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Hydrabio</span></a> -->
          <a class="submenu__link range-sebium" href="<?php echo get_site_url();?>/product-category/sebium/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Acne-prone and combination to oily skin</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Sébium</span></a>
          <a class="submenu__link range-atoderm" href="<?php echo get_site_url();?>/product-category/atoderm/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Very dry to atopic sensitive skin</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Atoderm</span></a> 
          <a class="submenu__link range-photoderm" href="<?php echo get_site_url();?>/product-category/photoderm/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Skin and sun</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Photoderm</span></a><a class="submenu__link range-cicabio" href="<?php echo get_site_url();?>/product-category/cicabio/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Damaged and irritated skin</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Cicabio</span></a>
       <!--    <a class="submenu__link range-abcderm" href="<?php echo get_site_url();?>/product-category/abcderm/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Paediatric dermatology</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">ABCDerm</span></a> -->
          <a class="submenu__link range-node" href="<?php echo get_site_url();?>/product-category/node/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Hair and scalp</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">Nodé</span></a>
          <a class="submenu__link range-white-objective" href="<?php echo get_site_url();?>/product-category/white-objective/"><span class="submenu__bullet branding"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span><span class="">Lightening for sensitive skin</span><span class="branding bold submenu__pipe">|</span><span class="accent-medium caps">WHITE OBJECTIVE</span></a>
          </div><div class="submenu__needs no-xxlarge"><p class="submenu__title accent-bold">Your needs</p><div class="grid grid--needs"><div class="g-item"><p class="accent-bold">Face</p><a class="submenu__link" href="<?php echo get_site_url();?>/routines/face-clean/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Clean</a><a class="submenu__link" href="<?php echo get_site_url();?>/routines/face-treat/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Treat</a>
          <!--     <a class="submenu__link" href="<?php echo get_site_url();?>/routines/face-protect/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Protect</a> -->
          </div><div class="g-item"><p class="accent-bold">Body</p><a class="submenu__link" href="<?php echo get_site_url();?>/routines/body-clean/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Clean</a><a class="submenu__link" href="<?php echo get_site_url();?>/routines/body-treat/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Treat</a>
          <!--       <a class="submenu__link" href="<?php echo get_site_url();?>/routines/body-protect/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Protect</a> -->
          </div><div class="g-item"><p class="accent-bold">Hair and scalp</p><a class="submenu__link" href="<?php echo get_site_url();?>/routines/hair-and-scalp-clean/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Clean</a>
         <!--   <a class="submenu__link" href="<?php echo get_site_url();?>/routines/hair-and-scalp-treat/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Treat</a> -->
          </div>
          <div class="g-item"><p class="accent-bold">Sun care and Tan</p><a class="submenu__link" href="<?php echo get_site_url();?>/routines/sun-care-and-tan/"><span class="submenu__bullet"><svg width="17" height="17"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php bloginfo('template_url'); ?>/images/icons/sprite-generic_51430b11.svg#icn-bullet-arrow-fill"></use></svg></span> Protect</a>
          </div></div></div></div></div></li>
          <li id="menu-item-214" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-214"><a href="<?php echo get_site_url(); ?>/our-philosophy/">Our Philosophy</a></li>
          <li id="menu-item-212" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-212"><a href="<?php echo get_site_url(); ?>/our-tips/">Our Tips</a></li>
          <!--<li id="menu-item-213" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-213"><a href="<?php  echo get_site_url(); ?>/store-locator/">Store locator</a></li> -->
          <li id="menu-item-213" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-213"><a href="<?php  echo get_site_url(); ?>/bioderma-teams/">Our Team</a></li> 
          <li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="<?php  echo get_site_url(); ?>/ask-our-experts/">Ask Our Expert</a></li> 
          <li id="menu-item-216" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-216"><a href="#">Store locator</a></li> 
          </ul>     
      </nav>
      <nav class="nav-secondary grid grid--vcenter">
        <form role="search" method="get" class="search-form" action="<?php echo get_site_url(); ?>/">
  <label for="search-form-5c6a782a23f95">
    <span class="screen-reader-text">Search for:</span>
  </label>
  <input type="search" id="search-form-5c6a782a23f95" class="search-field" placeholder="Search &hellip;" value="" name="s" />
  <button class="btn btn--icon btn--search js-submit-search-frm" type="submit">
    <span class="btn__icon"><svg width='24' height='24'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-magnifying-glass' /></svg></span>
    <span class="screen-reader-text">Submit search</span>
  </button>
  <button class="btn btn--icon btn--close js-btn-close-search">
    <span class="btn__icon"><svg width='18' height='18'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-close' /></svg></span>
    <span class="screen-reader-text">>Close search</span>
  </button>
</form>
        <button class="nav__search btn btn--icon js-toggle-search xws-only">
          <span class="btn__icon"><svg width='24' height='24'><use xlink:href='<?php bloginfo("template_url"); ?>/images/icons/sprite-generic_51430b11.svg#icn-magnifying-glass' /></svg></span>
          <span class="btn__label">Open search</span>
        </button>
        <a class="nav__club btn btn--fill" href="<?php echo get_site_url(); ?>/bioderma-club/" target="_blank">Join&nbsp;the Club</a>
        <button class="nav__hamburger hamburger js-toggle-menu xxls-only">
          Menu          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </button>
      </nav>
    </div>
  </div>
</header>