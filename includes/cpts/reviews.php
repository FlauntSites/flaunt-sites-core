<?php
/**
 * Services Post Type
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/cpts
 */

register_post_type( 'reviews',
	array(
		'labels'              => array(
			'name'               => __( 'Reviews', 'flaunt_sites_core' ),
			'singular_name'      => __( 'Review', 'flaunt_sites_core' ),
			'all_items'          => __( 'All Custom Reviews', 'flaunt_sites_core' ),
			'add_new'            => __( 'Add New', 'flaunt_sites_core' ),
			'add_new_item'       => __( 'Add New Review', 'flaunt_sites_core' ),
			'edit'               => __( 'Edit', 'flaunt_sites_core' ),
			'edit_item'          => __( 'Edit Review', 'flaunt_sites_core' ),
			'new_item'           => __( 'New Review', 'flaunt_sites_core' ),
			'view_item'          => __( 'View Review', 'flaunt_sites_core' ),
			'search_items'       => __( 'Search Review', 'flaunt_sites_core' ),
			'not_found'          => __( 'Nothing found in the Database.', 'flaunt_sites_core' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'flaunt_sites_core' ),
			'parent_item_colon'  => '',
		),
		'description'         => __( 'This is the example Review', 'flaunt_sites_core' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => $show_in_menu,
		'query_var'           => true,
		'menu_position'       => 14,
		'menu_icon'           => 'dashicons-star-empty',
		'rewrite'             => array(
			'slug'       => 'reviews',
			'with_front' => true,
		),
		'has_archive'         => 'reviews',
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'show_in_nav_menus'   => false,
		'show_in_rest'        => true,
	)
);

register_taxonomy_for_object_type( 'category', 'reviews' );
