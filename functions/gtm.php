<?php
/**
 * Google Tag Manager script
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * gtm_head
 *
 * This function displays the GTM head part
 *
 * @param	N/A
 * @return	N/A
 */
function BH_gtm_head() {

	if ( ! function_exists( 'get_field' ) )
		return;

	$gtm_id = get_field( 'acf-options_gtm_id', 'option' );

	if ( ! $gtm_id )
		return;

	echo "<!-- Google Tag Manager -->
		 <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		 new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		 j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		 })(window,document,'script','dataLayer','" . $gtm_id . "');</script>
		 <!-- End Google Tag Manager -->";

}

/**
 * gtm_body
 *
 * This function displays the GTM body part
 *
 * @param	N/A
 * @return	N/A
 */
function BH_gtm_body() {

	if ( ! function_exists( 'get_field' ) )
		return;

	$gtm_id = get_field( 'acf-options_gtm_id', 'option' );

	if ( ! $gtm_id )
		return;

	echo '<!-- Google Tag Manager (noscript) -->
		 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $gtm_id . '"
		 height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		 <!-- End Google Tag Manager (noscript) -->';

}
add_action( 'wp_body_open', 'BH_gtm_body' );