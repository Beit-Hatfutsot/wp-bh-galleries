<?php
/**
 * 404 content
 *
 * @author		Nir Goldberg
 * @package		views/page
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<section class="page-content">

	<div class="images-grid">

		<?php
			/**
			 * Display 404 content
			 */
			get_template_part( 'views/components/404' );
		?>

	</div>

</section><!-- .page-content -->