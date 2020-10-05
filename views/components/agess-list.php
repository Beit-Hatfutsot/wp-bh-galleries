<?php
/**
 * Ages options list
 *
 * @author		Nir Goldberg
 * @package		views/components
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$current_selected	= 6;
$earliest_age		= 120;
$latest_age			= 6;

echo '<option></option>';

foreach ( range( $latest_age, $earliest_age ) as $i ) {
	echo '<option id="' . $i . '"' . ( $i === $currently_selected ? ' selected="selected"' : '' ) . '>' . $i . '</option>';
}