<?php
/**
 * Upload API functions
 *
 * @author		Nir Goldberg
 * @package		api
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_upload_photo
 *
 * This function uploads a new photo via frontend wizard
 *
 * @since		1.0.0
 * @param		N/A
 * @return		N/A
 */
function BH_upload_photo() {

	// check nonce
	if ( ! wp_verify_nonce( $_REQUEST[ 'nonce' ], 'upload_photo' ) ) {
		exit();
	}

	/**
	 * Variables
	 */
	$image					= $_REQUEST[ 'image' ];
	$thumbnail				= $_REQUEST[ 'thumbnail' ];
	$name					= $_REQUEST[ 'name' ];
	$email					= $_REQUEST[ 'email' ];
	$country				= $_REQUEST[ 'country' ];
	$subjects				= $_REQUEST[ 'subjects' ];
	$unassigned_subjects	= $_REQUEST[ 'unassigned_subjects' ];
	$title					= $_REQUEST[ 'title' ];
	$year					= $_REQUEST[ 'year' ];
	$description			= $_REQUEST[ 'description' ];
	$lang					= $_REQUEST[ 'lang' ];

	$result = array(
		'status'			=> '',
		'msg'				=> '',
		'country'			=> '',
		'year'				=> '',
		'subjects'			=> [],
		'url'				=> '',
	);

	// include wordpress core files
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// init unique ID
	$id = uniqid();

	if ( $image && $name && $email && $country && ($subjects || $unassigned_subjects) && $title && $year ) :

		// create a new post
		$args = array(
			'post_title'	=> sanitize_text_field( $name . '_' . $title ),
			'post_name'		=> sanitize_title_with_dashes( $name . '-' . $id ),
			'post_status'	=> 'publish',
			'post_author'	=> 1,
			'post_type'		=> 'photo',
		);
		$post_id = wp_insert_post( $args );

		if ( is_wp_error( $post_id ) ) {

			// build result
			$result[ 'status' ]	= $post_id->get_error_code();
			$result[ 'msg' ]	= $post_id->get_error_message();

			$result = json_encode( $result );
			echo $result;

			// die
			die();

		}

		// update post ACF fields
		update_field( 'field_52f75743c9b94', sanitize_text_field( $name ),	$post_id );
		update_field( 'field_5dcc6b7675746', sanitize_email( $email ),		$post_id );
		update_field( 'field_5dcc6bf175747', sanitize_text_field( $title ),	$post_id );
		update_field( 'field_5dcc6c5c75748', sanitize_text_field( $year ),	$post_id );

		if ( $unassigned_subjects )		update_field( 'field_52f7857bac76a', $unassigned_subjects,						$post_id );
		if ( $description )				update_field( 'field_52f758e0c9b98', sanitize_textarea_field( $description ),	$post_id );

		// country post taxonomy
		$country = sanitize_text_field( $country );
		$country_term = term_exists( $country, 'country' );

		if ( ! $country_term ) {

			$term = wp_insert_term( $country, 'country' );

			if ( is_wp_error( $term ) ) {

				// build result
				$result[ 'status' ]	= $post_id->get_error_code();
				$result[ 'msg' ]	= $post_id->get_error_message();

				$result = json_encode( $result );
				echo $result;

				// die
				die();

			}

		}

		// update post taxonomies
		$country_term = get_term_by( 'name', $country, 'country' );

		wp_set_post_terms( $post_id, $country_term->term_id, 'country', true );

		if ( $subjects ) {

			if ( function_exists( 'pll_languages_list' ) ) {

				$languages = pll_languages_list();

				if ( $languages ) {

					$translated_subjects = [];

					foreach ( $subjects as $subject ) {
						foreach ( $languages as $l ) {
							if ( $l != $lang ) {

								$translated_subject = pll_get_term( $subject, $l );

								if ( $translated_subject ) {
									$translated_subjects[] = $translated_subject;
								}

							}
						}
					}

				}

			}

			wp_set_post_terms( $post_id, $subjects, 'subject', true );

			if ( $translated_subjects ) {
				wp_set_post_terms( $post_id, $translated_subjects, 'subject', true );
			}
		}

		// build result
		$result[ 'country' ]	= $country_term->term_id;
		$result[ 'year' ]		= $year;
		$result[ 'subjects' ]	= $subjects;

		// build image
		$image_data_start	= strpos( $image, ',' );
		$image_meta			= substr( $image, 0, $image_data_start);
		$image_ext			= substr( $image_meta, strpos( $image_meta, '/' ) + 1, strpos( $image_meta, ';' ) - strpos( $image_meta, '/') - 1 );
		$image_data			= substr( $image, $image_data_start + 1 );

		$image_data			= str_replace( ' ', '+', $image_data );
		$data				= base64_decode( $image_data );

		$file				= UPLOAD_TMP_PATH . $id . '-img.' . $image_ext;
		$image_result		= file_put_contents( $file, $data );

		$public_file		= UPLOAD_TMP_DIR . $id . '-img.' . $image_ext;

		if ( $image_result !== false ) :

			// upload image
			$image_attachment_result = media_sideload_image( $public_file, $post_id, $user_name . '-img-' . $id );

			if ( ! is_wp_error( $image_attachment_result ) ) {

				$image_src = str_replace( 'uploads_temp', 'uploads', $public_file );

				// get the attachment ID
				$image_attachment_id = BH_get_attachment_id_from_src( $image_src );

				if ( $image_attachment_id ) {
					update_field( 'field_52f757d5c9b95', $image_attachment_id, $post_id );
				}

			}

			unlink( $file );

			// update result with url
			$result[ 'url' ] = UPLOAD_DIR . '/' . $id . '-img.' . $image_ext;

		endif;

		if ( ! is_wp_error( $image_attachment_result ) && $thumbnail ) :

			// build thumbnail
			$image_data_start	= strpos( $thumbnail, ',' );
			$image_meta			= substr( $thumbnail, 0, $image_data_start );
			$image_ext			= substr( $image_meta, strpos( $image_meta, '/' ) + 1, strpos( $image_meta, ';' ) - strpos( $image_meta, '/' ) - 1 );
			$image_data			= substr( $thumbnail, $image_data_start + 1 );

			$image_data			= str_replace( ' ', '+', $image_data );
			$data				= base64_decode( $image_data );

			$file				= UPLOAD_TMP_PATH . $id . '-thumb.' . $image_ext;
			$thumb_result		= file_put_contents( $file, $data );

			$public_file		= UPLOAD_TMP_DIR . $id . '-thumb.' . $image_ext;

			if ( $thumb_result !== false ) :

				// upload image
				$thumb_attachment_result = media_sideload_image( $public_file, $post_id, $user_name . '-thumb-' . $id );

				if ( ! is_wp_error( $thumb_attachment_result ) ) {

					$thumb_src = str_replace( 'uploads_temp', 'uploads', $public_file );

					// get the attachment ID
					$thumb_attachment_id = BH_get_attachment_id_from_src( $thumb_src );

					if ( $thumb_attachment_id ) {
						update_field( 'field_52f7584bc9b96', $thumb_attachment_id, $post_id );
					}

				}

				unlink( $file );

			endif;

		endif;

	endif;

	if ( ! is_wp_error( $image_attachment_result ) && ! is_wp_error( $thumb_attachment_result ) ) :

		$result[ 'status' ]	= 0;
		$result[ 'msg' ]	= 'Success! Uploaded both image and thumbnail';

	elseif ( ! is_wp_error( $image_attachment_result ) ) :

		$result[ 'status' ]	= 1;
		$result[ 'msg' ]	= 'Success! Uploaded only image';

	else :

		$result[ 'status' ]	= 2;
		$result[ 'msg' ]	= 'Error! No image uploaded';

	endif;

	$result = json_encode( $result );
	echo $result;

	// die
	die();

}
add_action( 'wp_ajax_upload_photo',			'BH_upload_photo' );
add_action( 'wp_ajax_nopriv_upload_photo',	'BH_upload_photo' );