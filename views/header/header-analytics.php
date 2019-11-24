<?php
/**
 * Google Analytics
 *
 * @author		Nir Goldberg
 * @package		views/header
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

$analytics_tracking_code = get_field( 'acf-options_google_analytics_tracking_code', 'option' );

if ( $analytics_tracking_code ) : ?>

	<!-- Google Analytics -->
	<?php echo $analytics_tracking_code;

endif;