<?php
/**
 * Upload wizard - step 3
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// set step strings
$share				= pll__( 'pll_share' );
$no_thanks			= pll__( 'pll_no_thanks' );

?>

<div class="step step3" style="display: none;">

	<div class="photo-share">

		<div class="photo-share-preview"></div>

	</div><!-- .photo-share -->

	<div class="btn-submit btn-submit-step3">

		<div class="btn btn-blue submit-step fb-share-button" data-layout="button" data-size="large">
			<a class="fb-xfbml-parse-ignore" target="_blank"><?php echo $share ?: ''; ?></a>
		</div>
		<div class="loader">

			<?php
				/**
				 * Display loader
				 */
				get_template_part( 'views/upload/loader' );
			?>

		</div>
		<div class="clear"><?php echo $no_thanks ?: ''; ?></div>

	</div>

</div><!-- .step.step3 -->