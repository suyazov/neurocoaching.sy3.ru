<?php
/** Machine regression guard for the owner-reported gallery and scaling mismatch. */
declare(strict_types=1);

$root = dirname(__DIR__, 2);
$failures = array();
$read = static function ( string $path ) use ( $root ): string {
	$contents = file_get_contents( $root . '/' . $path );
	return false === $contents ? '' : $contents;
};

$css = $read( 'wordpress/wp-content/themes/neurocoaching/style.css' );
foreach ( array( 'zoom:', 'about-gallery-dots.png', '.nc-about__dots' ) as $forbidden ) {
	if ( false !== strpos( $css, $forbidden ) ) {
		$failures[] = 'forbidden whole-page/fake-pagination CSS: ' . $forbidden;
	}
}

$functions = $read( 'wordpress/wp-content/themes/neurocoaching/functions.php' );
$career = $read( 'wordpress/wp-content/themes/neurocoaching/page-career-services.php' );
$javascript = $read( 'wordpress/wp-content/themes/neurocoaching/assets/js/navigation.js' );
foreach ( array( 'if ( 1 === $count )', 'nc-gallery--single', 'data-carousel-dot', 'aria-current=' ) as $required ) {
	if ( false === strpos( $functions, $required ) ) {
		$failures[] = 'gallery renderer missing: ' . $required;
	}
}
if ( false === strpos( $career, "neurocoaching_gallery( 'career_gallery_urls'" ) ) {
	$failures[] = 'Career does not use the configured gallery slide set';
}
foreach ( array( 'ArrowLeft', 'ArrowRight', 'Home', 'End', 'touchstart', 'touchend' ) as $required ) {
	if ( false === strpos( $javascript, $required ) ) {
		$failures[] = 'carousel interaction missing: ' . $required;
	}
}

if ( $failures ) {
	fwrite( STDERR, json_encode( array( 'status' => 'failed', 'failures' => $failures ), JSON_PRETTY_PRINT ) . PHP_EOL );
	exit( 1 );
}
echo json_encode( array( 'status' => 'passed', 'single_slide_fake_controls' => 0, 'whole_page_scaling' => 0, 'interactive_inputs_checked' => 6 ), JSON_PRETTY_PRINT ) . PHP_EOL;
