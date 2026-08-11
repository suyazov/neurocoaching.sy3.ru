<?php
/** Machine regression check for TASK-ISSUE-SUYAZOV_NEUROCOACHING.SY3.RU-844. */
declare(strict_types=1);

$root = dirname(__DIR__, 2);
$failures = array();
$baselines = array(
	'about-desktop-1440x900.png' => '4257253e620ddd2ea955e5e8a3810b0979df79e9722190b4ecbd24c571a4eacb',
	'about-mobile-390x844.png' => 'a2c036a2b4bb3e4cceac4713fb77fe8bf4e52fe2b22b400dc50ef3ce5170679d',
	'career-desktop-1440x900.png' => 'a4c1c1897a33119eb75218a3b9790345186a6e22117ba20bc2baec7dd4a77f2d',
	'career-mobile-390x844.png' => '7039c7cd431b44b017205cae3a7fb7fb806aa1ce3e698456843b4d8ebb0f626c',
	'neurocoaching-desktop-1440x900.png' => '42e3d398dabe6c566c1d59425473d6b13bbe7f85fdfbbc01ba9c69edf348b83f',
	'neurocoaching-mobile-390x844.png' => 'ca5e075479b1847bc82cd291abf8c419a3871cec2b4666912bf89bd950c93620',
);
foreach ( $baselines as $file => $expected ) {
	$path = $root . '/acceptance/visual/' . $file;
	if ( ! is_file( $path ) || hash_file( 'sha256', $path ) !== $expected ) {
		$failures[] = 'immutable baseline mismatch: ' . $file;
	}
}

$templates = array(
	'wordpress/wp-content/themes/neurocoaching/front-page.php' => array( 'Ksenia', 'Belousova', 'Services | B2B format', 'FAQs' ),
	'wordpress/wp-content/themes/neurocoaching/page-career-services.php' => array( 'Stop postponing', 'your life', 'Services | Career', 'FAQs' ),
	'wordpress/wp-content/themes/neurocoaching/page-neurocoaching.php' => array( 'Burned out, overwhelmed, or know something needs to change?', 'Services | Neurointegration', 'FAQs' ),
);
foreach ( $templates as $file => $required ) {
	$source = file_get_contents( $root . '/' . $file );
	foreach ( $required as $text ) {
		if ( false === strpos( $source, $text ) ) {
			$failures[] = $file . ' missing: ' . $text;
		}
	}
	if ( false !== strpos( $source, 'Internal Server Error' ) ) {
		$failures[] = $file . ' contains forbidden error copy';
	}
}

$css = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$required_css = array(
	'.home .site-header { z-index:10;', 'left:563px;',
	'.nc-about__hero { width:1320px;', 'margin-left:0;',
	'.career-hero__photo { height:438px; background:#f7d7c6;', 'width:79.375%; max-width:none;',
	'.neuro-hero { height:1045px;', '.neuro-hero__photo { width:320px; height:488px;',
	'.neurocoaching-route .site-header { z-index:10;', '.career-services-route .site-header { z-index:10;',
);
foreach ( $required_css as $rule ) {
	if ( false === strpos( $css, $rule ) ) {
		$failures[] = 'missing PSD geometry rule: ' . $rule;
	}
}

if ( $failures ) {
	fwrite( STDERR, json_encode( array( 'status' => 'failed', 'failures' => $failures ), JSON_PRETTY_PRINT ) . PHP_EOL );
	exit( 1 );
}
echo json_encode( array(
	'status' => 'passed', 'baseline_hashes' => 6, 'route_copy_checks' => 3,
	'psd_geometry_rules' => count( $required_css ),
), JSON_PRETTY_PRINT ) . PHP_EOL;
