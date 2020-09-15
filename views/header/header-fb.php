<?php
/**
 * Facebook Pixel
 *
 * @author		Nir Goldberg
 * @package		views/header
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

$fb_pixel_code = get_field( 'acf-options_facebook_pixel_code', 'option' );

if ( ! $fb_pixel_code )
	return;

?>

<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '<?php echo $fb_pixel_code; ?>');
	fbq('track', 'PageView');
</script>
<noscript>
	<img height="1" width="1" style="display:none" 
	src="https://www.facebook.com/tr?id=<?php echo $fb_pixel_code; ?>&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->