<?php

$thegem_classes = array('portfolio-item');
$thegem_classes = array_merge($thegem_classes, $slugs);

$thegem_image_classes = array('image');
$thegem_caption_classes = array('caption');

$thegem_portfolio_item_data = get_post_meta(get_the_ID(), 'thegem_portfolio_item_data', 1);


if (!empty($thegem_portfolio_item_data['highlight_type'])) {
	$thegem_highlight_type = $thegem_portfolio_item_data['highlight_type'];
} else {
	$thegem_highlight_type = 'squared';
}

if (empty($thegem_portfolio_item_data['types']))
	$thegem_portfolio_item_data['types'] = array();

if ($params['style'] != 'metro') {
	if ($params['layout'] == '1x') {
		$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));
		$thegem_image_classes = array_merge($thegem_image_classes, array('col-sm-5', 'col-xs-12'));
		$thegem_caption_classes = array_merge($thegem_caption_classes, array('col-sm-7', 'col-xs-12'));
	}

	if ($params['layout'] == '2x') {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-sm-6', 'col-xs-12'));
	}

	if ($params['layout'] == '3x') {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-md-8', 'col-xs-8'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-4', 'col-xs-4'));
	}

	if ($params['layout'] == '4x') {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-md-6', 'col-sm-8', 'col-xs-8'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-3', 'col-sm-4', 'col-xs-4'));
	}
}

if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']))
	$thegem_classes[] = 'double-item';

if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider'])) {
	$thegem_classes[] = 'double-item-' . $thegem_highlight_type;
}

$thegem_size = 'thegem-portfolio-justified';
$thegem_sizes = thegem_image_sizes();
if ($params['layout'] != '1x') {
	if ($params['style'] == 'masonry') {
		$thegem_size = 'thegem-portfolio-masonry';
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider']))
			$thegem_size = 'thegem-portfolio-masonry-double';
	} elseif ($params['style'] == 'metro') {
		$thegem_size = 'thegem-portfolio-metro';
	} else {
		if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && empty($params['is_slider'])) {
			$thegem_size = 'thegem-portfolio-double-' . str_replace('%', '',$params['layout']);

			if ( ($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular') && isset($thegem_sizes[$thegem_size.'-hover'])) {
				$thegem_size .= '-hover';
			}

			if(isset($thegem_sizes[$thegem_size.'-gap-'.$params['gaps_size']])) {
				$thegem_size .= '-gap-'.$params['gaps_size'];
			}

			if ($params['layout'] == '100%' && $params['display_titles'] == 'page') {
				$thegem_size .= '-page';
			}

		}
	}

	if (isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight'] && $params['style'] != 'metro' && empty($params['is_slider']) && $thegem_highlight_type != 'squared') {
		$thegem_size .= '-' . $thegem_highlight_type;
	}
} else {
	$thegem_size = 'thegem-portfolio-1x';
}

$thegem_classes[] = 'item-animations-not-inited';

$thegem_size = apply_filters('portfolio_size_filter', $thegem_size);

$thegem_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thegem_self_video = '';

$thegem_sources = array();

if ($params['style'] == 'metro') {
	$thegem_sources = array(
		array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thegem-portfolio-metro-medium', '2x' => 'thegem-portfolio-metro-retina'))
	);
}

if (!isset($thegem_portfolio_item_data['highlight']) || !$thegem_portfolio_item_data['highlight'] || !empty($params['is_slider']) ||
		($params['style'] == 'masonry' && isset($thegem_portfolio_item_data['highlight']) && $thegem_portfolio_item_data['highlight']) && $thegem_highlight_type == 'vertical') {

	$retina_size = $params['style'] == 'justified' ? $thegem_size : 'thegem-portfolio-masonry-double';

	if ($params['layout'] == '100%') {
		if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
			switch ($params['fullwidth_columns']) {
				case '4':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size))
					);
					break;

				case '5':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1495px) and (max-width: 1680px), (min-width: 550px) and (max-width: 1280px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
						array('media' => '(min-width: 1680px) and (max-width: 1920px), (min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size))
					);
					break;
			}
		}
	} else {
		if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
			switch ($params['layout']) {
				case '2x':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x', '2x' => $retina_size))
					);
					break;

				case '3x':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-3x', '2x' => $retina_size))
					);
					break;

				case '4x':
					$thegem_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-3x', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $params['style'] . '-4x', '2x' => $retina_size))
					);
					break;
			}
		}
	}
}

?>
<section class="essentials essentials-slideshow">
  <div class="wrap">
    <header class="essentials-slideshow__header">
      <h1>
        <span class="h1-upper caps"><?php echo  $portfolio_title;?></span>
        <span class="h1-lower"><?php echo  get_the_title();?></span>
      </h1>
      
    </header>
  </div>
          <div class="products-slideshow swiper-container-horizontal">
            <div class="">
                                       <article class="swiper-slide">
            <div class="wrap grid grid--products-slideshow">
              <div class="g-item grid grid--right">
                <?php  echo the_content();?>
              </div>
              <div class="g-item products-slideshow__photo">
                <figure class="lazyload-wrapper">
                  <img class="attachment-post-thumbnail size-post-thumbnail wp-post-image article-slideshow__big-media lazyloaded" data-src="<?php echo $thegem_large_image_url['0'];?>" alt="" data-srcset="<?php echo $thegem_large_image_url['0'];?> 300w, <?php echo $thegem_large_image_url['0'];?> 675w" data-sizes="(max-width: 675px) 100vw, 675px" sizes="(max-width: 675px) 100vw, 675px" srcset="<?php echo $thegem_large_image_url['0'];?> 300w, <?php echo $thegem_large_image_url['0'];?> 675w" src="<?php echo $thegem_large_image_url['0'];?>">
                  <div class="aspect-ratio" style="padding-top: 75.56%;"></div>
                  
                </figure>
              </div>
            </div>
          </article>
              </div>
    </div>
  </section>