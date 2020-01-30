<?php
/**
 * Display login signup form
 *
 * @package AnsPress
 * @author  Rahul Aryan <support@anspress.io>
 */

?>

<?php if ( ! is_user_logged_in() ) { ?>
	<div class="ap-login">
		<?php
			// Load WSL buttons if available.
			do_action( 'wordpress_social_login' );
		?>

		<div class="ap-login-buttons">
			
			<a href="<?php echo esc_url( wp_login_url( get_the_permalink() ) ); ?>" class="btn btn--fill"><?php esc_attr_e( 'Login', 'anspress-question-answer' ); ?></a>
		</div>
	</div>

<?php }else{?>
	<div class="ap-login">
		<?php
			// Load WSL buttons if available.
			//do_action( 'wordpress_social_login' );
		?>

		<div class="ap-login-buttons">
	   <a href="<?php echo esc_url( wp_logout_url( get_permalink() )  ); ?>" class="btn btn--fill">Logout</a>
		</div>
	</div>

<?php }?>
