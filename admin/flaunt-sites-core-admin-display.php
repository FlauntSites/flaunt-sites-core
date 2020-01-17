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

// update toolbar.
function update_adminbar( $wp_adminbar ) {

	// add SitePoint menu item.
	$wp_adminbar->add_node([
		'id'    => 'flaunt-sites-tuts',
		'title' => '<span class="flaunt-sites-tuts">' . __( 'Flaunt Sites Tutorials' ) . '</span>',
		'href'  => '#',
	]);
}
add_action( 'admin_bar_menu', 'update_adminbar', 999 );

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
// function fsc_display_modal_first_login() {

// 	if ( is_user_logged_in() ) {
// 		// Get current total amount of logins (should be at least 1).
// 		$new_user = get_user_meta( get_current_user_id(), '_new_user', true );
// 		// If it's 1, it's their first time logging in, display the Modal.
// 		if ( '1' === $new_user ) {
// 			update_user_meta( get_current_user_id(), '_new_user', '0' );
// 		}
// 	}
// }
// add_action( 'admin_footer', 'fsc_display_modal_first_login' );


