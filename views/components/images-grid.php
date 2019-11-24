<?php
/**
 * Images grid
 *
 * @author		Nir Goldberg
 * @package		views/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

/**
 * Globals
 */
global $globals;

/**
 * Variables
 */
$lang = ( isset( $_POST[ 'lang' ] ) && $_POST[ 'lang' ] ) ? $_POST[ 'lang' ] : $globals[ 'lang' ];

?>

<div class="images-grid">

	<?php

		if ( count( $photos ) ) :

			echo '<ul>';

				foreach ( $photos as $photo ) :

					$user_name		= get_field( 'acf-photo_user_name',		$photo );
					$email			= get_field( 'acf-photo_email',			$photo );
					$image			= get_field( 'acf-photo_image',			$photo );
					$thumbnail		= get_field( 'acf-photo_thumbnail',		$photo );
					$title			= get_field( 'acf-photo_title',			$photo );
					$year			= get_field( 'acf-photo_year',			$photo );
					$description	= get_field( 'acf-photo_description',	$photo );

					$subjects		= get_the_terms( $photo, 'subject' );
					$country		= get_the_terms( $photo, 'country' );

					$subjects_str = '';
					$subjects_parents_str = '';

					if ( $subjects ) {
						foreach ( $subjects as $subject ) {
							// get subject language
							if ( ! function_exists( 'pll_get_term_language' ) || $lang == pll_get_term_language( $subject->term_id ) ) {

								$subjects_str .= ( ( $subjects_str ) ? ', ' : '' ) . $subject->name;
								$subjects_parents_str .= ( ( $subjects_parents_str ) ? ', ' : '' ) . get_term_by( 'id', $subject->parent, 'subject' )->name;

							}
						}
					}

					$photo_data = array(
						'user_name'				=> ucwords( strtolower( $user_name ) ),
						'email'					=> $email,
						'image'					=> $image[ 'url' ],
						'title'					=> $title,
						'year'					=> $year,
						'description'			=> $description,
						'subjects'				=> $subjects_str,
						'subjects_parents'		=> $subjects_parents_str,
						'country'				=> $country ? $country[0]->name : '',
					);

					$photo_data = json_encode( $photo_data );
					$photo_data = str_replace( array( "'", "&quot;" ), array( "\u0027", "\u0022" ), $photo_data );

					echo '<li class="photo" id="photo-' . $photo . '" photo-data=\'' . $photo_data . '\'>';
						echo '<img src="' . ( ( $thumbnail ) ? $thumbnail[ 'url' ] : $image[ 'sizes' ][ 'thumbnail' ] ) . '" alt="' . $user_name . '" />';
					echo '</li>';

				endforeach;

			echo '</ul>';

		else :

			/**
			 * Not found
			 */
			get_template_part( 'views/components/not-found' );

		endif;

	?>

	<div class="loader">

		<?php
			/**
			 * Display loader
			 */
			get_template_part( 'views/upload/loader' );
		?>

	</div>

</div><!-- .images-grid -->