<?php
/**
 * Upload wizard - form header
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// set header strings
$form_title		= pll__( 'pll_form_title' );
$step1_title	= pll__( 'pll_step1_title' );
$step2_title	= pll__( 'pll_step2_title' );
$step3_title	= pll__( 'pll_step3_title' );
$step4_title	= pll__( 'pll_step4_title' );
$step_indicator	= pll__( 'pll_step_indicator' );

?>

<div class="form-header">

	<div class="form-title"><?php echo $form_title ?: ''; ?></div>

	<div class="step-indicator-wrap">
		<?php if ( $step_indicator ) : ?>
			<span class="step-indicator step-indicator1 active"><?php printf( $step_indicator, '1', '4' ); ?></span>
			<span class="step-indicator step-indicator2"><?php printf( $step_indicator, '2', '4' ); ?></span>
			<span class="step-indicator step-indicator3"><?php printf( $step_indicator, '3', '4'); ?></span>
			<span class="step-indicator step-indicator4"><?php printf( $step_indicator, '4', '4'); ?></span>
		<?php endif; ?>
	</div>

	<div class="step-title-wrap">
		<span class="step-title step-title1 active"><?php echo $step1_title ?: ''; ?></span>
		<span class="step-title step-title2"><?php echo $step2_title ?: ''; ?></span>
		<span class="step-title step-title3"><?php echo $step3_title ?: ''; ?></span>
		<span class="step-title step-title4"><?php echo $step4_title ?: ''; ?></span>
	</div>

</div><!-- .form-header -->