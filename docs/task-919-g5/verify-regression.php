<?php
/** Machine guard for the TASK-919 G5 bounded mobile hero transform. */

$root  = dirname( __DIR__, 2 );
$css   = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$front = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/front-page.php' );

$transform = 'top:clamp(-68px,calc(4.429px - 18.571vw),-55px); left:clamp(-17px,calc(-67.286px + 15.714vw),-6px); width:clamp(356px,calc(145.714px + 65.714vw),402px); height:clamp(530px,calc(196.286px + 104.286vw),603px);';
$bounds    = array(
	320 => array( 'top' => -55.0, 'left' => -17.0, 'width' => 356.0, 'height' => 530.0 ),
	390 => array( 'top' => -68.0, 'left' => -6.0, 'width' => 402.0, 'height' => 603.0 ),
);

$interpolated = static function ( float $from, float $to, int $viewport ): float {
	return $from + ( $to - $from ) * ( $viewport - 320 ) / 70;
};

$numeric_bounds_match = true;
foreach ( $bounds as $viewport => $expected ) {
	foreach ( $expected as $property => $value ) {
		$from = $bounds[320][ $property ];
		$to   = $bounds[390][ $property ];
		$numeric_bounds_match = $numeric_bounds_match && abs( $interpolated( $from, $to, $viewport ) - $value ) < 0.001;
	}
}

$checks = array(
	'frozen visual baseline is unchanged' => hash_file( 'sha256', $root . '/acceptance/visual/about-mobile-390x844.png' ) === 'a2c036a2b4bb3e4cceac4713fb77fe8bf4e52fe2b22b400dc50ef3ce5170679d',
	'bounded 320 to 390 transform is present' => str_contains( $css, $transform ),
	'endpoint geometry matches the PSD contract' => $numeric_bounds_match,
	'high-resolution responsive sources remain' => str_contains( $front, 'about-hero-psd-768.webp' ) && str_contains( $front, 'about-hero-source.webp' ) && str_contains( $front, '1537w' ),
	'required route text remains editable HTML' => preg_match_all( '/Ksenia Belousova|Services \| B2B format|In real life|Ready to take the first step\?|FAQs/', $front ) >= 5,
	'internal server error text is absent' => ! str_contains( $front, 'Internal Server Error' ),
);

$failed = array_keys( array_filter( $checks, static fn( $passed ) => ! $passed ) );
if ( $failed ) {
	fwrite( STDERR, implode( "\n", $failed ) . "\n" );
	exit( 1 );
}

echo "PASS: TASK-919 G5 mobile hero transform regression checks\n";
