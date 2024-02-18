<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/admin
 * @author     William Bay <william@flauntyoursite.com>
 */

class Flaunt_Sites_Core_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flaunt_Sites_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flaunt_Sites_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flaunt-sites-core-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flaunt_Sites_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flaunt_Sites_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flaunt-sites-core-admin.js', array( 'jquery' ), $this->version, true );
	}

}

/**************************************************
ADMIN - REORDERS PAGES ABOVE POSTS
**************************************************/

function fsc_change_post_links() {
	global $menu;
	$menu[6] = $menu[5];
	$menu[5] = $menu[20];
	unset($menu[20]);
}

add_action( 'admin_menu', 'fsc_change_post_links' );



/**************************************************
ADMIN - REORDERS PAGES ABOVE POSTS
**************************************************/
function fsc_unregister_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'fsc_unregister_tags' );




/**************************************************
ADMIN - ADDS CURRENT THEME TO SITES LIST
 **************************************************/
class Site_List_Current_Theme {
	public static function init() {
		$class                 = __CLASS__;
		if ( empty( $GLOBALS[ $class ] ) )
			$GLOBALS[ $class ] = new $class;
	}
	public function __construct() {
		add_filter( 'wpmu_blogs_columns', array( $this, 'get_id' ) );
		add_action( 'manage_sites_custom_column', array( $this, 'add_columns' ), 10, 2 );
		add_action( 'manage_blogs_custom_column', array( $this, 'add_columns' ), 10, 2 );
		add_action( 'admin_footer', array( $this, 'add_style' ) );
	}
	public function add_columns( $column_name, $blog_id ) {
		if ( 'blog_id' === $column_name ) {
			echo esc_html( $blog_id );
			// Render column value.
		} elseif ( 'current_theme' === $column_name ) {
			echo esc_html( get_blog_option( $blog_id, 'current_theme', '--' ) );
		}
		return $column_name;

	}
	// Add in a column header.
	public function get_id( $columns ) {
		$columns['blog_id'] = __( 'ID' );
		//add extra header to table
		$columns['current_theme'] = __( 'Current Theme' );

		return $columns;
	}
	public function add_style() {
		echo '<style>#blog_id { width:7%; }</style>';
	}
}
add_action( 'init', array( 'Site_List_Current_Theme', 'init' ) );
