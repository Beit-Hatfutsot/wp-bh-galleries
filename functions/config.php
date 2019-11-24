<?php
/**
 * Configuration functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// theme version is used to register styles and scripts
if ( function_exists( 'wp_get_theme' ) ) :

	$theme_data = wp_get_theme();
	$theme_version = $theme_data->get( 'Version' );

else :

	$theme_data = get_theme_data( trailingslashit( get_stylesheet_directory() ) . 'style.css' );
	$theme_version = $theme_data[ 'Version' ];

endif;

define( 'VERSION', $theme_version );

// other
define( 'TEMPLATE',				get_bloginfo( 'template_directory' ) );
define( 'HOME',					home_url( '/' ) );
define( 'UPLOAD_TMP_PATH',		ABSPATH . 'wp-content/uploads_temp/' );
define( 'UPLOAD_TMP_DIR',		HOME . 'wp-content/uploads_temp/' );
define( 'UPLOAD_DIR',			wp_get_upload_dir()[ 'url' ] );
define( 'CSS_DIR',				TEMPLATE . '/assets/css' );
define( 'JS_DIR',				TEMPLATE . '/assets/js' );

// create upload_temp
if ( ! file_exists( UPLOAD_TMP_PATH ) ) {
	mkdir( UPLOAD_TMP_PATH, 0755, true );
}

/**
 * BH_set_globals
 *
 * This function sets globals after theme is loaded
 *
 * @param	N/A
 * @return	N/A
 */
function BH_set_globals() {

	/**
	 * Globals
	 */
	global $globals;

	$globals = array(
		'google_fonts'		=> [],
		'languages'			=> [],
		'lang'				=> '',
		'translated_lang'	=> '',
	);

	if ( function_exists( 'pll_current_language' ) ) {

		$languages = pll_the_languages( array( 'raw' => 1 ) );

		if ( $languages ) {
			foreach ( $languages as $lang ) {

				$globals[ 'languages' ][ $lang[ 'slug' ] ] = array(
					'name'	=> $lang[ 'name' ],
					'url'	=> $lang[ 'url' ],
					'flag'	=> $lang[ 'flag' ],
				);

			}
		}

		$globals[ 'lang' ]				= pll_current_language();
		$globals[ 'translated_lang' ]	= 'en' == $globals[ 'lang' ] ? 'he' : 'en';

	}

}
add_action( 'wp_body_open', 'BH_set_globals' );