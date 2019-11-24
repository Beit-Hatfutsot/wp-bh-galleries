<?php
/**
 * Taxonomies functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_register_taxonomies
 *
 * This function registers taxonomies
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_taxonomies() {

	BH_register_taxonomy_subject();
	BH_register_taxonomy_country();

}
add_action( 'init', 'BH_register_taxonomies' );

/**
 * BH_register_taxonomy_subject
 *
 * This function registers subject taxonomy
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_taxonomy_subject() {

	$labels = array(
		'name'							=> __( 'Subjects' ),
		'singular_name'					=> __( 'Subject' ),
		'menu_name'						=> __( 'Subjects' ),
		'all_items'						=> __( 'All Subjects' ),
		'edit_item'						=> __( 'Edit Subject' ),
		'view_item'						=> __( 'View Subject' ),
		'update_item'					=> __( 'Update Subject' ),
		'add_new_item'					=> __( 'Add New Subject' ),
		'new_item_name'					=> __( 'New Subject Name' ),
		'parent_item'					=> __( 'Parent Subject' ),
		'parent_item_colon'				=> __( 'Parent Subject:' ),
		'search_items'					=> __( 'Search Subjects' ),
		'popular_items'					=> __( 'Popular Subjects' ),
		'separate_items_with_commas'	=> __( 'Separate Subjects with commas' ),
		'add_or_remove_items'			=> __( 'Add or remove Subjects' ),
		'choose_from_most_used'			=> __( 'Choose from the most used Subjects' ),
		'not_found'						=> __( 'No Subjects found' )
	);

	$args = array(
		'labels'						=> $labels,
		'public'						=> true,
		'show_ui'						=> true,
		'show_in_nav_menus'				=> true,
		'show_tagcloud'					=> true,
		'show_admin_column'				=> true,
		'hierarchical'					=> true,
		'query_var'						=> true,
		'rewrite'						=> array(
				'slug'					=> 'subject',
				'with_front'			=> false,
				'hierarchical'			=> false
		)
	);

	register_taxonomy( 'subject', 'photo', $args );

}

/**
 * BH_register_taxonomy_country
 *
 * This function registers country taxonomy
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_taxonomy_country() {

	$labels = array(
		'name'							=> __( 'Countries' ),
		'singular_name'					=> __( 'Country' ),
		'menu_name'						=> __( 'Countries' ),
		'all_items'						=> __( 'All Countries' ),
		'edit_item'						=> __( 'Edit Country' ),
		'view_item'						=> __( 'View Country' ),
		'update_item'					=> __( 'Update Country' ),
		'add_new_item'					=> __( 'Add New Country' ),
		'new_item_name'					=> __( 'New Country Name' ),
		'parent_item'					=> __( 'Parent Country' ),
		'parent_item_colon'				=> __( 'Parent Country:' ),
		'search_items'					=> __( 'Search Countries' ),
		'popular_items'					=> __( 'Popular Countries' ),
		'separate_items_with_commas'	=> __( 'Separate Countries with commas' ),
		'add_or_remove_items'			=> __( 'Add or remove Countries' ),
		'choose_from_most_used'			=> __( 'Choose from the most used Countries' ),
		'not_found'						=> __( 'No Countries found' )
	);

	$args = array(
		'labels'						=> $labels,
		'public'						=> true,
		'show_ui'						=> true,
		'show_in_nav_menus'				=> true,
		'show_tagcloud'					=> true,
		'show_admin_column'				=> true,
		'hierarchical'					=> true,
		'query_var'						=> true,
		'rewrite'						=> array(
				'slug'					=> 'country',
				'with_front'			=> false,
				'hierarchical'			=> false
		)
	);

	register_taxonomy( 'country', 'photo', $args );

}

/**
 * BH_tax_filter_list
 *
 * This function adds taxonomies filter option for admin columns
 *
 * @param	$post_type (string)
 * @return	N/A
 */
function BH_tax_filter_list( $post_type ) {

	if ( 'photo' != $post_type )
		return;

	$taxonomies = array(

		'subject'	=> 'Subjects',
		'country'	=> 'Countries',

	);

	foreach ( $taxonomies as $slug => $name ) :

		wp_dropdown_categories(
			array(
				'show_option_all'	=> 'Show All ' . $name,
				'taxonomy'			=> $slug,
				'name'				=> $slug,
				'orderby'			=> 'name',
				'value_field'		=> 'slug',
				'selected'			=> ( isset( $_REQUEST[ $slug ] ) ? $_REQUEST[ $slug ] : '' ),
				'hierarchical'		=> true,
				'show_count'		=> true,
				'hide_empty'		=> false,
			)
		);

	endforeach;

}
add_action( 'restrict_manage_posts', 'BH_tax_filter_list' );