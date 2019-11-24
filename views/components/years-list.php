<?php
/**
 * Years options list
 *
 * @author		Nir Goldberg
 * @package		views/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$current_selected	= date('Y');
$earliest_year		= 1900;
$latest_year		= date('Y');

echo '<option></option>';

foreach ( range( $latest_year, $earliest_year ) as $i ) {
	echo '<option id="' . $i . '"' . ( $i === $currently_selected ? ' selected="selected"' : '' ) . '>' . $i . '</option>';
}