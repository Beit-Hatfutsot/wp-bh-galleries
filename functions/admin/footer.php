<?php
/**
 * Admin footer functions
 *
 * @author		Nir Goldberg
 * @package		functions/admin
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_footer_text
 *
 * This function tweaks admin footer text
 *
 * @param	N/A
 * @return	(string)
 */
function BH_footer_text() {

	// return
	return "<span id=\"footer-thankyou\">By <a href=\"http://www.htmline.com/\" target=\"_blank\">HTMLine - בניית אתרים</a>.</span>";

}
add_action( 'admin_footer_text', 'BH_footer_text' );