<?php
/**
 * Theme page template
 *
 * @author		Nir Goldberg
 * @version		1.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

/**
 * Display page title
 */
get_template_part( 'views/components/page', 'title' );

?>

<section class="page-content">

	<div class="container">

		<?php the_content(); ?>

	</div>

</section><!-- .page-content -->

<?php get_footer();