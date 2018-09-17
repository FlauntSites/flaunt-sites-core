<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              		http://williambay.com
 * @since             		0.1
 * @package           		Flaunt_Sites_Core
 *
 * @wordpress-plugin
 * Plugin Name:       		Flaunt Sites Core
 * GitHub Plugin URI:    	https://github.com/FlauntSites/flaunt-sites-core
 * Description:       		Controls all of the Flaunt Sites functions.
 * Version:           		0.5.3
 * Author:            		William Bay
 * Author URI:        		http://williambay.com
 * License:           		GPL-2.0+
 * License URI:       		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       		flaunt-sites-core
 * Domain Path:       		/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flaunt-sites-core-activator.php
 */
function activate_flaunt_sites_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flaunt-sites-core-activator.php';
	Flaunt_Sites_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flaunt-sites-core-deactivator.php
 */
function deactivate_flaunt_sites_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flaunt-sites-core-deactivator.php';
	Flaunt_Sites_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_flaunt_sites_core' );
register_deactivation_hook( __FILE__, 'deactivate_flaunt_sites_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-flaunt-sites-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_flaunt_sites_core() {

	$plugin = new Flaunt_Sites_Core();
	$plugin->run();

}
run_flaunt_sites_core();
