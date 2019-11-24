<?php
/**
 * Localization functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( function_exists( 'pll_register_string' ) ) :

	// general
	pll_register_string( 'Logo Title',								'pll_logo_title',								'General');
	pll_register_string( 'Header Title',							'pll_header_title',								'General');
	pll_register_string( 'No Results Title',						'pll_no_results_title',							'General');
	pll_register_string( 'No Results Paragraph',					'pll_no_results_paragraph',						'General');
	pll_register_string( '404 Title',								'pll_404_title',								'General');
	pll_register_string( '404 Paragraph',							'pll_404_paragraph',							'General');

	pll_register_string( 'By Label',								'pll_by_label',									'General');
	pll_register_string( 'Subject Label',							'pll_subject_label',							'General');
	pll_register_string( 'Country Label',							'pll_country_label',							'General');

	// upload
	// form titles
	pll_register_string( 'Form Title',								'pll_form_title',								'Upload');
	pll_register_string( 'Step#1 Title',							'pll_step1_title',								'Upload');
	pll_register_string( 'Step#2 Title',							'pll_step2_title',								'Upload');
	pll_register_string( 'Step#3 Title',							'pll_step3_title',								'Upload');
	pll_register_string( 'Step Indicator',							'pll_step_indicator',							'Upload');

	// step 1
	pll_register_string( 'Drop Image',								'pll_drop_image',								'Upload');
	pll_register_string( 'Or',										'pll_or',										'Upload');
	pll_register_string( 'Select File',								'pll_select_file',								'Upload');

	// step 2
	pll_register_string( 'Form Name Label',							'pll_form_name_label',							'Upload');
	pll_register_string( 'Form Name Placeholder',					'pll_form_name_placeholder',					'Upload');
	pll_register_string( 'Form Name Description',					'pll_form_name_description',					'Upload');
	pll_register_string( 'Form Email Label',						'pll_form_email_label',							'Upload');
	pll_register_string( 'Form Email Placeholder',					'pll_form_email_placeholder',					'Upload');
	pll_register_string( 'Form Email Description',					'pll_form_email_description',					'Upload');
	pll_register_string( 'Form Country Label',						'pll_form_country_label',						'Upload');
	pll_register_string( 'Form Country Placeholder',				'pll_form_country_placeholder',					'Upload');
	pll_register_string( 'Form Country Description',				'pll_form_country_description',					'Upload');
	pll_register_string( 'Form Subject Label',						'pll_form_subject_label',						'Upload');
	pll_register_string( 'Form Subject Placeholder',				'pll_form_subject_placeholder',					'Upload');
	pll_register_string( 'Form Subject Description',				'pll_form_subject_description',					'Upload');
	pll_register_string( 'Form Unassigned Subjects Label',			'pll_form_unassigned_subjects_label',			'Upload');
	pll_register_string( 'Form Unassigned Subjects Placeholder',	'pll_form_unassigned_subjects_placeholder',		'Upload');
	pll_register_string( 'Form Unassigned Subjects Description',	'pll_form_unassigned_subjects_description',		'Upload');
	pll_register_string( 'Form Title Label',						'pll_form_title_label',							'Upload');
	pll_register_string( 'Form Title Placeholder',					'pll_form_title_placeholder',					'Upload');
	pll_register_string( 'Form Title Description',					'pll_form_title_description',					'Upload');
	pll_register_string( 'Form Year Label',							'pll_form_year_label',							'Upload');
	pll_register_string( 'Form Year Placeholder',					'pll_form_year_placeholder',					'Upload');
	pll_register_string( 'Form Year Description',					'pll_form_year_description',					'Upload');
	pll_register_string( 'Form Description Label',					'pll_form_description_label',					'Upload');
	pll_register_string( 'Form Description Placeholder',			'pll_form_description_placeholder',				'Upload');
	pll_register_string( 'Form Description Description',			'pll_form_description_description',				'Upload');

	// step 3
	pll_register_string( 'Facebook Logged In Msg',					'pll_facebook_logged_in',						'Upload');
	pll_register_string( 'Facebook App Logged In Msg',				'pll_facebook_app_logged_in',					'Upload');
	pll_register_string( 'Facebook Logged Out Msg',					'pll_facebook_logged_out',						'Upload');

	// upload general
	pll_register_string( 'Terms of Use Label',						'pll_terms_of_use_label',						'Upload');
	pll_register_string( 'Terms of Use Name',						'pll_terms_of_use_name',						'Upload');
	pll_register_string( 'Next',									'pll_next',										'Upload');
	pll_register_string( 'Clear',									'pll_clear',									'Upload');
	pll_register_string( 'Cancel',									'pll_cancel',									'Upload');
	pll_register_string( 'Upload',									'pll_upload',									'Upload');

	// filters
	pll_register_string( 'Country Filter Label',					'pll_country_filter_label',						'Filters');
	pll_register_string( 'Country Filter Placeholder',				'pll_country_filter_placeholder',				'Filters');
	pll_register_string( 'Year Filter Label',						'pll_year_filter_label',						'Filters');
	pll_register_string( 'Year Filter Placeholder',					'pll_year_filter_placeholder',					'Filters');
	pll_register_string( 'Subject Filter Label',					'pll_subject_filter_label',						'Filters');
	pll_register_string( 'Subject Filter Placeholder',				'pll_subject_filter_placeholder',				'Filters');
	pll_register_string( 'Sub Subject Filter Label',				'pll_subsubject_filter_label',					'Filters');
	pll_register_string( 'Sub Subject Filter Placeholder',			'pll_subsubject_filter_placeholder',			'Filters');

endif;