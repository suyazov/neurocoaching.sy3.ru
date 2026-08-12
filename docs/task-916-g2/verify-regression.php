<?php
/** Machine regression guard for the rejected About mobile/FAQ reconstruction. */
$root  = dirname( __DIR__, 2 );
$front = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/front-page.php' );
$css   = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$js    = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/assets/js/navigation.js' );

$checks = array(
	'exact required headings' => preg_match_all( '/Ksenia Belousova|Services \| B2B format|In real life|Ready to take the first step\?|FAQs/', $front ) >= 5,
	'mobile hero uses the dedicated PSD artboard crop' => str_contains( $front, "about-hero-mobile-source.webp'" ) && is_file( $root . '/wordpress/wp-content/themes/neurocoaching/assets/images/about-hero-mobile-source.webp' ),
	'gallery normalises editable URLs to exactly three slides' => str_contains( $front, 'array_slice( array_pad( $about_life_slides, 3, $about_life_image ), 0, 3 )' ),
	'gallery emits one dot per normalised slide' => str_contains( $front, "'nc-about__life-photo', '', \$about_life_slides" ),
	'mobile life gallery is viewport bounded and centred' => str_contains( $css, 'width:min(323px,100vw); height:223px; display:block; margin:15px auto 0;' ),
	'mobile B2B card is independently centred' => str_contains( $css, '.nc-about__service-card { position:relative; width:290px; height:727px; display:block; margin-inline:auto;' ),
	'mobile hero interpolates from exact 320 PSD height' => str_contains( $css, 'height:clamp(1391px,calc(1157.86px + 72.857vw),1442px);' ),
	'mobile hero CTA cancels the inherited desktop offset' => str_contains( $css, 'top:-24px; left:0; width:185px; min-width:185px; min-height:55px;' ),
	'mobile FAQ is a bounded 290px composition' => str_contains( $css, 'width:290px; max-width:calc(100% - 28px); display:block; margin-inline:auto;' ),
	'desktop sidebar CTA has source geometry' => str_contains( $css, 'width:293px; min-width:293px; height:63px; min-height:63px;' ) && str_contains( $css, 'border:0; color:#fff; background:var(--nc-about-violet);' ),
	'carousel keeps click keyboard and swipe behavior' => str_contains( $js, "event.key === 'ArrowRight'" ) && str_contains( $js, "addEventListener('touchend'" ) && str_contains( $js, "data-carousel-dot" ),
);

$failed = array_keys( array_filter( $checks, static fn( $passed ) => ! $passed ) );
if ( $failed ) {
	fwrite( STDERR, 'FAILED: ' . implode( '; ', $failed ) . PHP_EOL );
	exit( 1 );
}
echo 'PASS: ' . count( $checks ) . " About reconstruction checks\n";
