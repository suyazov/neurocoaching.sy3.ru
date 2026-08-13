<?php
/** Machine guard for the Career mobile hero PSD mapping. */

$root = dirname( __DIR__, 3 );
$page = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/page-career-services.php' );
$css  = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );

$checks = array(
	'mobile source is the embedded 600x900 smart object' => str_contains( $page, 'mobile-11371-career-photo.png' ) && str_contains( $page, 'width="600" height="900"' ),
	'mobile source boundary matches mobile CSS'          => str_contains( $page, 'media="(max-width: 768px)"' ),
	'hero remains a semantic picture and real heading'  => str_contains( $page, '<picture>' ) && str_contains( $page, '<h1>Stop postponing your life</h1>' ),
	'mobile placement preserves the 2:3 source ratio'   => str_contains( $css, 'width:94.6875vw' ) && str_contains( $css, 'height:auto; aspect-ratio:2/3' ),
	'320px mask and placement match the PSD'             => str_contains( $css, 'left:-.9375vw; width:101.5625vw; height:126.25vw' ) && str_contains( $css, 'top:-4.6875vw; left:.3125vw' ),
	'copy starts 44px after the mask boundary'           => str_contains( $css, 'padding:44px 18px 30px' ),
);

foreach ( $checks as $label => $passed ) {
	if ( ! $passed ) {
		fwrite( STDERR, "FAIL: {$label}\n" );
		exit( 1 );
	}
}

if ( preg_match( '/\.career-hero__photo img\s*\{[^}]*object-fit\s*:\s*fill/s', $css ) ) {
	fwrite( STDERR, "FAIL: Career hero must not use object-fit:fill\n" );
	exit( 1 );
}

echo "PASS: Career mobile hero source, uniform transform, mask and copy boundary are guarded.\n";
