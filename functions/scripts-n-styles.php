<?php
/**
 * Scripts and styles functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'login_enqueue_scripts',	'BH_login_scripts_n_styles' );
add_action( 'admin_enqueue_scripts',	'BH_admin_scripts_n_styles' );
add_action( 'wp_enqueue_scripts',		'BH_wp_scripts_n_styles' );

add_filter( 'mce_css', 'BH_editor_style' );

/**
 * BH_login_scripts_n_styles
 *
 * This function registers login screen scripts and styles
 *
 * @param	N/A
 * @return	N/A
 */
function BH_login_scripts_n_styles() {

	wp_register_style( 'admin-login',	CSS_DIR . '/admin/login.css',	array(),	VERSION );

}

/**
 * BH_admin_scripts_n_styles
 *
 * This function registers admin scripts and styles
 *
 * @param	N/A
 * @return	N/A
 */
function BH_admin_scripts_n_styles() {

	wp_register_style( 'admin-general',		CSS_DIR . '/admin/general.css',						array(),							VERSION );

}

/**
 * BH_wp_scripts_n_styles
 *
 * This function registers frontend scripts and styles
 *
 * @param	N/A
 * @return	N/A
 */
function BH_wp_scripts_n_styles() {

	/**
	 * Styles
	 */
	wp_enqueue_style( 'bootstrap',			CSS_DIR . '/libs/bootstrap.min.css',				array(),							VERSION );
	wp_enqueue_style( 'fancybox',			CSS_DIR . '/libs/fancybox.css',						array( 'bootstrap' ),				VERSION );
	wp_enqueue_style( 'BH_imgareaselect',	CSS_DIR . '/libs/imgareaselect-default.css',		array( 'bootstrap' ),				VERSION );
	wp_enqueue_style( 'BH_chosen',			CSS_DIR . '/libs/chosen.min.css',					array( 'bootstrap' ),				VERSION );
	wp_enqueue_style( 'general',			CSS_DIR . '/general.css',							array( 'bootstrap' ),				VERSION );
	wp_enqueue_style( 'main',				CSS_DIR . '/main.css',								array( 'bootstrap' ),				VERSION );

	if ( is_rtl() ) {
		wp_enqueue_style( 'rtl',			CSS_DIR . '/rtl.css',								array( 'bootstrap' ),				VERSION );
	}

	/**
	 * Scripts
	 */
	wp_enqueue_script( 'bootstrap',			JS_DIR . '/libs/bootstrap.min.js',					array( 'jquery' ),					VERSION,	true );
	wp_enqueue_script( 'fancybox',			JS_DIR . '/libs/fancybox.js',						array( 'jquery', 'bootstrap' ),		VERSION,	true );
	wp_enqueue_script( 'BH_imgareaselect',	JS_DIR . '/libs/jquery.imgareaselect.min.js',		array( 'jquery', 'bootstrap' ),		VERSION,	true );
	wp_enqueue_script( 'BH_chosen',			JS_DIR . '/libs/chosen.jquery.min.js',				array( 'jquery', 'bootstrap' ),		VERSION,	true );
	wp_enqueue_script( 'general',			JS_DIR . '/min/general.min.js',						array( 'jquery', 'bootstrap' ),		VERSION,	true );
	wp_enqueue_script( 'main',				JS_DIR . '/min/main.min.js',						array( 'jquery', 'bootstrap' ),		VERSION,	true );
	wp_enqueue_script( 'upload',			JS_DIR . '/min/upload.min.js',						array( 'jquery', 'bootstrap' ),		VERSION,	true );
	wp_enqueue_script( 'sidebar_filters',	JS_DIR . '/min/sidebar_filters.min.js',		        array( 'jquery', 'bootstrap' ),		VERSION,	true );

	// localize general
	$translation_arr		= array(
		'ajaxurl'			=> admin_url( 'admin-ajax.php' ),
		'settings'			=> array(
			'template'		=> TEMPLATE,
			'lang'			=> function_exists( 'pll_current_language' ) ? pll_current_language() : '',
		),
		'subjects_logos'	=> BH_get_subjects_logos(),
	);

	if ( function_exists( 'pll__' ) ) {
		$translation_arr[ 'strings' ] = array(
			'by_str'		=> pll__( 'pll_by_label' ),
			'subject_str'	=> pll__( 'pll_subject_label' ),
			'country_str'	=> pll__( 'pll_country_label' ),
		);
	}
	wp_localize_script( 'general', '_BH_General', $translation_arr );

}

/**
 * BH_editor_style
 *
 * This function declares tinyMCE styles
 *
 * @param	N/A
 * @return	(string)
 */
function BH_editor_style( $styles ) {

	$styles .= ', ' . CSS_DIR . '/admin/editor.css';

	/**
	 * Google Fonts
	 */
	global $globals;

	if ( $globals[ 'google_fonts' ] ) {
		foreach ( $globals[ 'google_fonts' ] as $font ) {
			$font_style = str_replace( ',', '&#44', $font );
			$styles .= ', ' . $font_style;
		}
	}

	// return
	return $styles;

}