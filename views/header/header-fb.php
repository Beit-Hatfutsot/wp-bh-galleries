<?php
/**
 * Facebook Pixel
 *
 * @author		Nir Goldberg
 * @package		views/header
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

$fb_pixel_code = get_field( 'acf-options_facebook_pixel_code', 'option' );

if ( $fb_pixel_code ) : ?>

	<!-- Facebook Pixel -->
	<?php echo $fb_pixel_code;

endif;