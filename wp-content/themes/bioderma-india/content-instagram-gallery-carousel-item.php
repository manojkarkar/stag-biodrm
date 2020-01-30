<?php

$thegem_classes = array('portfolio-item');

$thegem_image_classes = array('image');
$thegem_caption_classes = array('caption');

if ($params['layout'] == '4x') {
	$thegem_classes = array_merge($thegem_classes, array('col-md-3', 'col-xs-6'));
} else {
	$thegem_classes = array_merge($thegem_classes, array('col-md-4', 'col-xs-6'));
}

if ($params['effects_enabled'])
	$thegem_classes[] = 'lazy-loading-item';

$thegem_small_image_url = array($i_image['large'], 640, 640);
$thegem_large_image_url = $i_image['original'];
?>
<a class="g-item" href="https://www.instagram.com/biodermaindia/" target="_blank">
 <img src="<?php echo $thegem_large_image_url;?>" alt="<?php the_title(); ?>">
</a>