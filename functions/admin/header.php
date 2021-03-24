<?php
/**
 * Admin header functions
 *
 * @author		Nir Goldberg
 * @package		functions/admin
 * @version		1.2.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_admin_head
 *
 * This function loads admin scripts and styles
 *
 * @param	N/A
 * @return	N/A
 */
function BH_admin_head() {

	wp_enqueue_style( 'admin-general' );

}
add_action( 'admin_head', 'BH_admin_head' );

/**
 * BH_login_screen
 *
 * This function tweaks login screen
 *
 * @param	N/A
 * @return	N/A
 */
function BH_login_screen() {

	wp_enqueue_style( 'admin-login' );

}
add_action( 'login_head', 'BH_login_screen' );

/**
 * BH_login_logo_url
 *
 * This function tweaks login header URL
 *
 * @param	N/A
 * @return	(string)
 */
function BH_login_logo_url() {

	// return
	return HOME;

}
add_filter( 'login_headerurl', 'BH_login_logo_url' );

/**
 * BH_login_logo_url_title
 *
 * This function tweaks login header title
 *
 * @param	N/A
 * @return	(string)
 */
function BH_login_logo_url_title() {

	// return
	return get_bloginfo( 'name' );

}
add_filter( 'login_headertitle', 'BH_login_logo_url_title' );