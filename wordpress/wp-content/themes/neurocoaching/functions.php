<?php
/** Theme setup and PSD-authored page rendering. @package Neurocoaching */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function neurocoaching_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'neurocoaching_setup' );

function neurocoaching_assets() {
	wp_enqueue_style( 'neurocoaching', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'neurocoaching_assets' );

function neurocoaching_mod( $key, $fallback ) {
	$value = get_theme_mod( $key, $fallback );
	return is_string( $value ) ? $value : $fallback;
}

function neurocoaching_customize_register( $customizer ) {
	$customizer->add_section( 'neurocoaching_links', array( 'title' => __( 'Neurocoaching links', 'neurocoaching' ) ) );
	$customizer->add_setting( 'contact_url', array( 'default' => 'https://www.linkedin.com/', 'sanitize_callback' => 'esc_url_raw' ) );
	$customizer->add_control( 'contact_url', array( 'label' => 'LinkedIn CTA URL', 'section' => 'neurocoaching_links', 'type' => 'url' ) );
}
add_action( 'customize_register', 'neurocoaching_customize_register' );

function neurocoaching_route_templates( $template ) {
	$path   = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/', PHP_URL_PATH );
	$routes = array( '/career-services/' => 'page-career-services.php', '/neurocoaching/' => 'page-neurocoaching.php' );
	$path   = trailingslashit( '/' . ltrim( (string) $path, '/' ) );
	if ( isset( $routes[ $path ] ) ) {
		global $wp_query;
		if ( $wp_query ) { $wp_query->is_404 = false; }
		status_header( 200 );
		return get_theme_file_path( $routes[ $path ] );
	}
	return $template;
}
add_filter( 'template_include', 'neurocoaching_route_templates', 99 );

function neurocoaching_page_url( $slug ) {
	return 'about' === $slug ? home_url( '/' ) : home_url( '/' . trim( $slug, '/' ) . '/' );
}

/** Render approved desktop/mobile PSD artboards with a semantic outline. */
function neurocoaching_psd_page( $slug, $title, $headings ) {
	$asset_root = get_template_directory_uri() . '/assets/design/';
	$heights    = array( 'about' => 6019, 'career' => 9212, 'neurocoaching' => 10926 );
	?>
	<article class="psd-page" aria-labelledby="psd-page-title">
		<nav class="screen-reader-text" aria-label="Primary navigation">
			<a href="<?php echo esc_url( neurocoaching_page_url( 'about' ) ); ?>">About</a>
			<a href="<?php echo esc_url( neurocoaching_page_url( 'career-services' ) ); ?>">Career services</a>
			<a href="<?php echo esc_url( neurocoaching_page_url( 'neurocoaching' ) ); ?>">Neurocoaching</a>
			<a href="#faqs">FAQs</a>
			<a href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>">Connect on LinkedIn</a>
		</nav>
		<div class="screen-reader-text">
			<h1 id="psd-page-title"><?php echo esc_html( $title ); ?></h1>
			<?php foreach ( $headings as $heading ) : ?>
				<section<?php echo 'FAQs' === $heading ? ' id="faqs"' : ''; ?>><h2><?php echo esc_html( $heading ); ?></h2></section>
			<?php endforeach; ?>
		</div>
		<picture class="psd-page__artwork">
			<source media="(max-width: 600px)" srcset="<?php echo esc_url( $asset_root . $slug . '-mobile.webp' ); ?>">
			<img src="<?php echo esc_url( $asset_root . $slug . '-desktop.webp' ); ?>" alt="<?php echo esc_attr( $title ); ?> — approved client layout" width="1440" height="<?php echo esc_attr( $heights[ $slug ] ); ?>">
		</picture>
	</article>
	<?php
}
