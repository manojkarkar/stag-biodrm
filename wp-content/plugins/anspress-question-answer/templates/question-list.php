<?php
/**
 * Display question list
 *
 * This template is used in base page, category, tag , etc
 *
 * @link https://anspress.io
 * @since unknown
 *
 * @package AnsPress
 */
?>


<?php if ( ap_have_questions() ) : ?>

    <?php if ( ! get_query_var( 'ap_hide_list_head' ) ) : ?>
	<?php ap_get_template_part( 'list-head' ); ?>
<?php endif; ?>
 <main class="main spacing-xxl">
<div class="wrap-medium wrap--padding small" style="min-height:250px;">
	<div class="ap-questions">
		<?php
			/* Start the Loop */
		while ( ap_have_questions() ) :
			ap_the_question();
			ap_get_template_part( 'question-list-item' );
			endwhile;
		?>
	</div>	   
	   <?php ap_questions_the_pagination(); ?>
	   <?php ap_get_template_part( 'login-signup' ); ?>
</div>        
	</main>
<?php else : ?>
<main class="main spacing-xxl" style="padding-top:15%">
<div class="wrap-medium wrap--padding small">
<div class="article wrap"><div class="wrap-medium"><div class="article-margin"><div class="article__header"><div class="article-padding padding-bot-huge"><div class="article__text"><div class="categories spacing-bot-medium">
	<p class="ap-no-questions">
		<?php esc_attr_e( 'There are no questions matching your query or you do not have permission to read them.', 'anspress-question-answer' ); ?>
	</p>
	</div></div></div></div></div></div>
	</div>        
	</main>

	
<?php endif; ?>
<style type="text/css">
	html,body{overflow-x: hidden;}
</style>