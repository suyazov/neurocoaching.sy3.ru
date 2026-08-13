<?php
/** Machine guard for the PSD-sized About mobile header. */

$root      = dirname( __DIR__, 3 );
$theme     = $root . '/wordpress/wp-content/themes/neurocoaching';
$css       = file_get_contents( $theme . '/style.css' );
$functions = file_get_contents( $theme . '/functions.php' );
$failures  = array();

function require_fragment( $contents, $fragment, $label, &$failures ) {
	if ( false === strpos( $contents, $fragment ) ) {
		$failures[] = $label;
	}
}

$css_contract = array(
	'height:53px; min-height:53px; max-height:53px' => 'header must remain exactly 53px high',
	'top:4px; left:16px; width:89px; min-width:89px; max-width:89px; height:45px' => 'logo bounds must remain source-sized',
	'top:15px; left:145px; width:90px; min-width:90px; max-width:90px; height:22px' => 'social group bounds must remain source-sized',
	'.about-socials a:nth-child(1) { left:0; }' => 'LinkedIn x offset must remain 145px',
	'.about-socials a:nth-child(2) { top:1px; left:35px; }' => 'Instagram offset must remain 180px,16px',
	'.about-socials a:nth-child(3) { left:68px; }' => 'Telegram x offset must remain 213px',
	'top:16px; right:15px; display:grid; width:24px; min-width:24px; max-width:24px; height:22px' => 'burger must remain source-sized and right-aligned',
	'.nc-about__hero { width:100%; height:clamp(1391px,calc(1157.86px + 72.857vw),1442px); display:block; margin-left:0; padding-top:50px; }' => 'hero layer must begin at y=50',
);
foreach ( $css_contract as $fragment => $label ) {
	require_fragment( $css, $fragment, $label, $failures );
}

$asset_contract = array(
	'about-header-logo-psd.png'      => array( 89, 45 ),
	'about-header-linkedin-psd.png'  => array( 22, 21 ),
	'about-header-instagram-psd.png' => array( 22, 21 ),
	'about-header-telegram-psd.png'  => array( 22, 22 ),
);
foreach ( $asset_contract as $asset => $expected ) {
	$path = $theme . '/assets/images/' . $asset;
	$size = is_file( $path ) ? getimagesize( $path ) : false;
	if ( ! $size || $size[0] !== $expected[0] || $size[1] !== $expected[1] ) {
		$failures[] = sprintf( '%s must remain %dx%d', $asset, $expected[0], $expected[1] );
	}
	require_fragment( $functions, $asset, $asset . ' must remain wired into the About header', $failures );
}

foreach ( array( 'LinkedIn', 'Instagram', 'Telegram', 'Digital Belka home', 'data-menu-toggle' ) as $control ) {
	require_fragment( $functions, $control, $control . ' control must remain present', $failures );
}

if ( $failures ) {
	fwrite( STDERR, "About mobile header regression failed:\n- " . implode( "\n- ", $failures ) . "\n" );
	exit( 1 );
}

echo "About mobile header regression passed: PSD bounds, four controls, assets and hero boundary are locked.\n";
