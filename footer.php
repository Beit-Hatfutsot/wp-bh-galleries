<?php
/**
 * Theme footer
 *
 * @author		Nir Goldberg
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

</section><!-- .main-content -->

<?php
	/**
	 * Display upload wizard
	 */
	get_template_part( 'views/upload/upload' );
?>

<?php wp_footer(); ?>

</body>
</html>