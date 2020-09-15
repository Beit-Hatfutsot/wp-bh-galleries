<?php
/**
 * Header meta
 *
 * @author		Nir Goldberg
 * @package		views/header
 * @version		1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="icon" href="<?php echo TEMPLATE; ?>/assets/images/general/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php echo TEMPLATE; ?>/assets/images/general/favicon.ico" type="image/x-icon">

	<?php
		/**
		 * Google Fonts
		 */
		global $globals;

		if ( $globals[ 'google_fonts' ] ) : ?>

			<!-- Google Fonts -->
			<?php foreach ( $globals[ 'google_fonts' ] as $key => $val ) :
				printf( "<link href='%s' rel='stylesheet'>", $val );
			endforeach;

		endif;

	?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

	<?php
		/**
		 * Display Facebook Pixel code
		 */
		get_template_part( 'views/header/header', 'fb' );
	?>

</head>