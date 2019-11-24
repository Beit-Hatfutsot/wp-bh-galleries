<?php
/**
 * Upload wizard - step 2
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// set step strings
$fb_logged_in		= pll__( 'pll_facebook_logged_in' );
$fb_app_logged_in	= pll__( 'pll_facebook_app_logged_in' );
$fb_logged_out		= pll__( 'pll_facebook_logged_out' );
$next				= pll__( 'pll_next' );
$cancel				= pll__( 'pll_cancel' );

?>

<div class="step step2" style="display: none;">

	<div class="connect-to-fb-msg"></div>

	<div class="connect-to-fb"></div>

	<div class="btn-submit btn-submit-step2">

		<div class="btn btn-blue submit-step"><?php echo $next ?: ''; ?></div>
		<div class="loader">

			<?php
				/**
				 * Display loader
				 */
				get_template_part( 'views/upload/loader' );
			?>

		</div>
		<div class="clear"><?php echo $cancel ?: ''; ?></div>

	</div>

</div><!-- .step.step2 -->