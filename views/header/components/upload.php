<?php
/**
 * Header upload button
 *
 * @author		Nir Goldberg
 * @package		views/header/components
 * @version		1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( ''))

/**
 * Globals
 */
global $globals;

?>

<div class="upload">

	<div class="diagonal hidden-xs hidden-sm"></div>
	<div class="content">
		<div class="camera hidden-xs"></div>
		<span class="glyphicon glyphicon-camera visible-xs"></span>
		<?php if ( $globals[ 'translated_lang' ] && $globals[ 'languages' ][ $globals[ 'translated_lang' ] ] ) {

			$translated_lang = $globals[ 'languages' ][ $globals[ 'translated_lang' ] ]; ?>

			<span class="lang hidden-xs"><a href="<?php echo $translated_lang[ 'url' ]; ?>"><?php echo $translated_lang[ 'name' ]; ?></a></span>

		<?php } ?>
	</div>

</div>