<?php
/**
 * Upload functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_get_attachment_id_from_src
 *
 * This function gets attachment ID by source
 *
 * @param	$src (string) attachment source
 * @return	(int)
 */
function BH_get_attachment_id_from_src( $src ) {

	/**
	 * Globals
	 */
	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$src'";
	$id = $wpdb->get_var( $query );

	// return
	return $id;

}

/**
 * BH_delete_associated_media
 *
 * This function deletes media files upon post deletion
 *
 * @param	$post_id (int) Post ID
 * @return	N/A
 */
function BH_delete_associated_media( $post_id ) {

	/**
	 * Globals
	 */
	global $post_type;

	if ( 'photo' != $post_type )
		return;

	$media = get_children( array(
		'post_parent'	=> $post_id,
		'post_type'		=> 'attachment'
	) );

	if ( empty( $media ) )
		return;

	foreach ( $media as $file ) :
		wp_delete_attachment( $file->ID );
	endforeach;

}
add_action( 'before_delete_post', 'BH_delete_associated_media' );