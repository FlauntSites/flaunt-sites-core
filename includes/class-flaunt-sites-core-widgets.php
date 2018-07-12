<?php


class FS_Reviews extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_reviews',
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
        array (
          'post_count'  => 2,
          'post_type'   => 'reviews',
          'orderby'     => 'rand',
         )
     );

     ?>

          <?php if ( $the_query->have_posts() ) : ?>
		  	<li class="footer-widget">
				<h3 class="sidebar-title"><a href="/reviews">Raves + Reviews</a></h3>

				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<div class="review-small">

						<div>
							<img class="round-thumb" itemprop="image" src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>">
							<blockquote class="quote-small"><span class="quote">&ldquo;</span><?php the_field( 'fsc_review_quote' ); ?><span class="quote">&rdquo;</span></blockquote>
						</div>

						<div class="clear"></div>
						<p class="handwrite">~<?php the_title(); ?></p>

					</div>

            	<?php endwhile; ?>

			</li>
			
            <?php wp_reset_postdata(); ?>

          <?php else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
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






class FS_Client_Posts extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_client_posts',
			'description' => 'Includes Client reviews on this page.',
		);
		parent::__construct( 'fs_client_posts', 'FS Client Posts', $widget_ops );
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

          <?php else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
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
	register_widget( 'FS_Client_Posts' );
});









class FS_Call_To_Action extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_call_to_action',
			'description' => 'Include a Call To Action in your sidebar.',
		);
		parent::__construct( 'fs_call_to_action', 'FS Call To Action', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) { ?>

	<div class="cta-widget">
		<div class="service-cta">
			<a class="btn onehundredcenter" href="<?php the_field( 'fsc_cta_link', 'options' ); ?>"><?php the_field( 'fsc_cta_button_text', 'options' ); ?></a>
		</div>
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
	register_widget( 'FS_Call_To_Action' );
});




				



class FS_Proofing_Button extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_proofing_button',
			'description' => 'Include a Call To Action in your sidebar.',
		);
		parent::__construct( 'fs_proofing_button', 'FS Client Proofing Button', $widget_ops );
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
	register_widget( 'FS_Proofing_Button' );
});
				




class FS_Badges extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'fs_badges',
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
        array (
          'post_count'  => 4,
          'post_type'   => 'badges',
          'orderby'     => 'rand',
         )
     );

     ?>

		<div class="footer-widget">
		<h3>As featured in...</h3>

		<?php if ( $the_query->have_posts() ) : ?>


					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<div class="badge-group">
							<div class="badge"><a href="<?php the_field( 'fsc_badge_link' ); ?>"><?php the_post_thumbnail(''); ?></a></div>
						</div>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>

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
	register_widget( 'FS_Badges' );
});
