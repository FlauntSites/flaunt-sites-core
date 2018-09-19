<?php
/**
 * Functions for the Login experience.
 */
function fsc_custom_login() {

    wp_enqueue_style( 'fsc-custom-login', plugin_dir_url( __FILE__ ) . 'css/class-flaunt-sites-core-login.css', '', '201800618' );
    wp_enqueue_script( 'fsc-custom-login', plugin_dir_url( __FILE__ ) . 'js/class-flaunt-sites-core-login.js', '', '201800618', true );
    wp_enqueue_script( 'wp-api' );
    wp_localize_script( 'fsc-custom-login', 'flaunt_sites_custom_login_ajaxify', array( 'currentSite' => get_bloginfo( 'url' ) ) );

}
add_action( 'login_enqueue_scripts', 'fsc_custom_login' );
