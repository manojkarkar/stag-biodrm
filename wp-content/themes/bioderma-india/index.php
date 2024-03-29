<?php
$thegem_panel_classes = array('panel', 'row');

if(is_active_sidebar('page-sidebar')) {
	$thegem_panel_classes[] = 'panel-sidebar-position-right';
	$thegem_panel_classes[] = 'with-sidebar';
	$thegem_center_classes = 'col-lg-9 col-md-9 col-sm-12';
} else {
	$thegem_center_classes = 'col-xs-12';
}

get_header(); ?>

<div id="main-content" class="main-content spacing-xxl">

<?php
	$thegem_no_margins_block = '';
	if(is_tax() || is_category() || is_tag() || is_archive()) {
		$thegem_term_id = get_queried_object() ? get_queried_object()->term_id : 0;
		$thegem_page_data = array(
			'title' => thegem_theme_options_get_page_settings('blog'),
			'effects' => thegem_theme_options_get_page_settings('blog'),
			'slideshow' => thegem_theme_options_get_page_settings('blog'),
			'sidebar' => thegem_theme_options_get_page_settings('blog')
		);
		if(get_term_meta($thegem_term_id , 'thegem_taxonomy_custom_page_options', true)) {
			$thegem_page_data = array(
				'title' => thegem_get_sanitize_page_title_data($thegem_term_id, array(), 'term'),
				'effects' => thegem_get_sanitize_page_effects_data($thegem_term_id, array(), 'term'),
				'slideshow' => thegem_get_sanitize_page_slideshow_data($thegem_term_id, array(), 'term'),
				'sidebar' => thegem_get_sanitize_page_sidebar_data($thegem_term_id, array(), 'term')
			);
		}

		if($thegem_page_data['effects']['effects_no_bottom_margin']) {
			$thegem_no_margins_block .= ' no-bottom-margin';
		}
		if($thegem_page_data['effects']['effects_no_top_margin']) {
			$thegem_no_margins_block .= ' no-top-margin';
		}

		$thegem_panel_classes = array('panel', 'row');
		$thegem_center_classes = 'panel-center';
		$thegem_sidebar_classes = '';

		if(is_active_sidebar('page-sidebar') && $thegem_page_data['sidebar']['sidebar_position']) {
			$thegem_panel_classes[] = 'panel-sidebar-position-'.$thegem_page_data['sidebar']['sidebar_position'];
			$thegem_panel_classes[] = 'with-sidebar';
			$thegem_center_classes .= ' col-lg-9 col-md-9 col-sm-12';
			if($thegem_page_data['sidebar']['sidebar_position'] == 'left') {
				$thegem_center_classes .= ' col-md-push-3 col-sm-push-0';
				$thegem_sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
			}
		} else {
			$thegem_center_classes .= ' col-xs-12';
		}
		if($thegem_page_data['sidebar']['sidebar_sticky']) {
			$thegem_panel_classes[] = 'panel-sidebar-sticky';
			wp_enqueue_script('thegem-sticky');
		}
		if($thegem_page_data['slideshow']['slideshow_type']) {
			thegem_slideshow_block(array('slideshow_type' => $thegem_page_data['slideshow']['slideshow_type'], 'slideshow' => $thegem_page_data['slideshow']['slideshow_slideshow'], 'lslider' => $thegem_page_data['slideshow']['slideshow_layerslider'], 'slider' => $thegem_page_data['slideshow']['slideshow_revslider']));
		}
	}

	global $wp_query;
	//page type is not category then show page title
	if((!$wp_query->is_category) && (trim($wp_query->is_tag) != 1)){
		echo thegem_page_title();
	}
?>
	<div class="block-content<?php echo esc_attr($thegem_no_margins_block); ?>">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thegem_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thegem_center_classes); ?>">
				<?php
					if( $wp_query->is_category || $wp_query->is_tag){
						$catTag = '';
						if($wp_query->is_category){
							$catTag = 'Category: '.ucwords($wp_query->queried_object->name);
						}else if($wp_query->is_tag){
							$catTag = 'Tag: '.ucwords($wp_query->queried_object->name);
						}
						echo '<main class="main spacing-bot-giga">
								<div class="page-header wrap wrap--padding spacing-top spacing-bot">
							  		<h1>'.$catTag.'</h1>
								</div>
								<div class="wrap wrap--padding">
									<div class="grid grid--posts">';
						if(have_posts()){
							if(!is_singular()) {
								wp_enqueue_style('thegem-blog');
								wp_enqueue_style('thegem-additional-blog');
								wp_enqueue_style('thegem-blog-timeline-new');
								wp_enqueue_script('thegem-scroll-monitor');
								wp_enqueue_script('thegem-items-animations');
								wp_enqueue_script('thegem-blog');
								wp_enqueue_script('thegem-gallery');
								//echo '<div class="blog blog-style-default">';
							}
							while ( have_posts() ) : the_post();
								get_template_part( 'content', 'blog-item' );
							endwhile;
						}
						echo '</div>
							</div>
							</main>';
					}else if ( have_posts() ) {

						if(!is_singular()) {
							wp_enqueue_style('thegem-blog');
							wp_enqueue_style('thegem-additional-blog');
							wp_enqueue_style('thegem-blog-timeline-new');
							wp_enqueue_script('thegem-scroll-monitor');
							wp_enqueue_script('thegem-items-animations');
							wp_enqueue_script('thegem-blog');
							wp_enqueue_script('thegem-gallery');
							echo '<div class="blog blog-style-default">';
						}

						while ( have_posts() ) : the_post();

							get_template_part( 'content', 'blog-item' );

						endwhile;

						if(!is_singular()) { thegem_pagination(); echo '</div>'; }

					} else {
						get_template_part( 'content', 'none' );
					}
				?>
				</div>
				<?php
					if(is_active_sidebar('page-sidebar') && !empty($thegem_page_data['sidebar']['sidebar_position'])) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($thegem_sidebar_classes).'" role="complementary">';
						get_sidebar('page');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php
get_footer();
