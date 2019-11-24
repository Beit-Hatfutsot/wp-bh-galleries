<?php
/**
 * Header title
 *
 * @author		Nir Goldberg
 * @package		views/header/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$header_title = function_exists( 'pll__' ) ? pll__( 'pll_header_title' ) : '';

?>

<div class="header-description hidden-xs">
	<div class="content">

		<?php echo ( $header_title ) ? '<h1>' . $header_title . '</h1>' : ''; ?>

	</div>
</div>