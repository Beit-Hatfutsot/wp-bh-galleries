<?php
/**
 * Logo
 *
 * @author		Nir Goldberg
 * @package		views/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

/**
 * Variables
 */
$logo_link	= get_field( 'acf-options_logo_link', 'option' );
$logo_title	= function_exists( 'pll__' ) ? pll__( 'pll_logo_title' ) : '';

if ( $logo_link ) { ?>

	<div class="logo-wrap">
		<a class="logo" href="<?php echo $logo_link; ?>" target="_blank" title="<?php echo $logo_title ?: ''; ?>"></a>
	</div>

<?php }