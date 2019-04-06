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
class FS_Proofing extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_proofing',
			'description' => 'Include a Call To Action in your sidebar.',
		);
		parent::__construct( 'fs_proofing', 'FS Client Proofing Button', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) { ?>


		<div>
			<a class="btn onehundredcenter" href="<?php the_field( 'fsc_proofing_link' ); ?>">Purchase Prints</a>
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
	register_widget( 'FS_Proofing' );
});
