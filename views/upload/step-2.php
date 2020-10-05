<?php
/**
 * Upload wizard - step 2
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Globals
 */
global $globals;

// set step strings
$name_label							= pll__( 'pll_form_name_label' );
$name_placeholder					= pll__( 'pll_form_name_placeholder' );
$name_description					= pll__( 'pll_form_name_description' );

$email_label						= pll__( 'pll_form_email_label' );
$email_placeholder					= pll__( 'pll_form_email_placeholder' );
$email_description					= pll__( 'pll_form_email_description' );

$country_label						= pll__( 'pll_form_country_label' );
$country_placeholder				= pll__( 'pll_form_country_placeholder' );
$country_description				= pll__( 'pll_form_country_description' );

$subject_label						= pll__( 'pll_form_subject_label' );
$subject_placeholder				= pll__( 'pll_form_subject_placeholder' );
$subject_description				= pll__( 'pll_form_subject_description' );

$unassigned_subjects_label			= pll__( 'pll_form_unassigned_subjects_label' );
$unassigned_subjects_placeholder	= pll__( 'pll_form_unassigned_subjects_placeholder' );
$unassigned_subjects_description	= pll__( 'pll_form_unassigned_subjects_description' );

$title_label						= pll__( 'pll_form_title_label' );
$title_placeholder					= pll__( 'pll_form_title_placeholder' );
$title_description					= pll__( 'pll_form_title_description' );

$year_label							= pll__( 'pll_form_year_label' );
$year_placeholder					= pll__( 'pll_form_year_placeholder' );
$year_description					= pll__( 'pll_form_year_description' );

$desc_label							= pll__( 'pll_form_description_label' );
$desc_placeholder					= pll__( 'pll_form_description_placeholder' );
$desc_description					= pll__( 'pll_form_description_description' );

$competition_label					= pll__( 'pll_form_competition_label' );
$competition_placeholder			= pll__( 'pll_form_competition_placeholder' );
$competition_description			= pll__( 'pll_form_competition_description' );

if ( function_exists( 'get_field' ) ) {

	$terms_of_use_label				= pll__( 'pll_terms_of_use_label' );
	$terms_of_use_name				= pll__( 'pll_terms_of_use_name' );
	$terms_of_use_content			= get_field( 'acf-options_' . $globals[ 'lang' ] . '_terms_of_use_content', 'option' );

}

$upload								= pll__( 'pll_upload' );
$next								= pll__( 'pll_next' );
$cancel								= pll__( 'pll_cancel' );

// generate nonce values
$upload_nonce = wp_create_nonce( 'upload_photo_step2' );

?>

<div class="step step2" data-nonce="<?php echo $upload_nonce; ?>" style="display: none;">

	<div class="photo-details">

		<div class="photo-details-fields">

			<div class="photo-details-group photo-details-group1">
				<div class="field-wrap required">

					<label for="name"><?php echo $name_label ?: ''; ?></label>
					<input type="text" id="name" placeholder="<?php echo $name_placeholder ?: ''; ?>" />
					<span><?php echo $name_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap required">

					<label for="email"><?php echo $email_label ?: ''; ?></label>
					<input type="email" id="email" placeholder="<?php echo $email_placeholder ?: ''; ?>" />
					<span><?php echo $email_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap required">

					<label for="country"><?php echo $country_label ?: ''; ?></label>
					<select id="country" data-placeholder="<?php echo $country_placeholder ?: ''; ?>" class="chosen-select">

						<?php
							/**
							 * Display countries options
							 */
							get_template_part( 'views/components/countries-list' );
						?>

					</select>
					<span><?php echo $country_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>
			</div>

			<div class="photo-details-group photo-details-group2">
				<div class="field-wrap required">

					<label for="subject"><?php echo $subject_label ?: ''; ?></label>
					<select id="subject" data-placeholder="<?php echo $subject_placeholder ?: ''; ?>" class="chosen-select" multiple>

						<?php
							/**
							 * Display subjects options
							 */
							get_template_part( 'views/components/subjects-list' );
						?>

					</select>
					<span><?php echo $subject_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap" style="display: none;">

					<label for="unassigned_subjects"><?php echo $unassigned_subjects_label; ?></label>
					<input type="text" id="unassigned_subjects" placeholder="<?php echo $unassigned_subjects_placeholder ?: ''; ?>" />
					<span><?php echo $unassigned_subjects_description ?: ''; ?></span>

				</div>

				<div class="field-wrap required">

					<label for="title"><?php echo $title_label ?: ''; ?></label>
					<input type="text" id="title" placeholder="<?php echo $title_placeholder ?: ''; ?>" />
					<span><?php echo $title_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap required">

					<label for="year"><?php echo $year_label ?: ''; ?></label>
					<select id="year" data-placeholder="<?php echo $year_placeholder ?: ''; ?>" class="chosen-select">

						<?php
							/**
							 * Display years options
							 */
							get_template_part( 'views/components/years-list' );
						?>

					</select>
					<span><?php echo $year_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>
				</div>
			</div>

			<div class="photo-details-group photo-details-group3">
				<div class="field-wrap required">

					<label for="description"><?php echo $desc_label ?: ''; ?></label>
					<textarea id="description" placeholder="<?php echo $desc_placeholder ?: ''; ?>"></textarea>
					<span><?php echo $desc_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap">

					<label for="competition"><?php echo $competition_label ?: ''; ?></label>
					<label class="cb-label">
						<input type="checkbox" id="competition" />
						<span><?php echo $competition_placeholder ?: ''; ?></span>
					</label>
					<span><?php echo $competition_description ?: ''; ?></span>

				</div>
			</div>

		</div>

		<div class="photo-details-preview"></div>

	</div><!-- .photo-details -->

	<div class="btn-submit btn-submit-step2">

		<div class="btn btn-blue submit-step submit-step-next" style="display: none;"><?php echo $next ?: ''; ?></div>
		<div class="btn btn-blue submit-step submit-step-upload"><?php echo $upload ?: ''; ?></div>
		<div class="loader">

			<?php
				/**
				 * Display loader
				 */
				get_template_part( 'views/upload/loader' );
			?>

		</div>
		<div class="clear"><?php echo $cancel ?: ''; ?></div>

		<?php if ( $terms_of_use_label && $terms_of_use_name && $terms_of_use_content ) : ?>

			<div class="terms-label"><?php echo str_replace( '%', '<a id="terms-link" href="#terms-content">' . $terms_of_use_name . '</a>', $terms_of_use_label ); ?></div>
			<div id="terms-content"><?php echo $terms_of_use_content; ?></div>

		<?php endif; ?>

	</div>

</div><!-- .step.step2 -->