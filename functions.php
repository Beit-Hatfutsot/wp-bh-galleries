<?php
/**
 * Functions
 *
 * @author		Nir Goldberg
 * @version		1.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// theme configuration
require_once( 'functions/config.php' );

// theme support
require_once( 'functions/theme.php' );

// theme menus
require_once( 'functions/menus.php' );

// theme api
require_once( 'functions/api/filters.php' );
require_once( 'functions/api/upload.php' );

// scripts & styles registration
require_once( 'functions/scripts-n-styles.php' );

// admin header section
require_once( 'functions/admin/header.php' );	// should be outside is_admin() because of the login screen

if ( is_admin() ) {
	require_once( 'functions/admin/footer.php' );
}

// post types
require_once( 'functions/post-types.php' );
require_once( 'functions/taxonomies.php' );

// subjects
require_once( 'functions/subjects.php' );

// localization
require_once( 'functions/localization.php' );

// ACF configuration
require_once( 'functions/acf/acf-config.php' );

// ACF field groups
if ( ! defined( 'USE_LOCAL_ACF_CONFIGURATION' ) || ! USE_LOCAL_ACF_CONFIGURATION ) {
	require_once( 'functions/acf/acf-field-groups.php' );
}

// upload
require_once( 'functions/upload.php' );