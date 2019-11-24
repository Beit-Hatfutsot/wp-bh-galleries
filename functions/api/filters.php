<?php
/**
 * Filters API functions
 *
 * @author		Nir Goldberg
 * @package		api
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_subject_filter
 *
 * This function returns top subjects children
 *
 * @since		1.0.0
 * @param		N/A
 * @return		N/A
 */
function BH_subject_filter() {

	// check nonce
	if ( ! wp_verify_nonce( $_REQUEST[ 'nonce' ], 'subject_filter' ) ) {
		exit();
	}

	/**
	 * Variables
	 */
	$selectedOptionsIds		= $_REQUEST[ 'selectedOptionsIds' ];
	$subsubjects			= [];

	if ( $selectedOptionsIds ) {

		foreach ( $selectedOptionsIds as $id ) {

			$terms = get_terms( array(
				'taxonomy'	=> 'subject',
				'parent'	=> $id,
			) );

			if ( ! is_wp_error( $terms ) && $terms ) {
				$subsubjects = array_merge( $subsubjects, $terms );
			}

		}

	}
	else {

		$terms = get_terms( array(
			'taxonomy'	=> 'subject',
		) );

		if ( ! is_wp_error( $terms ) && $terms ) {
			foreach ( $terms as $term ) {
				if ( $term->parent !== 0 ) {
					array_push( $subsubjects, $term );
				}
			}
		}

	}

	// Check if action was fired via Ajax call. If yes, JS code will be triggered, else the user will be redirected to the post page
	if ( ! empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && 'xmlhttprequest' == strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) ) {

		$result = json_encode( $subsubjects );
		echo $result;

	}
	else {

		header( "Location: " . $_SERVER[ "HTTP_REFERER" ] );

	}

	// die
	die();

}
add_action( 'wp_ajax_subject_filter',			'BH_subject_filter' );
add_action( 'wp_ajax_nopriv_subject_filter',	'BH_subject_filter' );

/**
 * BH_query_photos
 *
 * This function returns images-grid HTML with queried photos
 *
 * @since		1.0.0
 * @param		N/A
 * @return		N/A
 */
function BH_query_photos() {

	// check nonce
	if ( ! wp_verify_nonce( $_REQUEST[ 'nonce' ], 'filters' ) ) {
		exit();
	}

	/**
	 * Variables
	 */
	$countries		= $_REQUEST[ 'countries' ];
	$years			= $_REQUEST[ 'years' ];
	$subjects		= $_REQUEST[ 'subjects' ];
	$subsubjects	= $_REQUEST[ 'subsubjects' ];
	$photos			= [];

	// query photos
	$args = array(
		'post_type'			=> 'photo',
		'posts_per_page'	=> -1,
		'tax_query'			=> array(
			'relation'		=> 'AND',
		),
		'meta_query'		=> array(
			'relation'		=> 'AND',
		),
	);

	if ( $countries ) {
		array_push( $args[ 'tax_query' ], array(
			'taxonomy'	=> 'country',
			'terms'		=> (array) $countries,
		) );
	}

	if ( $years ) {
		array_push( $args[ 'meta_query' ], array(
			'key'		=> 'acf-photo_year',
			'value'		=> $years,
			'compare'	=> 'IN',
			'type'		=> 'NUMERIC',
		) );
	}

	if ( $subjects ) {
		array_push( $args[ 'tax_query' ], array(
			'taxonomy'	=> 'subject',
			'terms'		=> (array) $subjects,
		) );
	}

	if ( $subsubjects ) {
		array_push( $args[ 'tax_query' ], array(
			'taxonomy'	=> 'subject',
			'terms'		=> (array) $subsubjects,
		) );
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

		if ( get_field( 'acf-photo_image' ) ) {
			$photos[] = get_the_ID();
		}

	endwhile; endif; wp_reset_postdata();

	/**
	 * Display images grid
	 */
	include( locate_template( 'views/components/images-grid.php' ) );

	// die
	die();

}
add_action( 'wp_ajax_query_photos',			'BH_query_photos' );
add_action( 'wp_ajax_nopriv_query_photos',	'BH_query_photos' );