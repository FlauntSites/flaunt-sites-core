<?php
/**
 * Functions for the Login experience.
 */
function fsc_custom_login() {

    wp_enqueue_style( 'fsc-custom-login', plugin_dir_url( __FILE__ ) . 'css/class-flaunt-sites-core-login.css', '', '201800618' );
    wp_enqueue_script( 'fsc-custom-login', plugin_dir_url( __FILE__ ) . 'js/class-flaunt-sites-core-login.js', '', '201800618', true );
    wp_enqueue_script( 'wp-api' );

    $fsc_options = get_option( 'fsc_options' );
    $fsc_logo    = $fsc_options['fsc_logo'];
    // $fsc_logo    = wp_get_attachment_image_src( $fsc_logo, 'medium' );
    $fsc_logo    = wp_get_attachment_url( $fsc_logo );

    wp_localize_script( 'fsc-custom-login', 'flaunt_sites_custom_login_ajaxify', array(
        'currentSite' => get_bloginfo( 'url' ),
        'fscLogo'     => $fsc_logo,
    ));
    

}
add_action( 'login_enqueue_scripts', 'fsc_custom_login' );
