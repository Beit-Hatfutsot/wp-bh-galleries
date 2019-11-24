<?php
/**
 * Template Name: Main
 *
 * @author		Nir Goldberg
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

/**
 * Variables
 */
$photos = [];

?>

<section class="page-content">

	<?php if ( function_exists( 'get_field' ) ) {

		// query photos
		$args = array(
			'post_type'			=> 'photo',
			'posts_per_page'	=> -1,
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			if ( get_field( 'acf-photo_image' ) ) {
				$photos[] = get_the_ID();
			}

		endwhile; endif; wp_reset_postdata();

		/**
		 * Display images grid
		 */
		include( locate_template( 'views/components/images-grid.php' ) );

	} ?>

</section><!-- .page-content -->

<?php get_footer();