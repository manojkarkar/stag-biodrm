<?php
	$thegem_item = get_post($attachment_id);

	if (!$thegem_item) {
		return;
	}

	$thegem_highlight = (bool) get_post_meta($thegem_item->ID, 'highlight', true);
	$thegem_highligh_type = get_post_meta($thegem_item->ID, 'highligh_type', true);
	if (!$thegem_highligh_type) {
		$thegem_highligh_type = 'squared';
	}
	$thegem_attachment_link = get_post_meta($thegem_item->ID, 'attachment_link', true);
	$thegem_single_icon = true;

	if (!empty($thegem_attachment_link)) {
		$thegem_single_icon = false;
	}

	if ($params['type'] == 'grid') {
		$thegem_size = 'thegem-gallery-justified';
		if ($thegem_highlight) {
			$thegem_size = 'thegem-gallery-justified-double';
			if ($params['layout'] == '4x')
				$thegem_size = 'thegem-gallery-justified-double-4x';
		}
		if ($params['style'] == 'masonry')
			if ($thegem_highlight)
				$thegem_size = 'thegem-gallery-masonry-double';
			else
				$thegem_size = 'thegem-gallery-masonry';

		if ($params['layout'] == '100%')
			$thegem_size .= '-100';

		if ($params['style'] == 'metro')
			$thegem_size = 'thegem-gallery-metro';

		if ($thegem_highlight && $params['style'] != 'metro' && $thegem_highligh_type != 'squared') {
			$thegem_size .= '-' . $thegem_highligh_type;
		}
		if ($params['layout'] == '2x') {
			$thegem_size = 'thegem-gallery-' . $params['style'];
		}
	} else {
		$thegem_size = 'thegem-container';
		$thegem_thumb_image_url = wp_get_attachment_image_src($thegem_item->ID, 'thegem-post-thumb');
	}

	$thegem_full_image_url = wp_get_attachment_image_src($thegem_item->ID, 'full');

	$thegem_classes = array('gallery-item');

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '2x') {
		$thegem_classes = array_merge($thegem_classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '3x') {
		if ($thegem_highlight && $thegem_highligh_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-lg-8', 'col-md-8', 'col-sm-12', 'col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '4x') {
		if ($thegem_highlight && $thegem_highligh_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-lg-6', 'col-md-6', 'col-sm-8', 'col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-lg-3', 'col-md-3', 'col-sm-4', 'col-xs-6'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $thegem_highlight)
		$thegem_classes[] = 'double-item';

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $thegem_highlight && $thegem_highligh_type != 'squared') {
		$thegem_classes[] = 'double-item-' . $thegem_highligh_type;
	}

	$thegem_wrap_classes = $params['item_style'];

	if ($params['type'] == 'grid')
		$thegem_classes[] = 'item-animations-not-inited';

	$thegem_sources = array();

	if ($params['type'] == 'grid') {
		if ($params['style'] == 'metro') {
			$thegem_sources = array(
				array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thegem-gallery-metro-medium', '2x' => 'thegem-gallery-metro-retina'))
			);
		}

		if (!$thegem_highlight) {
			$retina_size = $params['style'] == 'justified' ? $thegem_size : 'thegem-gallery-masonry-double';

			if ($params['layout'] == '100%') {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['fullwidth_columns']) {
						case '4':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
								array('media' => '(max-width: 1032px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-4x-small', '2x' => $retina_size)),
								array('media' => '(max-width: 1180px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-4x', '2x' => $retina_size)),
								array('media' => '(max-width: 1280px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-5x', '2x' => $retina_size)),
								array('media' => '(max-width: 1495px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
								array('media' => '(max-width: 1575px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-3x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
							);
							break;

						case '5':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(min-width: 992px) and (max-width: 1175px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-4x', '2x' => $retina_size)),
								array('media' => '(min-width: 1495px) and (max-width: 1680px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size))
							);
							break;
					}
				}
			} else {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['layout']) {
						case '2x':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x', '2x' => $retina_size))
							);
							break;

						case '3x':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-3x', '2x' => $retina_size))
							);
							break;

						case '4x':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-3x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-4x', '2x' => $retina_size))
							);
							break;
					}
				}
			}
		} else {
			$retina_size = $thegem_size;
			if ($params['layout'] == '100%') {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['fullwidth_columns']) {
						case '4':
							$thegem_sources = array(
								array('media' => '(max-width: 700px),(min-width: 825px) and (max-width: 992px),(min-width: 1095px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-100-' . $thegem_highligh_type . '-5', '2x' => $retina_size)),
								array('media' => '(min-width: 700px) and (max-width: 825px),(min-width: 992px) and (max-width: 1095px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-100-' . $thegem_highligh_type . '-6', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-100-' . $thegem_highligh_type . '-4', '2x' => $retina_size))
							);
							break;

						case '5':
							$thegem_sources = array(
								array('media' => '(max-width: 700px),(min-width: 825px) and (max-width: 992px),(min-width: 1095px) and (max-width: 1495px),(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-100-' . $thegem_highligh_type . '-5', '2x' => $retina_size)),
								array('media' => '(min-width: 700px) and (max-width: 825px),(min-width: 992px) and (max-width: 1095px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-100-' . $thegem_highligh_type . '-6', '2x' => $retina_size)),
								array('media' => '(max-width: 1680px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-100-' . $thegem_highligh_type . '-4', '2x' => $retina_size)),
							);
							break;
					}
				}
			} else {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['layout']) {
						case '2x':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-2x', '2x' => $retina_size))
							);
							break;

						case '4x':
							$thegem_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-4x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-gallery-' . $params['style'] . '-double-4x-' . $thegem_highligh_type, '2x' => $retina_size))
							);
							break;
					}
				}
			}
		}
	}

 $thegem_thumb_image_url = wp_get_attachment_image_src($thegem_item->ID, 'full');
 $thegem_attrs ="";
 $thegem_attrs = array('alt' => get_post_meta($thegem_item->ID, '_wp_attachment_image_alt', true));

 $thegem_attrs_link = get_post_meta($thegem_item->ID, 'attachment_link', true);
 if($thegem_attrs_link==""){$thegem_attrs_link=$thegem_thumb_image_url['0'];}
?>
 <a class="g-item" href="<?php echo $thegem_attrs_link;?>" target="_blank">
          <img src="<?php echo $thegem_thumb_image_url['0'];?>" alt="<?php echo$thegem_attrs['alt'];?>">
</a>