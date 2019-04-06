<?php 
/**
 * Reviews Widget.
 *
 * @link       https://flauntsites.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/widgets
 */
class FS_Reviews extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'fs_reviews',
			'description' => 'Includes Client reviews on this page.',
		);
		parent::__construct( 'fs_reviews', 'FS Reviews', $widget_ops );
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
				'posts_per_page' => 2,
				'post_type'  => 'reviews',
				'orderby'    => 'rand',
			)
		); ?>

	<!-- Begin Markup -->
	<h3><a href="/reviews">Raves + Reviews</a></h3>

	<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<div class="review-small">

				<img class="round-thumb" itemprop="image" src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>">
				<blockquote class="quote-small"><span class="quote">&ldquo;</span><?php the_field( 'fsc_review_quote' ); ?><span class="quote">&rdquo;</span></blockquote>

				<p class="handwrite">~<?php the_title(); ?></p>

			</div>

		<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>

	<?php else : ?>
	<p><?php _e( 'Oops. Looks like you need to add some Reviews.' ); ?></p>
	<?php endif; ?>


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
	register_widget( 'FS_Reviews' );
});