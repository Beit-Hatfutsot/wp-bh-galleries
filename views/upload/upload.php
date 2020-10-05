<?php
/**
 * Upload wizard
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'pll_current_language' ) )
	return;

/**
 * Variables
 */
$rtl = is_rtl();

?>

<div class="upload-form content-offcanvas content-offcanvas-<?php echo $rtl ? 'right' : 'left'; ?>" style="display: none;">

	<?php
		/**
		 * Display form header
		 */
		get_template_part( 'views/upload/form-header' );
	?>

	<div class="step-content">

		<?php for ( $step = 1 ; $step <= 4 ; $step++ ) : ?>

			<?php
				/**
				 * Display step #
				 */
				get_template_part( 'views/upload/step', $step );
			?>

		<?php endfor; ?>

	</div><!-- .step-content -->

</div><!-- .upload-form -->