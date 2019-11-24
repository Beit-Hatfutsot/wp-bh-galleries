<?php
/**
 * Post types functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_register_posttypes
 *
 * This function registers post types
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_posttypes() {

	BH_register_posttype_photo();

}
add_action( 'init', 'BH_register_posttypes' );

/**
 * BH_register_posttype_photo
 *
 * This function registers photo post type
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_posttype_photo() {

	$labels = array(
		'name'					=> __( 'Photos' ),
		'singular_name'			=> __( 'Photo' ),
		'menu_name'				=> __( 'Photos' ),
		'all_items'				=> __( 'All Photos' ),
		'add_new'				=> __( 'Add New' ),
		'add_new_item'			=> __( 'Add New Photo' ),
		'edit_item'				=> __( 'Edit Photo' ),
		'new_item'				=> __( 'New Photo' ),
		'view_item'				=> __( 'View Photo' ),
		'search_items'			=> __( 'Search Photos' ),
		'not_found'				=> __( 'No Photos Found' ),
		'not_found_in_trash'	=> __( 'No Photos Found in Trash' ),
		'parent_item_colon'		=> __( '' ),
	);

	$args = array(
		'labels'				=> $labels,
		'public'				=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'show_in_nav_menus'		=> true,
		'show_in_menu'			=> true,
		'show_in_admin_bar'		=> true,
		'menu_position'			=> 25,
		'menu_icon'				=> 'dashicons-format-image',
		'capability_type'		=> 'post',
		'hierarchical'			=> false,
		'supports'				=> array( 'title' ),
		'taxonomies'			=> array(),
		'has_archive'			=> false,
		'rewrite'				=> array( 'slug' => 'photo', 'with_front' => false ),
		'query_var'				=> true
	);

	register_post_type( 'photo', $args );

}