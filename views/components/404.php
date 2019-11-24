<?php
/**
 * 404
 *
 * @author		Nir Goldberg
 * @package		views/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="not_found">

	<?php if ( function_exists( 'pll_e' ) ) : ?>

		<h2><?php pll_e( 'pll_404_title' ); ?></h2>
		<span><?php pll_e( 'pll_404_paragraph' ); ?></span>

	<?php endif; ?>

</div>