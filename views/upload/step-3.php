<?php
/**
 * Upload wizard - step 3
 *
 * @author		Nir Goldberg
 * @package		views/upload
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// set step strings
$institution_label					= pll__( 'pll_form_institution_label' );
$institution_placeholder			= pll__( 'pll_form_institution_placeholder' );
$institution_description			= pll__( 'pll_form_institution_description' );

$city_label							= pll__( 'pll_form_city_label' );
$city_placeholder					= pll__( 'pll_form_city_placeholder' );
$city_description					= pll__( 'pll_form_city_description' );

$coordinator_name_label				= pll__( 'pll_form_coordinator_name_label' );
$coordinator_name_placeholder		= pll__( 'pll_form_coordinator_name_placeholder' );
$coordinator_name_description		= pll__( 'pll_form_coordinator_name_description' );

$coordinator_email_label			= pll__( 'pll_form_coordinator_email_label' );
$coordinator_email_placeholder		= pll__( 'pll_form_coordinator_email_placeholder' );
$coordinator_email_description		= pll__( 'pll_form_coordinator_email_description' );

$age_label							= pll__( 'pll_form_age_label' );
$age_placeholder					= pll__( 'pll_form_age_placeholder' );
$age_description					= pll__( 'pll_form_age_description' );

$upload								= pll__( 'pll_upload' );
$cancel								= pll__( 'pll_cancel' );

// generate nonce values
$upload_nonce = wp_create_nonce( 'upload_photo_step3' );

?>

<div class="step step3" data-nonce="<?php echo $upload_nonce; ?>" style="display: none;">

	<div class="photo-details">

		<div class="photo-details-fields">

			<div class="photo-details-group photo-details-group1">
				<div class="field-wrap required">

					<label for="institution"><?php echo $institution_label ?: ''; ?></label>
					<input type="text" id="institution" placeholder="<?php echo $institution_placeholder ?: ''; ?>" />
					<span><?php echo $institution_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap required">

					<label for="city"><?php echo $city_label ?: ''; ?></label>
					<input type="email" id="city" placeholder="<?php echo $city_placeholder ?: ''; ?>" />
					<span><?php echo $city_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>
			</div>

			<div class="photo-details-group photo-details-group2">
				<div class="field-wrap required">

					<label for="coordinator_name"><?php echo $coordinator_name_label ?: ''; ?></label>
					<input type="text" id="coordinator_name" placeholder="<?php echo $coordinator_name_placeholder ?: ''; ?>" />
					<span><?php echo $coordinator_name_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>

				<div class="field-wrap required">

					<label for="coordinator_email"><?php echo $coordinator_email_label ?: ''; ?></label>
					<input type="email" id="coordinator_email" placeholder="<?php echo $coordinator_email_placeholder ?: ''; ?>" />
					<span><?php echo $coordinator_email_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>

				</div>
			</div>

			<div class="photo-details-group photo-details-group3">
				<div class="field-wrap required">

					<label for="age"><?php echo $age_label ?: ''; ?></label>
					<select id="age" data-placeholder="<?php echo $age_placeholder ?: ''; ?>" class="chosen-select">

						<?php
							/**
							 * Display agess options
							 */
							get_template_part( 'views/components/agess-list' );
						?>

					</select>
					<span><?php echo $age_description ?: ''; ?></span>
					<span class="glyphicon glyphicon-ok-circle hidden"></span>
					<span class="glyphicon glyphicon-remove-circle hidden"></span>
				</div>
			</div>

		</div>

		<div class="photo-details-preview"></div>

	</div><!-- .photo-details -->

	<div class="btn-submit btn-submit-step3">

		<div class="btn btn-blue submit-step"><?php echo $upload ?: ''; ?></div>
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

</div><!-- .step.step3 -->