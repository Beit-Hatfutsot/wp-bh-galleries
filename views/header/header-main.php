<?php
/**
 * Header main
 *
 * @author		Nir Goldberg
 * @package		views/header
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$rtl = is_rtl();

?>

<div class="desktop-logo hidden-xs">

	<?php
		/**
		 * Display desktop logo
		 */
		get_template_part( 'views/components/logo' );
	?>

</div>

<?php
	/**
	 * Display sidebar filters
	 */
	get_template_part( 'views/sidebar/sidebar', 'filters' );
?>

<section class="main-content content-offcanvas content-offcanvas-<?php echo $rtl ? 'right' : 'left'; ?>">

	<header>

		<div class="navbar navbar-default navbar-fixed-top" role="navigation">

			<button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target=".sidebar-filters">
				<span class="sr-only">Toggle navigation</span>
				<span class="glyphicon glyphicon-tasks"></span>
			</button>

			<?php
				/**
				 * Display upload button
				 */
				get_template_part( 'views/header/components/upload' );
			?>

			<div class="mobile-logo visible-xs">

				<?php
					/**
					 * Display mobile logo
					 */
					get_template_part( 'views/components/logo' );
				?>

			</div>

			<?php
				/**
				 * Display header title
				 */
				get_template_part( 'views/header/components/title' );
			?>

		</div><!-- .navbar -->

	</header>