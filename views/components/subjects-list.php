<?php
/**
 * Subjects options list
 *
 * @author		Nir Goldberg
 * @package		views/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// get top level subjects
$args = array(
	'taxonomy'		=> 'subject',
	'hide_empty'	=> false,
	'parent'		=> 0,
);
$subjects = get_terms( $args );

if ( ! $subjects )
	return;

echo '<option value=""></option>';

foreach ( $subjects as $subject ) {

	$args = array(
		'taxonomy'		=> 'subject',
		'hide_empty'	=> false,
		'parent'		=> $subject->term_id,
	);
	$sub_subjects = get_terms( $args );

	if ( $sub_subjects ) {

		echo '<optgroup label="' . $subject->name . '">';

		foreach ( $sub_subjects as $sub_subject ) {
			echo '<option value="' . $sub_subject->term_id . '">' . $sub_subject->name . '</option>';
		}

		echo '</optgroup>';

	}

}