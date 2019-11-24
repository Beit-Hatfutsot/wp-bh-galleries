<?php
/**
 * Upload wizard - step 1
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// set step strings
$drop_image		= pll__( 'pll_drop_image' );
$or				= pll__( 'pll_or' );
$select_file	= pll__( 'pll_select_file' );
$next			= pll__( 'pll_next' );
$clear			= pll__( 'pll_clear' );

?>

<div class="step step1">

	<div id="drag-drop-area">

		<div class="drag-drop-inside">
			<p class="drag-drop-info"><?php echo $drop_image ?: ''; ?></p>
			<p><?php echo $or ?: ''; ?></p>

			<input id="browse-button" type="button" value="<?php echo $select_file ?: ''; ?>" class="button" />
			<span id="filename"></span>
			<input type="file" name="fileToUpload" id="fileToUpload" />

			<div class="step-msg step-msg1"></div>
		</div>
		<div class="image-preview"></div>

	</div>

	<div class="btn-submit btn-submit-step1">

		<div class="btn btn-blue submit-step"><?php echo $next ?: ''; ?></div>
		<div class="loader">

			<?php
				/**
				 * Display loader
				 */
				get_template_part( 'views/upload/loader' );
			?>

		</div>
		<div class="clear"><?php echo $clear ?: ''; ?></div>

	</div>

</div><!-- .step.step1 -->