<?php
/** Machine guard for the measured About mobile PSD crop. */

$root  = dirname( __DIR__, 2 );
$css   = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$front = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/front-page.php' );

$checks = array(
	'frozen visual baseline is unchanged' => hash_file( 'sha256', $root . '/acceptance/visual/about-mobile-390x844.png' ) === 'a2c036a2b4bb3e4cceac4713fb77fe8bf4e52fe2b22b400dc50ef3ce5170679d',
	'full-resolution responsive hero sources remain available' => str_contains( $front, 'about-hero-psd-768.webp' ) && str_contains( $front, 'about-hero-source.webp' ) && str_contains( $front, '1537w' ),
	'mobile hero uses the measured 320 by 405 mask' => str_contains( $css, 'height:clamp(405px,calc(199.29px + 64.286vw),450px); overflow:hidden;' ),
	'mobile hero uses the measured minus 17 minus 55 origin' => str_contains( $css, 'top:clamp(-67px, -17.188vw, -55px); left:clamp(-21px, -5.313vw, -17px);' ),
	'mobile hero uses the measured 356 by 530 placed bounds' => str_contains( $css, 'width:111.25vw; height:165.625vw; max-width:none; object-fit:fill;' ),
	'required route text remains editable HTML' => preg_match_all( '/Ksenia Belousova|Services \| B2B format|In real life|Ready to take the first step\?|FAQs/', $front ) >= 5,
);

$failed = array_keys( array_filter( $checks, static fn( $passed ) => ! $passed ) );
if ( $failed ) {
	fwrite( STDERR, implode( "\n", $failed ) . "\n" );
	exit( 1 );
}

echo "About mobile PSD crop regression checks passed.\n";
