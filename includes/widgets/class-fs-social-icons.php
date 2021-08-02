<?php
/**
 * Proofing Widget.
 *
 * @link       https://flauntsites.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/widgets
 */
class FS_Social_Icons extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_social_icons',
			'description' => 'Include your Social Media Icons in your sidebar. Add or edit your social media accounts in the Customizer under Business Identity',
		);
		parent::__construct( 'fs_social_icons', 'FS Social Icons', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) { ?>


		<div>
			<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '../public/partials/flaunt-sites-core-public-social-header.php'; ?>
		</div>


	<?php }

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'FS_Social_Icons' );
});
