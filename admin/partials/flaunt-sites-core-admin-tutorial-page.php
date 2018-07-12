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



function fsc_tutorial_page(){?>

<div class="wrap" id="admin-wrap">
	<div class="admin-header">
		<a href="http://flauntyoursite.com" class="admin-logo"></a>
        <h2 class="flaunt-admin-title">Flaunt Sites Tutorials</h2>
            <div class="custom-site-cta">
                <p>Looking for a beautiful <span class="custom-site-cta-orange">Custom Designed Website</span>? Let Flaunt Your Site help you with that.</p>
            </div>
	</div>

    <div class="icon32"></div>

    <h2 class="nav-tab-wrapper">
        <a href="?page=fys_options&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>">Lesson 1</a>
        <a href="?page=fys_options&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Lesson 2</a>
        <a href="#" class="nav-tab">Lesson 3</a>
        <a href="#" class="nav-tab">Lesson 4</a>
        <a href="#" class="nav-tab">Lesson 5</a>            
        <a href="#" class="nav-tab">Lesson 6</a>
        <a href="#" class="nav-tab">Lesson 7</a>             
    </h2>


</div>

<?php 
    switch_to_blog(1);
    // WP_Query arguments
    $args = array(
        'post_type'     => array( 'tutorials' ),
        'posts_per_page'    =>  10,
    );

    $the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<h2><?php the_title(); ?></h2>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php }