<?php 
/**
 * Related Client Posts Widget.
 *
 * @link       https://flauntsites.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/widgets
 */
class FS_Related_Client_Posts extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_related_client_posts',
			'description' => 'Includes Client reviews on this page.',
		);
		parent::__construct( 'fs_related_client_posts', 'FS Client Posts', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

	// The query variable
		$queried_term = get_query_var( 'clients' );
			
		// Return the terms for current post based off the query variable. Make you sanitize your queries!!
		$terms = wp_get_post_terms( absint( get_the_ID() ), 'client_id', array( 'fields' => 'all' ) );
			
		// Start the arguments for WP_Query(). We'll define an empty tax_query
		// so we hav something to dump our terms into programatically.
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 2,
			'tax_query' => array()
		);
			
		// Loop through all the terms returned for the post and add them to
		// the tax_query in the proper format
		foreach ( $terms as $term ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'client_id',
				'field' => 'slug',
				'terms' => sanitize_title( $term->slug )
			);
		}
			
		// Fetch the posts we need
		$client_posts = new WP_Query( $args );

     ?>

          <?php if ( $client_posts->have_posts() ) : ?>
		  
		  	<h3 class="sidebar-title">Related Blog Posts</h3>

            <?php while ( $client_posts->have_posts() ) : $client_posts->the_post(); ?>

			<div class="related">

				<h4><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h3>

				<div>
					<a href="<?php the_permalink(); ?> "><img class="round-thumb" itemprop="image" src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>"></a>
					<p><?php the_excerpt(); ?></p>
				</div>

				<div class="clear"></div>

            </div>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

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
	register_widget( 'FS_Related_Client_Posts' );
});