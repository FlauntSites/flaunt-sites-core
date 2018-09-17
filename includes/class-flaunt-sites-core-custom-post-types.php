<?php
/**
 * The file that defines the Custom Post Types
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 * @subpackage Flaunt_Sites_Core/includes
 */

/**
 * Flush Rewrite rules after each Theme Switch
 */
function fsc_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fsc_flush_rewrite_rules' );


/**
 * Reorders the Media menu item to below the FSC CPTs.
 * Disabled due to Offset errors NEEDS TO BE FIXED OR REMOVED
 */

// function fsc_reorder_media_menu_item() {
//     global $menu;

//     foreach ( $menu as $key => $value ) {
//         if ( 'upload.php' == $value[2] ) {
//             $oldkey = $key;
// 		}
//     }

//     $newkey = 19; // Positions Media in the old Links location.
//     $menu[$newkey]=$menu[$oldkey];
//     $menu[$oldkey]=array();
// }

// add_action( 'admin_menu', 'fsc_reorder_media_menu_item'  );


function fsc_gform_menu_position( $position ) {
    return 20;
}
add_filter( 'gform_menu_position', 'fsc_gform_menu_position' );


/**
 * Creates a variable for Show In Menu, to remove certain CPTs from Main Site.
 */
if ( get_current_blog_id() === 1 ) {
	$show_in_menu = false;
}

/**
 * Create all CPTs here:
 */
function fsc_post_types() {

	global $show_in_menu;

	// Add a Gutenberg Post Type Template to dictate what appears on Custom Post edit screen.
	// $template = array(

		// array( 'core/heading', 
		// 		array( 
		// 			'placeholder' => 'Add a section title ( e.g. Philosophy, Rates, Areas Served, Competitive Advantage',
		// 		) 
		// 	),

		// array( 'core/columns', 
		// 		array(), 
		// 		array(
		// 			array( 'core/image', 
		// 				array( 'layout' => 'column-1' ) 
		// 			),

		// 			array( 'core/paragraph', 
		// 				array( 'placeholder' => 'Add an inner paragraph',
		// 						'layout' => 'column-2'
		// 					) 
		// 			),
		// 		),
		// 	),

		// array( 'core/columns', 
		// 		array(), 
		// 		array(
		// 			array( 'core/gallery', 
		// 				array( 'layout' => 'column-1' 
		// 				) 
		// 			),

		// 			array( 'core/paragraph', 
		// 				array( 'placeholder' => 'Add an inner paragraph',
		// 					'layout' => 'column-2'
		// 				) 
		// 			),
		// 		),
		// 	),

		// array( 'core/columns', 
		// 		array(), 
		// 		array(
		// 			array( 'core/image', 
		// 				array( 'layout' => 'column-1' 
		// 				) 
		// 			),

		// 			array( 'core/paragraph', 
		// 				array( 'placeholder' => 'Add an inner paragraph',
		// 					'layout' => 'column-2'
		// 				) 
		// 			),
		// 		),
		// 	),
		// );

	// Register Services CPT.
	register_post_type( 'services',
		array(
			'labels'              => array(
				'name'               => __( 'Services', 'flaunt_sites_core' ), /* This is the Title of the Group */
				'singular_name'      => __( 'Service', 'flaunt_sites_core' ), /* This is the individual type */
				'all_items'          => __( 'All Custom Services', 'flaunt_sites_core' ), /* the all items menu item */
				'add_new'            => __( 'Add New', 'flaunt_sites_core' ), /* The add new menu item */
				'add_new_item'       => __( 'Add New Service', 'flaunt_sites_core' ), /* Add New Display Title */
				'edit'               => __( 'Edit', 'flaunt_sites_core' ), /* Edit Dialog */
				'edit_item'          => __( 'Edit Service', 'flaunt_sites_core' ), /* Edit Display Title */
				'new_item'           => __( 'New Service', 'flaunt_sites_core' ), /* New Display Title */
				'view_item'          => __( 'View Service', 'flaunt_sites_core' ), /* View Display Title */
				'search_items'       => __( 'Search C=Services', 'flaunt_sites_core' ), /* Search Custom Type Title */
				'not_found'          => __( 'Nothing found in the Database.', 'flaunt_sites_core' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'flaunt_sites_core' ), /* This displays if there is nothing in the trash */
				'parent_item_colon'  => '',
			), /* end of arrays */

			'description'         => __( 'This is the example Service', 'flaunt_sites_core' ), /* Custom Type Description */
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => $show_in_menu,
			'query_var'           => true,
			'menu_position'       => 11, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon'           => 'dashicons-camera', /* the icon for the custom post type menu */
			'rewrite'             => array( 'slug' => 'services', 'with_front' => true ), /* you can specify its url slug */
			'has_archive'         => false, /* you can rename the slug here */
			'capability_type'     => 'post',
			'hierarchical'        => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'revisions' ),
			'show_in_rest'        => true,
			// 'template' => $template,
			'template_lock'       => 'all',
		)
	);
	register_taxonomy_for_object_type( 'category', 'services' );

	// Register Reviews CPT.
	register_post_type( 'reviews',
		array(
			'labels'              => array(
				'name'               => __( 'Reviews', 'flaunt_sites_core' ), /* This is the Title of the Group */
				'singular_name'      => __( 'Review', 'flaunt_sites_core' ), /* This is the individual type */
				'all_items'          => __( 'All Custom Reviews', 'flaunt_sites_core' ), /* the all items menu item */
				'add_new'            => __( 'Add New', 'flaunt_sites_core' ), /* The add new menu item */
				'add_new_item'       => __( 'Add New Review', 'flaunt_sites_core' ), /* Add New Display Title */
				'edit'               => __( 'Edit', 'flaunt_sites_core' ), /* Edit Dialog */
				'edit_item'          => __( 'Edit Review', 'flaunt_sites_core' ), /* Edit Display Title */
				'new_item'           => __( 'New Review', 'flaunt_sites_core' ), /* New Display Title */
				'view_item'          => __( 'View Review', 'flaunt_sites_core' ), /* View Display Title */
				'search_items'       => __( 'Search Review', 'flaunt_sites_core' ), /* Search Custom Type Title */
				'not_found'          => __( 'Nothing found in the Database.', 'flaunt_sites_core' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'flaunt_sites_core' ), /* This displays if there is nothing in the trash */
				'parent_item_colon'  => '',
			), /* end of arrays */

			'description'         => __( 'This is the example Review', 'flaunt_sites_core' ), /* Custom Type Description */
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => $show_in_menu,
			'query_var'           => true,
			'menu_position'       => 14, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon'           => 'dashicons-star-empty', /* the icon for the custom post type menu */
			'rewrite'             => array( 'slug' => 'reviews', 'with_front' => true ), /* you can specify its url slug */
			'has_archive'         => 'reviews', /* you can rename the slug here */
			'capability_type'     => 'post',
			'hierarchical'        => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'show_in_nav_menus'   => false,
			'show_in_rest'        => true,
		) /* end of options */
	); /* end of register post type */
	register_taxonomy_for_object_type( 'category', 'reviews' );

	// Register Badges CPT.
	register_post_type( 'badges',
		array(
			'labels'              => array(
				'name'               => __( 'Badges', 'flaunt_sites_core' ), /* This is the Title of the Group */
				'singular_name'      => __( 'Badge', 'flaunt_sites_core' ), /* This is the individual type */
				'all_items'          => __( 'All Custom Badges', 'flaunt_sites_core' ), /* the all items menu item */
				'add_new'            => __( 'Add New', 'flaunt_sites_core' ), /* The add new menu item */
				'add_new_item'       => __( 'Add New Badge', 'flaunt_sites_core' ), /* Add New Display Title */
				'edit'               => __( 'Edit', 'flaunt_sites_core' ), /* Edit Dialog */
				'edit_item'          => __( 'Edit Badge', 'flaunt_sites_core' ), /* Edit Display Title */
				'new_item'           => __( 'New Badge', 'flaunt_sites_core' ), /* New Display Title */
				'view_item'          => __( 'View Badge', 'flaunt_sites_core' ), /* View Display Title */
				'search_items'       => __( 'Search Badge', 'flaunt_sites_core' ), /* Search Custom Type Title */
				'not_found'          => __( 'Nothing found in the Database.', 'flaunt_sites_core' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'flaunt_sites_core' ), /* This displays if there is nothing in the trash */
				'parent_item_colon'  => '',
			), /* end of arrays */

			'description'         => __( 'This is the example Badge', 'flaunt_sites_core' ), /* Custom Type Description */
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => $show_in_menu,
			'query_var'           => true,
			'menu_position'       => 15, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon'           => 'dashicons-awards', /* the icon for the custom post type menu */
			'rewrite'             => array( 'slug' => 'badges', 'with_front' => false ), /* you can specify its url slug */
			'has_archive'         => false, /* you can rename the slug here */
			'capability_type'     => 'post',
			'hierarchical'        => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky' ),
			'show_in_nav_menus'   => false,
			'show_in_rest'        => true,
		) /* end of options */
	); /* end of register post type */
}

add_action( 'init', 'fsc_post_types' );
