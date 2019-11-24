<?php
/**
 * 404.php
 *
 * @author		Nir Goldberg
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

/**
 * Display 404 content
 */
get_template_part( 'views/page/404' );

get_footer();