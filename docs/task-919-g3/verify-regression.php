<?php
/** Machine guard for TASK-919 G3 measured mobile geometry and preserved behavior. */
$root  = dirname( __DIR__, 2 );
$front = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/front-page.php' );
$css   = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/style.css' );
$js    = file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/assets/js/navigation.js' );

$checks = array(
	'exact live headings remain present' => preg_match_all( '/Ksenia Belousova|Services \| B2B format|In real life|Ready to take the first step\?|FAQs/', $front ) >= 5,
	'320 PSD header is 53px high' => str_contains( $css, 'height:clamp(53px,calc(16.43px + 11.429vw),61px);' ) && str_contains( $css, 'top:clamp(53px,calc(16.43px + 11.429vw),61px);' ) && str_contains( $css, 'min-height:53px;' ),
	'320 PSD photo retains the 402px layer height' => str_contains( $css, 'height:clamp(402px,calc(182.57px + 68.571vw),450px);' ),
	'mobile B2B card retains the measured 295px width' => substr_count( $css, '.nc-about__service-card { width:295px; margin-inline:auto;' ) === 1,
	'desktop FAQ keeps the measured 663px question column' => str_contains( $css, 'grid-template-columns:663px 290px;' ),
	'desktop FAQ CTA remains source-specific and filled' => str_contains( $css, 'width:293px; min-width:293px; height:63px; min-height:63px;' ) && str_contains( $css, 'border:0; color:#fff; background:var(--nc-about-violet);' ),
	'gallery still normalises to exactly three editable slides' => str_contains( $front, 'array_slice( array_pad( $about_life_slides, 3, $about_life_image ), 0, 3 )' ),
	'carousel controls retain click keyboard and swipe support' => str_contains( $js, "event.key === 'ArrowRight'" ) && str_contains( $js, "addEventListener('touchend'" ) && str_contains( $js, 'data-carousel-dot' ),
	'mobile hero no longer serves the 320px raster' => ! str_contains( $front, 'about-hero-mobile-source.webp' ) && str_contains( $front, 'about-hero-psd-768.webp' ) && str_contains( $front, 'about-hero-source.webp' ) && str_contains( $front, '1537w' ),
	'mobile hero crop is CSS-driven from the full PSD source' => str_contains( $css, 'object-fit:cover; object-position:center top;' ),
	'About photography exposes source-faithful responsive candidates' => str_contains( $front, 'about-life-psd-300.webp 300w' ) && str_contains( $front, "\$about_life_image . ' 600w'" ) && str_contains( $front, 'about-faq-psd-300.webp' ) && str_contains( $front, 'about-faq-source.webp' ) && str_contains( $front, 'width="600" height="800"' ),
	'gallery helper preserves editable URLs while adding fallback srcset' => str_contains( file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/functions.php' ), '$fallback_srcset' ) && str_contains( file_get_contents( $root . '/wordpress/wp-content/themes/neurocoaching/functions.php' ), 'sizes="(max-width: 700px) 290px, 600px"' ),
);

$failed = array_keys( array_filter( $checks, static fn( $passed ) => ! $passed ) );
if ( $failed ) {
	fwrite( STDERR, 'FAILED: ' . implode( '; ', $failed ) . PHP_EOL );
	exit( 1 );
}
echo 'PASS: ' . count( $checks ) . " TASK-919 G3 regression checks\n";
