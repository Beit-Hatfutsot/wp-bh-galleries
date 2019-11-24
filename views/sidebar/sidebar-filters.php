<?php
/**
 * Sidebar filters
 *
 * @author		Nir Goldberg
 * @package		views/sidebar
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
$rtl = is_rtl();

// generate nonce values
$filters_nonce = wp_create_nonce( 'filters' );

?>

<section class="sidebar-filters sidebar-offcanvas sidebar-offcanvas-<?php echo $rtl ? 'right' : 'left'; ?>" data-nonce="<?php echo $filters_nonce; ?>" role="navigation">

	<?php
		/**
		 * Display filters
		 */
		get_template_part( 'views/sidebar/sidebar-filters', 'content' );
	?>

</section><!-- .sidebar-filters -->