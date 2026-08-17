<?php
/** Theme setup and semantic page components. @package Neurocoaching */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function neurocoaching_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'neurocoaching_setup' );

function neurocoaching_asset_version( $path, $fallback ) {
	$modified = is_file( $path ) ? filemtime( $path ) : false;
	return false !== $modified ? (string) $modified : $fallback;
}

function neurocoaching_assets() {
	$theme_version      = wp_get_theme()->get( 'Version' );
	$stylesheet_path    = get_stylesheet_directory() . '/style.css';
	$navigation_path    = get_theme_file_path( '/assets/js/navigation.js' );
	$stylesheet_version = neurocoaching_asset_version( $stylesheet_path, $theme_version );
	$navigation_version = neurocoaching_asset_version( $navigation_path, $theme_version );

	wp_enqueue_style( 'neurocoaching', get_stylesheet_uri(), array(), $stylesheet_version );
	wp_enqueue_script( 'neurocoaching-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), $navigation_version, true );
}
add_action( 'wp_enqueue_scripts', 'neurocoaching_assets' );

function neurocoaching_mod( $key, $fallback ) {
	$value = get_theme_mod( $key, $fallback );
	return is_string( $value ) && '' !== trim( $value ) ? $value : $fallback;
}

function neurocoaching_customize_register( $customizer ) {
	$customizer->add_section( 'neurocoaching_content', array( 'title' => __( 'Neurocoaching content', 'neurocoaching' ) ) );
	$fields = array(
		'contact_url' => array( 'LinkedIn CTA URL', 'https://www.linkedin.com/', 'url', 'esc_url_raw' ),
		'instagram_url' => array( 'Instagram URL', 'https://www.instagram.com/', 'url', 'esc_url_raw' ),
		'telegram_url' => array( 'Telegram URL', 'https://t.me/', 'url', 'esc_url_raw' ),
		'email_url' => array( 'Email URL', 'mailto:hello@example.com', 'url', 'esc_url_raw' ),
		'booking_url' => array( 'Booking CTA URL', 'mailto:hello@example.com', 'url', 'esc_url_raw' ),
		'about_name'  => array( 'About page name', 'Ksenia Belousova', 'text', 'sanitize_text_field' ),
	);
	foreach ( $fields as $key => $field ) {
		$customizer->add_setting( $key, array( 'default' => $field[1], 'sanitize_callback' => $field[3] ) );
		$customizer->add_control( $key, array( 'label' => $field[0], 'section' => 'neurocoaching_content', 'type' => $field[2] ) );
	}
	$gallery_fields = array(
		'about_gallery_urls'  => array( 'About: In real life image URLs', implode( "\n", array(
			get_theme_file_uri( '/assets/images/about-life-hires.jpg' ),
			get_theme_file_uri( '/assets/images/about-hero-hires.jpg' ),
			get_theme_file_uri( '/assets/images/about-faq-hires.jpg' ),
		) ) ),
		'career_gallery_urls' => array( 'Career: In real life image URLs', implode( "\n", array(
			get_theme_file_uri( '/assets/images/career-life-hires.jpg' ),
			get_theme_file_uri( '/assets/images/about-life-hires.jpg' ),
			get_theme_file_uri( '/assets/images/neuro-story-hires.jpg' ),
			get_theme_file_uri( '/assets/images/about-faq-hires.jpg' ),
		) ) ),
		'neuro_gallery_urls'  => array( 'Neurocoaching: In real life image URLs', implode( "\n", array(
			get_theme_file_uri( '/assets/images/neurocoaching-source/desktop-1440/desktop-1440-8139-place-your-image-here-double-click-to-edit.png' ),
			get_theme_file_uri( '/assets/images/neurocoaching-source/desktop-1440/desktop-1440-10825-place-your-image-here-double-click-to-edit-copy-3.png' ),
			get_theme_file_uri( '/assets/images/neurocoaching-source/desktop-1440/desktop-1440-6037-place-your-image-here-double-click-to-edit-copy-2.png' ),
			get_theme_file_uri( '/assets/images/neurocoaching-source/desktop-1440/desktop-1440-5230-place-your-image-here-double-click-to-edit.png' ),
		) ) ),
	);
	foreach ( $gallery_fields as $key => $field ) {
		$customizer->add_setting( $key, array( 'default' => $field[1], 'sanitize_callback' => 'sanitize_textarea_field' ) );
		$customizer->add_control( $key, array( 'label' => $field[0], 'description' => __( 'One Media Library image URL per line.', 'neurocoaching' ), 'section' => 'neurocoaching_content', 'type' => 'textarea' ) );
	}
}
add_action( 'customize_register', 'neurocoaching_customize_register' );

function neurocoaching_route_templates( $template ) {
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/', PHP_URL_PATH );
	$routes = array( '/career-services/' => 'page-career-services.php', '/neurocoaching/' => 'page-neurocoaching.php' );
	$path = trailingslashit( '/' . ltrim( (string) $path, '/' ) );
	if ( isset( $routes[ $path ] ) ) {
		global $wp_query;
		if ( $wp_query ) { $wp_query->is_404 = false; }
		status_header( 200 );
		return get_theme_file_path( $routes[ $path ] );
	}
	return $template;
}
add_filter( 'template_include', 'neurocoaching_route_templates', 99 );

function neurocoaching_route_body_class( $classes ) {
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/', PHP_URL_PATH );
	if ( '/career-services/' === trailingslashit( '/' . ltrim( (string) $path, '/' ) ) ) {
		$classes[] = 'career-services-route';
	}
	if ( '/neurocoaching/' === trailingslashit( '/' . ltrim( (string) $path, '/' ) ) ) {
		$classes[] = 'neurocoaching-route';
	}
	return $classes;
}
add_filter( 'body_class', 'neurocoaching_route_body_class' );

function neurocoaching_page_url( $slug ) {
	return 'about' === $slug ? home_url( '/' ) : home_url( '/' . trim( $slug, '/' ) . '/' );
}

function neurocoaching_gallery_urls( $setting, $fallback ) {
	$urls = preg_split( '/\R+/', neurocoaching_mod( $setting, $fallback ) );
	$urls = array_values( array_filter( array_map( 'esc_url_raw', array_map( 'trim', $urls ) ) ) );
	$legacy_assets = array(
		'about-life-source.webp' => 'about-life-hires.jpg',
		'about-hero-source.webp' => 'about-hero-hires.jpg',
		'about-faq-source.webp'  => 'about-faq-hires.jpg',
	);
	if ( 'about_gallery_urls' === $setting ) {
		$urls = array_map( static function ( $url ) use ( $legacy_assets ) {
			$name = wp_basename( wp_parse_url( $url, PHP_URL_PATH ) );
			return isset( $legacy_assets[ $name ] ) ? get_theme_file_uri( '/assets/images/' . $legacy_assets[ $name ] ) : $url;
		}, $urls );
	}
	$legacy_blank_assets = array( 'desktop-9230-img-2842.png', 'mobile-11362-img-2842.png', 'career-life.webp' );
	if ( 'career_gallery_urls' === $setting ) {
		$urls = array_map( static function ( $url ) use ( $fallback, $legacy_blank_assets ) {
			return in_array( wp_basename( wp_parse_url( $url, PHP_URL_PATH ) ), $legacy_blank_assets, true ) ? $fallback : $url;
		}, $urls );
	}
	if ( 'neuro_gallery_urls' === $setting ) {
		$urls = array_map( static function ( $url ) use ( $fallback ) {
			return in_array( wp_basename( wp_parse_url( $url, PHP_URL_PATH ) ), array( 'neuro-life.webp', 'neuro-life-hires.webp' ), true ) ? $fallback : $url;
		}, $urls );
	}
	return array_slice( $urls ? $urls : array( $fallback ), 0, 24 );
}

function neurocoaching_gallery( $setting, $fallback, $alt, $class_name, $mobile_fallback = '', $slides_override = array(), $fallback_srcset = '' ) {
	$slides = $slides_override ? array_values( array_filter( array_map( 'esc_url_raw', $slides_override ) ) ) : neurocoaching_gallery_urls( $setting, $fallback );
	$count  = count( $slides );
	?>
	<div class="<?php echo esc_attr( $class_name ); ?> site-gallery nc-gallery<?php echo 1 === $count ? ' nc-gallery--single' : ''; ?>" data-carousel tabindex="0" role="region" aria-roledescription="carousel" aria-label="In real life photo gallery" data-slide-count="<?php echo esc_attr( (string) $count ); ?>">
		<button class="nc-gallery__previous" type="button" data-carousel-previous aria-label="Previous photo"<?php echo 1 === $count ? ' disabled aria-disabled="true"' : ''; ?>>←</button>
		<div class="nc-gallery__viewport" aria-live="polite">
		<?php foreach ( $slides as $index => $url ) : ?>
			<figure class="nc-gallery__slide" data-carousel-slide<?php echo 0 !== $index ? ' hidden' : ''; ?> aria-label="Photo <?php echo esc_attr( (string) ( $index + 1 ) ); ?> of <?php echo esc_attr( (string) $count ); ?>">
				<?php if ( 0 === $index && $mobile_fallback && $fallback === $url ) : ?><picture><source media="(max-width: 700px)" srcset="<?php echo esc_url( $mobile_fallback ); ?>"><?php endif; ?>
				<img src="<?php echo esc_url( $url ); ?>"<?php echo 0 === $index && $fallback === $url && $fallback_srcset ? ' srcset="' . esc_attr( $fallback_srcset ) . '" sizes="(max-width: 700px) 290px, 600px"' : ''; ?> alt="<?php echo esc_attr( 0 === $index ? $alt : sprintf( 'Ksenia Belousova, gallery photo %d', $index + 1 ) ); ?>">
				<?php if ( 0 === $index && $mobile_fallback && $fallback === $url ) : ?></picture><?php endif; ?>
			</figure>
		<?php endforeach; ?>
		</div>
		<button class="nc-gallery__next" type="button" data-carousel-next aria-label="Next photo"<?php echo 1 === $count ? ' disabled aria-disabled="true"' : ''; ?>>→</button>
		<?php if ( $count > 1 ) : ?>
		<div class="nc-gallery__pagination" data-carousel-pagination aria-label="Choose a photo">
		<?php foreach ( $slides as $index => $url ) : ?>
			<button type="button" data-carousel-dot="<?php echo esc_attr( (string) $index ); ?>" aria-label="Show photo <?php echo esc_attr( (string) ( $index + 1 ) ); ?>" aria-current="<?php echo 0 === $index ? 'true' : 'false'; ?>"></button>
		<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * The certificate set shared by the About and Career Services pages.
 */
function neurocoaching_about_career_certificates() {
	return array(
		array( 'file' => 'about-certificate-1-source.webp', 'alt' => 'Nonproliferation Studies certificate' ),
		array( 'file' => 'about-certificate-2-source.webp', 'alt' => 'Webster University MBA degree' ),
		array( 'file' => 'about-certificate-3-source.webp', 'alt' => 'Webster University bachelor degree' ),
		array( 'file' => 'about-certificate-4-source.webp', 'alt' => 'International Organisations Management certificate' ),
		array( 'file' => 'about-certificate-8-source.webp', 'alt' => 'Targeted advertising certificate' ),
		array( 'file' => 'about-certificate-6-source.webp', 'alt' => 'LVMH certificate' ),
		array( 'file' => 'about-certificate-7-source.webp', 'alt' => 'Social media marketing diploma' ),
		array( 'file' => 'about-certificate-5-source.webp', 'alt' => 'Cornell University Human Resources Management certificate' ),
	);
}

/**
 * Keep Neurocoaching certificates independent until its dedicated set arrives.
 */
function neurocoaching_neuro_certificates() {
	return array_map(
		static function ( $index ) {
			return array(
				'file' => 'neuro-certificate-' . $index . '-source.webp',
				'alt'  => 'Neurocoaching professional certificate ' . $index,
			);
		},
		range( 1, 5 )
	);
}

/**
 * Render the shared certificate preview and lightbox links.
 */
function neurocoaching_certificate_gallery( $class_name, $label, $certificates ) {
	?>
	<div class="<?php echo esc_attr( $class_name ); ?> site-certificates" tabindex="0" role="region" aria-label="<?php echo esc_attr( $label ); ?>" data-horizontal-track>
		<?php foreach ( $certificates as $certificate ) : ?>
			<?php $certificate_url = get_theme_file_uri( '/assets/images/' . $certificate['file'] ); ?>
			<figure><a href="<?php echo esc_url( $certificate_url ); ?>" data-certificate-lightbox><img src="<?php echo esc_url( $certificate_url ); ?>" alt="<?php echo esc_attr( $certificate['alt'] ); ?>" loading="lazy" decoding="async"></a></figure>
		<?php endforeach; ?>
	</div>
	<?php
}

/**
 * Render the canonical education and certificate section.
 */
function neurocoaching_education_section( $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'id'                => 'education-title',
			'target_id'         => 'credentials',
			'section_class'     => '',
			'inner_class'       => '',
			'certificates_class' => '',
			'certificates'      => array(),
			'label'             => 'Certificates; swipe or use left and right arrow keys to browse',
		)
	);
	?>
	<section class="site-section site-education <?php echo esc_attr( $args['section_class'] ); ?>" aria-labelledby="<?php echo esc_attr( $args['id'] ); ?>">
		<div class="site-shell site-education__inner <?php echo esc_attr( $args['inner_class'] ); ?>">
			<h2 class="site-section-title site-education__title" id="<?php echo esc_attr( $args['id'] ); ?>">Education &amp; Experience</h2>
			<?php neurocoaching_certificate_gallery( $args['certificates_class'], $args['label'], $args['certificates'] ); ?>
			<a class="site-education__more" href="#<?php echo esc_attr( $args['target_id'] ); ?>">View more <svg class="education-more-arrow" aria-hidden="true" viewBox="0 0 71 28" width="71" height="28"><path d="M0 14H70M56 1L70 14 56 27" /></svg></a>
		</div>
	</section>
	<?php
}

/**
 * Render the canonical credentials list.
 */
function neurocoaching_credentials_section( $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'id'            => 'credentials',
			'section_class' => '',
			'label'         => 'Qualifications and experience',
			'items'         => array(),
		)
	);
	?>
	<section id="<?php echo esc_attr( $args['id'] ); ?>" class="site-section site-shell site-credentials <?php echo esc_attr( $args['section_class'] ); ?>" aria-label="<?php echo esc_attr( $args['label'] ); ?>" tabindex="-1">
		<ul>
			<?php foreach ( $args['items'] as $item ) : ?>
				<li><span class="site-check" aria-hidden="true">&#10003;</span><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>
	</section>
	<?php
}

/**
 * Render the canonical call-to-action band.
 */
function neurocoaching_cta_section( $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'heading'       => 'Ready to take the first step?',
			'text'          => 'Free 30-min intro call · No commitment',
			'button_label'  => 'Book a free call',
			'button_url'    => 'mailto:hello@example.com',
			'section_class' => '',
			'inner_class'   => '',
		)
	);
	?>
	<section class="site-section site-cta <?php echo esc_attr( $args['section_class'] ); ?>">
		<div class="site-shell site-cta__inner <?php echo esc_attr( $args['inner_class'] ); ?>">
			<h2 class="site-section-title"><?php echo esc_html( $args['heading'] ); ?></h2>
			<p><?php echo esc_html( $args['text'] ); ?></p>
			<a class="site-button site-cta__button" href="<?php echo esc_url( $args['button_url'] ); ?>"><?php echo esc_html( $args['button_label'] ); ?></a>
		</div>
	</section>
	<?php
}

/**
 * Render the canonical FAQ list and adjacent booking panel.
 */
function neurocoaching_faq_section( $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'id'             => 'faq-title',
			'section_class'  => '',
			'questions_class' => '',
			'questions'      => array(),
			'open_question'  => '',
			'closing'        => '',
			'image'          => '',
			'image_width'    => 600,
			'image_height'   => 800,
			'image_alt'      => 'Ksenia Belousova',
			'aside_heading'  => 'Ready to take the first step?',
			'aside_text'     => 'Leave with clarity, a defined direction, and a concrete next step.',
			'button_label'   => 'Book a free call',
			'button_url'     => 'mailto:hello@example.com',
		)
	);
	?>
	<section id="faqs" class="site-section site-shell site-faq <?php echo esc_attr( $args['section_class'] ); ?>" aria-labelledby="<?php echo esc_attr( $args['id'] ); ?>">
		<header class="site-faq__header"><h2 class="site-section-title" id="<?php echo esc_attr( $args['id'] ); ?>">FAQs</h2><p>(Frequently Asked Questions)</p></header>
		<div class="site-faq__questions <?php echo esc_attr( $args['questions_class'] ); ?>">
			<?php foreach ( $args['questions'] as $question => $answer ) : ?>
				<details<?php echo $question === $args['open_question'] ? ' open' : ''; ?>><summary><?php echo esc_html( $question ); ?></summary><p><?php echo esc_html( $answer ); ?></p></details>
			<?php endforeach; ?>
			<?php if ( $args['closing'] ) : ?><p class="site-faq__closing"><?php echo esc_html( $args['closing'] ); ?></p><?php endif; ?>
		</div>
		<aside class="site-faq__aside">
			<img src="<?php echo esc_url( $args['image'] ); ?>" width="<?php echo esc_attr( (string) $args['image_width'] ); ?>" height="<?php echo esc_attr( (string) $args['image_height'] ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>">
			<h2><?php echo esc_html( $args['aside_heading'] ); ?></h2>
			<p><?php echo esc_html( $args['aside_text'] ); ?></p>
			<a class="site-button site-faq__button" href="<?php echo esc_url( $args['button_url'] ); ?>"><?php echo esc_html( $args['button_label'] ); ?></a>
		</aside>
	</section>
	<?php
}

/**
 * Render the canonical "In real life" block used on every public route.
 */
function neurocoaching_real_life_section( $title_id, $instagram_url, $setting, $fallback, $alt, $slides_override = array() ) {
	$images = get_template_directory_uri() . '/assets/images/';
	?>
	<section class="site-section site-life nc-about__life" aria-labelledby="<?php echo esc_attr( $title_id ); ?>">
		<h2 class="site-section-title site-life__title" id="<?php echo esc_attr( $title_id ); ?>">In real life</h2>
		<a class="site-life__social nc-about__instagram" href="<?php echo esc_url( $instagram_url ); ?>">Follow on Instagram <img src="<?php echo esc_url( $images . 'about-instagram.svg' ); ?>" alt=""></a>
		<?php neurocoaching_gallery( $setting, $fallback, $alt, 'nc-about__life-photo', '', $slides_override ); ?>
	</section>
	<?php
}

function neurocoaching_header( $active ) {
	$about_images = get_template_directory_uri() . '/assets/images/';
	$is_about     = 'about' === $active;
	$is_career    = 'career' === $active;
	$is_neuro     = 'neuro' === $active;
	?>
	<header class="site-header" data-site-header>
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Digital Belka home"><img src="<?php echo esc_url( $about_images . 'logo-belka.svg' ); ?>" width="110" height="58" alt="Digital Belka"></a>
		<div class="about-socials" aria-label="Social links">
			<a href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>" aria-label="LinkedIn"><img src="<?php echo esc_url( $about_images . 'about-linkedin-v2.svg' ); ?>" width="28" height="28" alt=""></a>
			<a href="<?php echo esc_url( neurocoaching_mod( 'email_url', 'mailto:hello@example.com' ) ); ?>" aria-label="Email"><img src="<?php echo esc_url( $about_images . 'icon-mail.svg' ); ?>" width="28" height="28" alt=""></a>
			<a href="<?php echo esc_url( neurocoaching_mod( 'telegram_url', 'https://t.me/' ) ); ?>" aria-label="Telegram"><img src="<?php echo esc_url( $about_images . 'about-telegram-v2.svg' ); ?>" width="28" height="28" alt=""></a>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-menu-toggle><span class="screen-reader-text">Open menu</span><i></i><i></i><i></i></button>
		<nav id="primary-navigation" class="primary-nav nc-nav" aria-label="Primary navigation">
			<a<?php echo 'about' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( home_url( '/' ) ); ?>">About</a>
			<a<?php echo 'career' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( neurocoaching_page_url( 'career-services' ) ); ?>">Career services</a>
			<a<?php echo 'neuro' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( neurocoaching_page_url( 'neurocoaching' ) ); ?>">Neurocoaching</a>
			<a href="#faqs">FAQs</a>
		</nav>
		<a class="site-button button button--small" href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>"><?php echo 'about' === $active ? 'Connect on Linkedin' : 'Connect on LinkedIn'; ?></a>
	</header>
	<?php
}
