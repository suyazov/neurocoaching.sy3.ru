<?php
/** Machine regression guard for TASK-919 G2 PSD geometry. */

$root  = dirname( __DIR__, 2 );
$css   = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$front = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/front-page.php' );

$required_css = array(
	'background:var(--nc-about-violet)',
	'grid-template-columns:663px 290px; column-gap:28px',
	'width:295px; height:727px',
	'margin:8px auto 0',
	'margin-left:-1px; padding:0; font-size:14px; line-height:53px',
);

$required_text = array(
	'Ksenia Belousova',
	'Services | B2B format',
	'In real life',
	'Ready to take the first step?',
	'FAQs',
);

foreach ( $required_css as $needle ) {
	if ( false === strpos( $css, $needle ) ) {
		fwrite( STDERR, "Missing measured CSS contract: {$needle}\n" );
		exit( 1 );
	}
}

foreach ( $required_text as $needle ) {
	if ( false === strpos( $front, $needle ) ) {
		fwrite( STDERR, "Missing required visible text: {$needle}\n" );
		exit( 1 );
	}
}

if ( false !== strpos( $front, 'Internal Server Error' ) ) {
	fwrite( STDERR, "Forbidden error text is present.\n" );
	exit( 1 );
}

if ( false === strpos( $front, 'array_pad( $about_life_slides, 3' ) || false === strpos( $front, 'array_slice( array_pad( $about_life_slides, 3, $about_life_image ), 0, 3 )' ) ) {
	fwrite( STDERR, "About carousel is not constrained to three slides.\n" );
	exit( 1 );
}

echo "TASK-919 G2 regression checks passed.\n";
