<?php
/**
 * Services Post Type
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/cpts
 */

register_post_type( 'services',
	array(
		'labels'              => array(
			'name'               => __( 'Services', 'flaunt_sites_core' ),
			'singular_name'      => __( 'Service', 'flaunt_sites_core' ),
			'all_items'          => __( 'All Custom Services', 'flaunt_sites_core' ),
			'add_new'            => __( 'Add New', 'flaunt_sites_core' ),
			'add_new_item'       => __( 'Add New Service', 'flaunt_sites_core' ),
			'edit'               => __( 'Edit', 'flaunt_sites_core' ),
			'edit_item'          => __( 'Edit Service', 'flaunt_sites_core' ),
			'new_item'           => __( 'New Service', 'flaunt_sites_core' ),
			'view_item'          => __( 'View Service', 'flaunt_sites_core' ),
			'search_items'       => __( 'Search Services', 'flaunt_sites_core' ),
			'not_found'          => __( 'Nothing found in the Database.', 'flaunt_sites_core' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'flaunt_sites_core' ),
			'parent_item_colon'  => '',
		),
		'description'         => __( 'This is the example Service', 'flaunt_sites_core' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => $show_in_menu,
		'query_var'           => true,
		'menu_position'       => 11,
		'menu_icon'           => 'dashicons-camera',
		'rewrite'             => array(
			'slug'       => 'services',
			'with_front' => true,
		),
		'has_archive'         => false,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'revisions' ),
		'show_in_rest'        => true,
		// 'template'         => $template,
		// 'template_lock'    => 'all',
	)
);

register_taxonomy_for_object_type( 'category', 'services' );
