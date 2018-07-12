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




/**************************************************
ADDS A SUPPORT WIDGET TO THE ADMIN AREA WITH CONTACT INFORMATION FOR FLAUNT YOUR SITE.
**************************************************/


function fsc_support_widget() { ?>
  <div>
    <a href="https://flauntsites.com/tutorials/1-getting-started/"><strong>Start Here!</strong></a><br />
    <a href="https://flauntsites.com/tutorials/1-getting-started/" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/support-screen.jpg' ?>" align="left" style="display:block; width:100%"></a>
    <div style="clear:both;"></div>
  </div>

  <?php }

function fsc_dashboard_support_setup() {
    add_meta_box( 'fsc_support_widget', 'Flaunt Sites Setup', 'fsc_support_widget', 'dashboard', 'side', 'high' );
}

add_action( 'wp_dashboard_setup', 'fsc_dashboard_support_setup' );




/**************************************************
REMOVE WELCOME SCREEN FROM NEW SITES.
**************************************************/

remove_action('welcome_panel', 'wp_welcome_panel');



/**************************************************
ADDS A PASSWORD STRENGTH METER TO SIGNUP
**************************************************/
 
function fsc_add_strength_meter($steps) {
	// Add the flag to the user_pass field
	$steps['account']['fields']['user_pass']['display_force'] = true;
 
	return $steps;
}

add_filter('wp_ultimo_registration_steps', 'fsc_add_strength_meter');


