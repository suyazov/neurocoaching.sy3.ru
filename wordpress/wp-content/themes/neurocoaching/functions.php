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
		'about_gallery_urls'  => array( 'About: In real life image URLs', get_theme_file_uri( '/assets/images/about-life-source.webp' ) ),
		'career_gallery_urls' => array( 'Career: In real life image URLs', get_theme_file_uri( '/assets/images/career-life.webp' ) ),
		'neuro_gallery_urls'  => array( 'Neurocoaching: In real life image URLs', get_theme_file_uri( '/assets/images/neuro-life.webp' ) ),
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
	return array_slice( $urls ? $urls : array( $fallback ), 0, 24 );
}

function neurocoaching_gallery( $setting, $fallback, $alt, $class_name, $mobile_fallback = '', $slides_override = array(), $fallback_srcset = '' ) {
	$slides = $slides_override ? array_values( array_filter( array_map( 'esc_url_raw', $slides_override ) ) ) : neurocoaching_gallery_urls( $setting, $fallback );
	$count  = count( $slides );
	?>
	<div class="<?php echo esc_attr( $class_name ); ?> nc-gallery<?php echo 1 === $count ? ' nc-gallery--single' : ''; ?>" data-carousel tabindex="0" role="region" aria-roledescription="carousel" aria-label="In real life photo gallery" data-slide-count="<?php echo esc_attr( (string) $count ); ?>">
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

function neurocoaching_header( $active ) {
	$about_images = get_template_directory_uri() . '/assets/images/';
	$is_about     = 'about' === $active;
	$is_career    = 'career' === $active;
	?>
	<header class="site-header" data-site-header>
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Digital Belka home"><?php if ( $is_about ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'about-header-logo-psd.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-logo.png' ); ?>" width="110" height="55" alt="Digital Belka"></picture><?php elseif ( $is_career ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'career-source/mobile-9542-d-belka-logo-copy.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'career-source/desktop-5573-d-belka-alternative-social-web-04.png' ); ?>" width="119" height="59" alt="Digital Belka"></picture><?php else : ?><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ); ?>" alt="Digital Belka"><?php endif; ?></a>
		<div class="about-socials" aria-label="Social links">
			<a href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>" aria-label="LinkedIn"><?php if ( $is_about ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'about-header-linkedin-psd.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-linkedin.svg' ); ?>" width="28" height="28" alt=""></picture><?php elseif ( $is_career ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'career-source/mobile-9546-linkedin.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-linkedin.svg' ); ?>" alt=""></picture><?php else : ?><img src="<?php echo esc_url( $about_images . 'about-linkedin.svg' ); ?>" alt=""><?php endif; ?></a>
			<a href="<?php echo esc_url( neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/' ) ); ?>" aria-label="Instagram"><?php if ( $is_about ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'about-header-instagram-psd.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-instagram.svg' ); ?>" width="28" height="28" alt=""></picture><?php elseif ( $is_career ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'career-source/mobile-9545-instagram.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-instagram.svg' ); ?>" alt=""></picture><?php else : ?><img src="<?php echo esc_url( $about_images . 'about-instagram.svg' ); ?>" alt=""><?php endif; ?></a>
			<a href="<?php echo esc_url( neurocoaching_mod( 'telegram_url', 'https://t.me/' ) ); ?>" aria-label="Telegram"><?php if ( $is_about ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'about-header-telegram-psd.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-telegram.svg' ); ?>" width="30" height="30" alt=""></picture><?php elseif ( $is_career ) : ?><picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $about_images . 'career-source/mobile-9547-telegram.png' ); ?>"><img src="<?php echo esc_url( $about_images . 'about-telegram.svg' ); ?>" alt=""></picture><?php else : ?><img src="<?php echo esc_url( $about_images . 'about-telegram.svg' ); ?>" alt=""><?php endif; ?></a>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-menu-toggle><span class="screen-reader-text">Open menu</span><i></i><i></i><i></i></button>
		<nav id="primary-navigation" class="primary-nav nc-nav" aria-label="Primary navigation">
			<a<?php echo 'about' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( home_url( '/' ) ); ?>">About</a>
			<a<?php echo 'career' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( neurocoaching_page_url( 'career-services' ) ); ?>">Career services</a>
			<a<?php echo 'neuro' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( neurocoaching_page_url( 'neurocoaching' ) ); ?>">Neurocoaching</a>
			<a href="#faqs">FAQs</a>
		</nav>
		<a class="button button--small" href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>"><?php echo 'about' === $active ? 'Connect on Linkedin' : 'Connect on LinkedIn'; ?></a>
	</header>
	<?php
}

function neurocoaching_education() {
	$items = array(
		'15+ years in the UN & international organisations — HR, project management, organisational development',
		'Managed multi-million dollar international projects across UN missions',
		'ICF Certified Neurointegration Coach, Neurointegration Institute, USA',
		'MBA, Webster University, USA',
		'Worked with diplomats, senior UN officials, and international teams across the world',
		'Human Resources Management Certificate, Cornell University, USA',
		'Works with clients in English, Russian & Italian',
		'200+ hours of individual coaching practice',
	);
	?>
	<section class="education" aria-labelledby="education-title">
		<div class="section-inner"><h2 id="education-title">Education &amp; Experience</h2><div class="certificates" aria-label="Selected qualifications"><span>Webster University<br><b>MBA</b></span><span>Neurointegration Institute<br><b>Certified Coach</b></span><span>Cornell University<br><b>Human Resources</b></span><span>United Nations<br><b>15+ years</b></span></div></div>
	</section>
	<div class="credentials section-inner"><ul><?php foreach ( $items as $item ) : ?><li><?php echo esc_html( $item ); ?></li><?php endforeach; ?></ul></div>
	<?php
}

function neurocoaching_services( $title, $cards ) {
	?>
	<section class="services section-inner" aria-labelledby="services-title">
		<h2 id="services-title"><?php echo esc_html( $title ); ?></h2>
		<div class="service-grid">
		<?php foreach ( $cards as $card ) : ?>
			<article class="service-card<?php echo ! empty( $card['featured'] ) ? ' service-card--featured' : ''; ?>">
				<?php if ( ! empty( $card['tag'] ) ) : ?><span class="tag"><?php echo esc_html( $card['tag'] ); ?></span><?php endif; ?>
				<h3><?php echo esc_html( $card['title'] ); ?></h3><p class="waves" aria-hidden="true">≋</p>
				<p><?php echo esc_html( $card['text'] ); ?></p>
				<?php if ( ! empty( $card['items'] ) ) : ?><h4>Includes:</h4><ul><?php foreach ( $card['items'] as $item ) : ?><li><?php echo esc_html( $item ); ?></li><?php endforeach; ?></ul><?php endif; ?>
				<?php if ( ! empty( $card['price'] ) ) : ?><p class="price"><?php echo esc_html( $card['price'] ); ?></p><?php endif; ?>
				<a class="button" href="<?php echo esc_url( neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' ) ); ?>"><?php echo esc_html( ! empty( $card['button'] ) ? $card['button'] : 'Book a call' ); ?></a>
			</article>
		<?php endforeach; ?>
		</div>
	</section>
	<?php
}

function neurocoaching_reviews() {
	$reviews = array(
		array( 'Andrea Scherer', 'Logistics Engineer', 'Ksenia helped me find clarity and confidence. Her structured questions turned uncertainty into a practical next step.' ),
		array( 'Sayantani Tyagi', 'Finance Advisor', 'Her approach is warm, focused and refreshingly honest. I left our work with priorities I could finally act on.' ),
		array( 'Fernand Gouveia', 'Building Innovation Ecosystem', 'The sessions created space to see the wider picture and move forward with energy, purpose and accountability.' ),
	);
	?>
	<section class="reviews" aria-labelledby="reviews-title"><div class="section-inner"><h2 id="reviews-title">Reviews</h2><div class="review-grid"><?php foreach ( $reviews as $review ) : ?><blockquote><p><?php echo esc_html( $review[2] ); ?></p><footer><strong><?php echo esc_html( $review[0] ); ?></strong><br><?php echo esc_html( $review[1] ); ?></footer></blockquote><?php endforeach; ?></div></div></section>
	<?php
}

function neurocoaching_life( $image, $alt ) {
	?><section class="real-life section-inner" aria-labelledby="life-title"><h2 id="life-title">In real life</h2><a href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>">Follow on Instagram</a><div class="life-photo"><span aria-hidden="true">←</span><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>"><span aria-hidden="true">→</span></div><p class="dots" aria-hidden="true">• ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○</p></section><?php
}

function neurocoaching_cta( $career = false ) {
	?><section class="main-cta"><div class="section-inner"><h2><?php echo $career ? 'Ready to take the first step?' : 'Ready to stop waiting for “someday”?'; ?></h2><p>Free 30-min intro call — No commitment</p><a class="button button--light" href="<?php echo esc_url( neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' ) ); ?>">Book a call</a></div></section><?php
}

function neurocoaching_faqs( $career = false ) {
	$questions = array(
		'Who are you and what do you do?' => 'I am a career and neurointegration coach with international leadership and HR experience. I help people find clarity and turn it into practical action.',
		'What is neurointegration and how is it different from regular coaching?' => 'It combines coaching with practical, brain-friendly tools for attention, emotions, habits and sustainable change.',
		'Who is this for?' => 'For people who feel stuck, overloaded, at a crossroads, or ready to make a thoughtful professional or personal change.',
		'Do I need to know what I want before working with you?' => 'No. Creating a clear direction can be the first part of our work together.',
		'How is your approach different from typical career coaching?' => 'We work with the whole person: goals, context, energy, patterns and the next realistic experiment.',
		'What results can I expect?' => 'Greater clarity, a defined direction, practical decisions and a concrete next step.',
		'How long does it take to see results?' => 'Many clients gain useful clarity in the first session; deeper change depends on your goals and chosen format.',
		'What’s the first step?' => 'Start with a conversation. A free 30-minute call lets us understand your situation and decide whether we are a good fit.',
	);
	?>
	<section id="faqs" class="faq section-inner" aria-labelledby="faq-title"><div><h2 id="faq-title">FAQs <small>(Frequently Asked Questions)</small></h2><?php foreach ( $questions as $question => $answer ) : ?><details><summary><?php echo esc_html( $question ); ?></summary><p><?php echo esc_html( $answer ); ?></p></details><?php endforeach; ?></div><aside><div class="aside-art" aria-hidden="true">↗</div><h2>Ready to take the first step?</h2><p>Leave with clarity, a defined direction, and a concrete next step.</p><a class="button" href="<?php echo esc_url( neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' ) ); ?>"><?php echo $career ? 'Book a Consultation Session' : 'Book a call'; ?></a></aside></section>
	<?php
}
