<?php
/**
 * Sidebar filters content
 *
 * @author		Nir Goldberg
 * @package		views/sidebar
 * @version		1.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'pll__' ) )
	return;

/**
 * Globals
 */
global $globals;

// get translated language
if ( $globals[ 'translated_lang' ] && $globals[ 'languages' ][ $globals[ 'translated_lang' ] ] ) {
	$translated_lang = $globals[ 'languages' ][ $globals[ 'translated_lang' ] ];
}

if ( $translated_lang ) { ?>

	<!-- language switcher -->
	<div class="lang-wrapper visible-xs <?php echo $globals[ 'translated_lang' ]; ?>">
		<a href="<?php echo $translated_lang[ 'url' ]; ?>">
			<span class="lang"><?php echo $translated_lang[ 'name' ]; ?></span>
			<div class="<?php echo $globals[ 'translated_lang' ]; ?>"></div>
		</a>
	</div>

	<div class="sidebar-seperator visible-xs clearfix"></div>

<?php }

if ( is_page_template( 'page-templates/main.php' ) ) {

	// set filters labels and placeholders
	$country_filter_label			= pll__( 'pll_country_filter_label' );
	$country_filter_placeholder		= pll__( 'pll_country_filter_placeholder' );
	$year_filter_label				= pll__( 'pll_year_filter_label' );
	$year_filter_placeholder		= pll__( 'pll_year_filter_placeholder' );
	$subject_filter_label			= pll__( 'pll_subject_filter_label' );
	$subject_filter_placeholder		= pll__( 'pll_subject_filter_placeholder' );
	$subsubject_filter_label		= pll__( 'pll_subsubject_filter_label' );
	$subsubject_filter_placeholder	= pll__( 'pll_subsubject_filter_placeholder' );

	// collect filters data
	$countries		= get_terms( array( 'taxonomy' => 'country' ) );
	$subjects		= get_terms( array( 'taxonomy' => 'subject' ) );
	$top_subjects	= [];
	$subsubjects	= [];

	// generate nonce values
	$subject_filter_nonce = wp_create_nonce( 'subject_filter' );

	if ( $subjects ) {
		foreach ( $subjects as $subject ) {

			if ( 0 == $subject->parent ) {
				array_push( $top_subjects, $subject );
			} else {
				array_push( $subsubjects, $subject );
			}

		}
	} ?>

	<!-- country select -->
	<label for="countries"><?php echo $country_filter_label; ?></label>
	<select id="countries" class="chosen-select" data-placeholder="<?php echo $country_filter_placeholder; ?>" multiple>

		<option></option>

		<?php foreach ( $countries as $country ) {
			echo '<option id="' . $country->term_id .'">' . $country->name . '</option>';
		} ?>

	</select>

	<div class="sidebar-seperator"></div>

	<!-- year select -->
	<label for="years"><?php echo $year_filter_label; ?></label>
	<select id="years" class="chosen-select" data-placeholder="<?php echo $year_filter_placeholder; ?>" multiple>

		<?php
			/**
			 * Display years options
			 */
			get_template_part( 'views/components/years-list' );
		?>

	</select>

	<div class="sidebar-seperator"></div>

	<!-- subject select -->
	<label for="subjects"><?php echo $subject_filter_label; ?></label>
	<select id="subjects" class="chosen-select" data-placeholder="<?php echo $subject_filter_placeholder; ?>" data-nonce="<?php echo $subject_filter_nonce; ?>" multiple>

		<option></option>

		<?php foreach ( $top_subjects as $subject ) {
			echo '<option id="' . $subject->term_id . '">' . $subject->name . '</option>';
		} ?>

	</select>

	<!-- subsubject select -->
	<label for="subsubjects"><?php echo $subsubject_filter_label; ?></label>
	<select id="subsubjects" class="chosen-select" data-placeholder="<?php echo $subsubject_filter_placeholder; ?>" multiple>

		<option></option>

		<?php foreach ( $subsubjects as $subject ) {
			echo '<option id="' . $subject->term_id . '">' . $subject->name . '</option>';
		} ?>

	</select>

<?php } ?>

<!-- bh logo -->
<div class="bh-logo">

	<?php
		/**
		 * Display BH logo
		 */
		get_template_part( 'views/components/bh-logo' );
	?>

</div>