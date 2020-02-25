<?php
/**
 * Theme menus
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Globals
 */
global $globals;

// menu theme locations

$globals[ 'menus' ] = array(
	'main-menu' => __( 'Main Menu' ),
);

/**
 * BH_register_menus
 *
 * This function registers theme menus
 *
 * @param	N/A
 * @return	N/A
 */
function BH_register_menus() {

	/**
	 * Globals
	 */
	global $globals;

	if ( ! $globals[ 'menus' ] )
		return;

	register_nav_menus( $globals[ 'menus' ] );

}
add_action( 'after_setup_theme', 'BH_register_menus' );