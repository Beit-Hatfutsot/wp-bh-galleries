<?php
/**
 * Subjects functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * BH_get_subjects_logos
 *
 * This function gets subjects logos
 *
 * @param	N/A
 * @return	(array)
 */
function BH_get_subjects_logos() {

	if ( ! function_exists( 'get_field' ) )
		return;

	/**
	 * Variables
	 */
	$subjects_logos = array();

	$subjects_args	= array(
		'taxonomy'	=> 'subject',
	);

	// get subjects
	$subjects = get_terms( $subjects_args );

	if ( $subjects ) {
		foreach ( $subjects as $subject ) {

			// get_logos
			$logos = get_field( 'acf-subject_logos', 'subject_' . $subject->term_id );

			if ( $logos ) {
				$subjects_logos[ $subject->term_id ] = array(
					'subject'	=> $subject->name,
					'logos'		=> $logos,
				);
			}

		}
	}

	// return
	return $subjects_logos;

}