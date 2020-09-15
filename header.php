<?php
/**
 * Theme header
 *
 * @author		Nir Goldberg
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<?php
		/**
		 * Display header meta
		 */
		get_template_part( 'views/header/header', 'meta' );
	?>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<?php
			/**
			 * Display header main
			 */
			get_template_part( 'views/header/header', 'main' );
		?>