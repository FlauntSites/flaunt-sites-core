<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/admin/partials
 */

/**
 * Support widget markup.
 */
function fsc_support_widget() { ?>
	<div>
		<a href="https://flauntsites.com/tutorials/1-getting-started/"><strong>Start Here!</strong></a><br />	
		<a href="https://flauntsites.com/tutorials/1-getting-started/" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/support-screen.jpg' ?>" align="left" style="display:block; width:100%"></a>
		<div style="clear:both;"></div>
	</div>
	<?php
}

/**
 * Add Support widget to Dashboard.
 */
function fsc_dashboard_support_setup() {
	add_meta_box( 'fsc_support_widget', 'Flaunt Sites Setup', 'fsc_support_widget', 'dashboard', 'side', 'high' );
}
add_action( 'wp_dashboard_setup', 'fsc_dashboard_support_setup' );




/**************************************************
REMOVE WELCOME SCREEN FROM NEW SITES.
**************************************************/
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/**
 * Add password strength meter.
 */
function fsc_add_strength_meter( $steps ) {
	// Add the flag to the user_pass field.
	$steps['account']['fields']['user_pass']['display_force'] = true;

	return $steps;
}
add_filter( 'wp_ultimo_registration_steps', 'fsc_add_strength_meter' );

/**
 * Sets meta for new users on first login.
 */
function fsc_new_user( $user_login, $user ) {
	if ( $new_user = get_user_meta( $user->id, '_new_user', true ) ) {
		// They've Logged In Before, set to 0.
		update_user_meta( $user->id, '_new_user', '0' );
	} else {
		// First Login, set it to 1.
		update_user_meta( $user->id, '_new_user', 1 );
	}
}
add_action( 'wp_login', 'fsc_new_user', 10, 2 );


/**
 * Displays the modal on first login.
 */
function fsc_display_modal_first_login() {

	if ( is_user_logged_in() ) {
		// Get current total amount of logins (should be at least 1).
		$new_user = get_user_meta( get_current_user_id(), '_new_user', true );
		// If it's 1, it's their first time logging in, display the Modal.
		if ( '1' === $new_user ) {

			wp_enqueue_script( 'modal', plugin_dir_url( __FILE__ ) . 'js/flaunt-sites-core-welcome-modal.js', array(), 20190419, true );
			update_user_meta( get_current_user_id(), '_new_user', '0' );

		}
	}
}
// add_action( 'admin_footer', 'fsc_display_modal_first_login' );
