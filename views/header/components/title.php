<?php
/**
 * Header title
 *
 * @author		Nir Goldberg
 * @package		views/header/components
 * @version		1.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'pll__' ) )
	return;

/**
 * Variables
 */
$header_title	= pll__( 'pll_header_title' );

?>

<div class="header-description hidden-xs">
	<div class="menu">

		<?php wp_nav_menu( 'main-menu' ); ?>

	</div><!-- .menu -->

	<div class="content">

		<?php echo ( $header_title ) ? '<a href="' . pll_home_url() . '"><h1>' . $header_title . '</h1></a>' : ''; ?>

	</div>
</div>