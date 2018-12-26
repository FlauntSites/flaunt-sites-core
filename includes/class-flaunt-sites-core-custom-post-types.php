<?php
/**
 * Loads the Custom Post Types
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes
 */

/**
 * Flush your rewrite rules.
 */
function fsc_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fsc_flush_rewrite_rules' );
add_action( 'wpmu_new_blog', 'fsc_flush_rewrite_rules' );



/**
 * Loads all Post Types
 */
function fsc_post_types() {

	// If current site is NOT main site, display the CPTs.
	if ( get_current_blog_id() === 1 ) {
		$show_in_menu = false;
	}

	global $show_in_menu;
	require_once 'cpts/services.php';
	require_once 'cpts/reviews.php';
	require_once 'cpts/badges.php';
}
add_action( 'init', 'fsc_post_types' );

/**
 * Moves Gravity Forms position.
 *
 * @param num $position Number for new menu location.
 */
function fsc_gform_menu_position( $position ) {
	return 20;
}
add_filter( 'gform_menu_position', 'fsc_gform_menu_position' );
