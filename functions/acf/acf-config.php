<?php
/**
 * ACF configuration functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * create options sub pages
 */
if ( function_exists( 'acf_add_options_sub_page' ) ) {

	acf_add_options_sub_page( 'Header' );
	acf_add_options_sub_page( 'Upload Form' );
	acf_add_options_sub_page( 'General' );

}