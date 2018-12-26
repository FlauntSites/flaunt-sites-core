<?php
/**
 * Services Post Type
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes/cpts
 */

register_post_type( 'badges',
	array(
		'labels'              => array(
			'name'               => __( 'Badges', 'flaunt_sites_core' ),
			'singular_name'      => __( 'Badge', 'flaunt_sites_core' ),
			'all_items'          => __( 'All Custom Badges', 'flaunt_sites_core' ),
			'add_new'            => __( 'Add New', 'flaunt_sites_core' ),
			'add_new_item'       => __( 'Add New Badge', 'flaunt_sites_core' ),
			'edit'               => __( 'Edit', 'flaunt_sites_core' ),
			'edit_item'          => __( 'Edit Badge', 'flaunt_sites_core' ),
			'new_item'           => __( 'New Badge', 'flaunt_sites_core' ),
			'view_item'          => __( 'View Badge', 'flaunt_sites_core' ),
			'search_items'       => __( 'Search Badge', 'flaunt_sites_core' ),
			'not_found'          => __( 'Nothing found in the Database.', 'flaunt_sites_core' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'flaunt_sites_core' ),
			'parent_item_colon'  => '',
		),
		'description'         => __( 'This is the example Badge', 'flaunt_sites_core' ),
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_menu'        => $show_in_menu,
		'query_var'           => true,
		'menu_position'       => 15,
		'menu_icon'           => 'dashicons-awards',
		'rewrite'             => array(
			'slug'       => 'badges',
			'with_front' => false,
		),
		'has_archive'         => false,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky' ),
		'show_in_nav_menus'   => false,
		'show_in_rest'        => true,
	)
);
