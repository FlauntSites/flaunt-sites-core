<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes 
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes
 * @author     William Bay <william@flauntyoursite.com>
 */

class Flaunt_Sites_Core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Flaunt_Sites_Core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'flaunt-sites-core';
		$this->version = '0.1';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Flaunt_Sites_Core_Loader. Orchestrates the hooks of the plugin.
	 * - Flaunt_Sites_Core_i18n. Defines internationalization functionality.
	 * - Flaunt_Sites_Core_Admin. Defines all hooks for the admin area.
	 * - Flaunt_Sites_Core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-flaunt-sites-core-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-flaunt-sites-core-public.php';

		/**
		 * The class responsible for defining all actions that occur in the login area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'login/class-flaunt-sites-core-login.php';


		$this->loader = new Flaunt_Sites_Core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Flaunt_Sites_Core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Flaunt_Sites_Core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Flaunt_Sites_Core_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Flaunt_Sites_Core_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Flaunt_Sites_Core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}


/**
 * ACF fields. Backwards compatible for Padang Padang until full Gutenberg integration.
 */

$my_theme = wp_get_theme();
if ($my_theme == 'Padang Padang'){

	// Home fields
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-home-fields.php';
	// Other fields
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-option-fields.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-service-fields.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-reviews-fields.php';
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-badges-fields.php';	

	// ADDS AN OPTION PAGE
	if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(
			$args = array(
				'page_title' 	=> 'Flaunt Options',
			)
		);

	}

}

/**
 * Loads all Core Custom Post Types
 * Services
 * Reviews
 * Badges
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-custom-post-types.php';

/**
 * Loads the Sharebar
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-sharebar.php';


/**
 * Disables Yoast on specific CPTs
 */
function fsc_remove_yoast_cpts() {
	remove_meta_box( 'wpseo_meta', array( 'badges', 'reviews' ), 'normal' );
}

add_action( 'add_meta_boxes', 'fsc_remove_yoast_cpts', 100 );


/**
 * Loads Flaunt Sites Core Widgets
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flaunt-sites-core-widgets.php';

/**
 * REMOVES WP EMOJI
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );



/**
 * Enqueues Main Script files.
 *
 * @since     1.0.0
 *
 */
function enqueue_main_scripts(){

	//Adds Greensock support.
	wp_enqueue_script( 'greensock', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js');

	//Adds Scrollmagik support.
	wp_enqueue_script( 'scrollmagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js' );
	// wp_enqueue_script( 'scrollmagic_indicators', plugin_dir_url( dirname( __FILE__ ) ) . 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js' );
	wp_enqueue_script( 'scrollmagic_gsap_support', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.min.js', array(), '20180816' );

	//Adds Swiper Slider support.
	wp_enqueue_script( 'swiper_scripts', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js', array(), '20180816'  );
	wp_enqueue_style( 'swiper_styles', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css' );

}

add_action( 'login_enqueue_scripts', 'enqueue_main_scripts' );
add_action( 'wp_enqueue_scripts', 'enqueue_main_scripts' );



//Adds additional thumbnail sizes.
add_image_size( 'medium_square', '600', '600', true );
add_image_size( 'oversized', '1400', '1400', false );
add_image_size( 'fullscreen', '2000', '2000', false );


/**
 * Controls the output of Social Media icons.
 *
 */
function fsc_social_icons( $social_network ) {
		$social_network = $social_network;
		$fsc_options = get_option( 'fsc_options' ); 
		$social_url = $fsc_options[ 'fsc_' . $social_network . '_url' ];

		if ( '' !== $social_url ): { ?>

			<a class="social-icon" target="_blank" href="<?php echo esc_url( $social_url ) ?>">
				<svg class="fs-icons">
					<use xlink:href="#icon-<?php echo $social_network; ?>-square"></use>
				</svg>
			</a>

		<?php
		} endif;
}
