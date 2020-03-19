<?php 
/**
 * Badges Widget.
 *
 * @link       https://flauntsites.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/widgets
 */
class FS_Badges extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'fs_badges',
			'description' => 'Displays your badges with links to the posts.',
		);
		parent::__construct( 'fs_badges', 'FS Badges', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$the_query = new WP_Query(
			array(
				'post_count' => 4,
				'post_type'  => 'badges',
				'orderby'    => 'rand',
			)
		);

		?>

		<?php
		if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>

		<?php if ( $the_query->have_posts() ) : ?>

			<div class="badge-group">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<div class="badge"><a href="<?php the_field( 'fsc_badge_link' ); ?>"><?php the_post_thumbnail( '' ); ?></a></div>

				<?php endwhile; ?>
			</div>

			<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php _e( 'Oops. Looks like you need to add some Badges.' ); ?></p>
			<?php endif; ?>
		<?php
	}
	// End Widget Output.


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'fs_badges' );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'fs_badges' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'FS_Badges' );
});
