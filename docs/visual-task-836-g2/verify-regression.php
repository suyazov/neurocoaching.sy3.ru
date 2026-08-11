<?php
/** Machine regression for the G2 visual acceptance correction. */
declare(strict_types=1);

$root = dirname( __DIR__, 2 );
$failures = array();
$baselines = array(
	'about-desktop-1440x900.png'         => '4257253e620ddd2ea955e5e8a3810b0979df79e9722190b4ecbd24c571a4eacb',
	'about-mobile-390x844.png'           => 'a2c036a2b4bb3e4cceac4713fb77fe8bf4e52fe2b22b400dc50ef3ce5170679d',
	'career-desktop-1440x900.png'        => 'a4c1c1897a33119eb75218a3b9790345186a6e22117ba20bc2baec7dd4a77f2d',
	'career-mobile-390x844.png'          => '7039c7cd431b44b017205cae3a7fb7fb806aa1ce3e698456843b4d8ebb0f626c',
	'neurocoaching-desktop-1440x900.png' => '42e3d398dabe6c566c1d59425473d6b13bbe7f85fdfbbc01ba9c69edf348b83f',
	'neurocoaching-mobile-390x844.png'   => 'ca5e075479b1847bc82cd291abf8c419a3871cec2b4666912bf89bd950c93620',
);
foreach ( $baselines as $file => $hash ) {
	$path = $root . '/acceptance/visual/' . $file;
	if ( ! is_file( $path ) || hash_file( 'sha256', $path ) !== $hash ) {
		$failures[] = 'immutable baseline mismatch: ' . $file;
	}
}

$templates = array(
	'wordpress/wp-content/themes/neurocoaching/front-page.php' => array( 'Ksenia Belousova', 'Services | B2B format', 'FAQs' ),
	'wordpress/wp-content/themes/neurocoaching/page-career-services.php' => array( 'Stop postponing your life', 'Services | Career', 'FAQs' ),
	'wordpress/wp-content/themes/neurocoaching/page-neurocoaching.php' => array( 'Burned out, overwhelmed, or know something needs to change?', 'Services | Neurointegration', 'FAQs' ),
);
foreach ( $templates as $relative => $required ) {
	$source = file_get_contents( $root . '/' . $relative );
	foreach ( $required as $text ) {
		if ( false === strpos( $source, $text ) ) {
			$failures[] = $relative . ' missing exact copy: ' . $text;
		}
	}
	foreach ( array( 'Internal Server Error', '<canvas', 'hidden duplicate' ) as $forbidden ) {
		if ( false !== stripos( $source, $forbidden ) ) {
			$failures[] = $relative . ' contains forbidden source: ' . $forbidden;
		}
	}
}

$about = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/front-page.php' );
$career = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/page-career-services.php' );
if ( false === strpos( $about, '<h1 id="nc-about-name">Ksenia Belousova</h1>' ) ) {
	$failures[] = 'About name must remain one uninterrupted visible DOM phrase';
}
if ( false === strpos( $career, '<h1>Stop postponing your life</h1>' ) ) {
	$failures[] = 'Career heading must remain one uninterrupted visible DOM phrase';
}

$css = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$about_scope = 'body.home:not(.career-services-route):not(.neurocoaching-route)';
if ( substr_count( $css, $about_scope ) < 20 ) {
	$failures[] = 'About header rules are not fully route-scoped';
}
if ( preg_match( '/(^|[,{])\s*\.home\s+\.(site-header|brand|about-socials|primary-nav|menu-toggle)/m', $css ) ) {
	$failures[] = 'unscoped About header selector can leak into service routes';
}
foreach ( array(
	'.neurocoaching-route .site-header { z-index:10; top:30px; right:max(32px,calc((100% - 1220px)/2)); left:auto;',
	'.career-services-route .site-header { z-index:10; top:29px; right:max(32px,calc((100% - 1219px)/2)); left:auto;',
	$about_scope . ' .site-header { position:absolute; top:0; right:0; left:0;',
) as $rule ) {
	if ( false === strpos( $css, $rule ) ) {
		$failures[] = 'missing route geometry guard: ' . $rule;
	}
}

if ( $failures ) {
	fwrite( STDERR, json_encode( array( 'status' => 'failed', 'failures' => $failures ), JSON_PRETTY_PRINT ) . PHP_EOL );
	exit( 1 );
}
echo json_encode(
	array(
		'status'                 => 'passed',
		'baseline_hashes'        => count( $baselines ),
		'exact_route_copy'       => count( $templates ),
		'route_scope_regression' => 'passed',
	),
	JSON_PRETTY_PRINT
) . PHP_EOL;
