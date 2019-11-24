<?php
/**
 * index.php
 *
 * @author		Nir Goldberg
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

/**
 * Display page title
 */
get_template_part( 'views/components/page', 'title' );

?>

<section class="page-content">

	<?php

		// content
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				/**
				 * Display loop
				 */
				get_template_part( 'views/page/loop' );

			endwhile;

		else :

			/**
			 * Display not found
			 */
			get_template_part( 'views/components/not-found' );

		endif;

	?>

</section><!-- .page-content -->

<?php get_footer();