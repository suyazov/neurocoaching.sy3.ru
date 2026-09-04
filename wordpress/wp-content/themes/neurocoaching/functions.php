<?php
/** Theme setup and semantic page components. @package Neurocoaching */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function neurocoaching_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'neurocoaching_setup' );

/**
 * Own these locations without invoking Elementor's legacy document renderer.
 * Otherwise Theme Builder replaces get_header/get_footer with its fallback,
 * renders the old OceanWP templates (including a high-priority PNG logo), and
 * discards our document shell. CSS hiding does not prevent those downloads.
 * Registration is theme-local; old templates and editor previews stay intact.
 */
function neurocoaching_register_theme_locations( $locations_manager ) {
	if ( is_admin() || isset( $_GET['elementor-preview'] ) ) {
		return;
	}
	$locations_manager->register_location( 'header' );
	$locations_manager->register_location( 'footer' );
}
add_action( 'elementor/theme/register_locations', 'neurocoaching_register_theme_locations' );

/**
 * Provide branded favicon assets when WordPress has no custom Site Icon.
 */
function neurocoaching_favicon_tags() {
	if ( has_site_icon() ) {
		return;
	}

	$images = get_theme_file_uri( '/assets/images/' );
	?>
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( $images . 'favicon-32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( $images . 'favicon-192.png' ); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $images . 'apple-touch-icon.png' ); ?>">
	<?php
}
add_action( 'wp_head', 'neurocoaching_favicon_tags', 2 );

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

/** Discover the two above-the-fold heading fonts before the stylesheet loads.
 * The cold mobile trace showed late font swaps moving the About hero copy.
 */
function neurocoaching_preload_heading_fonts() {
	if ( is_admin() || isset( $_GET['elementor-preview'] ) ) {
		return;
	}
	foreach ( array( 'ibm-plex-sans-700-latin.woff2' => 'all', 'lato-900-latin.woff2' => '(min-width: 851px)', 'belka-heavy-800-latin.woff2' => '(max-width: 850px)' ) as $font => $media ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin media="%s">' . "\n",
			esc_url( get_theme_file_uri( '/assets/fonts/' . $font ) ),
			esc_attr( $media )
		);
	}
}
add_action( 'wp_head', 'neurocoaching_preload_heading_fonts', 1 );

/**
 * Remove unused builder assets and Google Fonts from the public frontend.
 *
 * Every public route is rendered by this theme's PHP templates and shared
 * components; Elementor is not used for page content. Its plugins still enqueue
 * their complete frontend bundle because the corresponding WordPress pages keep
 * historical Elementor metadata. The theme also ships all of its fonts locally.
 * Removing these unused assets avoids dozens of render-blocking requests while
 * leaving the WordPress admin and Elementor preview untouched.
 */
function neurocoaching_dequeue_unused_frontend_assets() {
	if ( is_admin() || isset( $_GET['elementor-preview'] ) ) {
		return;
	}

	$builder_asset_paths = array(
		'/wp-content/plugins/elementor/',
		'/wp-content/plugins/pro-elements/',
		'/wp-content/plugins/elementskit-lite/',
		'/wp-content/uploads/elementor/css/',
	);

	$styles = wp_styles();
	foreach ( $styles->queue as $handle ) {
		if ( ! isset( $styles->registered[ $handle ] ) ) {
			continue;
		}

		$style = $styles->registered[ $handle ];
		$src = isset( $style->src ) && is_string( $style->src ) ? $style->src : '';
		if ( preg_match( '#fonts\.(googleapis|gstatic)\.com#i', $src ) || neurocoaching_url_contains_any( $src, $builder_asset_paths ) ) {
			wp_dequeue_style( $handle );
		}
	}

	$scripts = wp_scripts();
	foreach ( $scripts->queue as $handle ) {
		if ( ! isset( $scripts->registered[ $handle ] ) ) {
			continue;
		}

		$script = $scripts->registered[ $handle ];
		$src    = isset( $script->src ) && is_string( $script->src ) ? $script->src : '';
		if ( neurocoaching_url_contains_any( $src, $builder_asset_paths ) ) {
			wp_dequeue_script( $handle );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'neurocoaching_dequeue_unused_frontend_assets', 1000 );

function neurocoaching_url_contains_any( $url, $needles ) {
	foreach ( $needles as $needle ) {
		if ( false !== strpos( $url, $needle ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Remove builder tags that are enqueued after wp_enqueue_scripts has run.
 *
 * Elementor can discover historical document assets while rendering the
 * footer. Loader filters are therefore the final guard for public templates.
 */
function neurocoaching_filter_unused_style_tag( $html, $handle, $href ) {
	if ( is_admin() || isset( $_GET['elementor-preview'] ) ) {
		return $html;
	}

	$builder_asset_paths = array(
		'/wp-content/plugins/elementor/',
		'/wp-content/plugins/pro-elements/',
		'/wp-content/plugins/elementskit-lite/',
		'/wp-content/uploads/elementor/css/',
	);

	if ( preg_match( '#fonts\.(googleapis|gstatic)\.com#i', $href ) || neurocoaching_url_contains_any( $href, $builder_asset_paths ) ) {
		return '';
	}

	return $html;
}
add_filter( 'style_loader_tag', 'neurocoaching_filter_unused_style_tag', 1000, 3 );

function neurocoaching_filter_unused_script_tag( $tag, $handle, $src ) {
	if ( is_admin() || isset( $_GET['elementor-preview'] ) ) {
		return $tag;
	}

	$builder_asset_paths = array(
		'/wp-content/plugins/elementor/',
		'/wp-content/plugins/pro-elements/',
		'/wp-content/plugins/elementskit-lite/',
	);

	return neurocoaching_url_contains_any( $src, $builder_asset_paths ) ? '' : $tag;
}
add_filter( 'script_loader_tag', 'neurocoaching_filter_unused_script_tag', 1000, 3 );

function neurocoaching_strip_google_fonts_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}
	return array_values(
		array_filter(
			$urls,
			static function ( $url ) {
				$href = is_array( $url ) && isset( $url['href'] ) ? $url['href'] : $url;
				return ! ( is_string( $href ) && preg_match( '#fonts\.(googleapis|gstatic)\.com#i', $href ) );
			}
		)
	);
}
add_filter( 'wp_resource_hints', 'neurocoaching_strip_google_fonts_hints', 10, 2 );

// Elementor never renders content on these templates; keep its Google Fonts off at the source too.
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );

function neurocoaching_mod( $key, $fallback ) {
	$value = get_theme_mod( $key, $fallback );
	return is_string( $value ) && '' !== trim( $value ) ? $value : $fallback;
}

function neurocoaching_email_url() {
	return neurocoaching_mod( 'email_url', 'mailto:kseniaalex@gmail.com' );
}

function neurocoaching_customize_register( $customizer ) {
	$customizer->add_section( 'neurocoaching_content', array( 'title' => __( 'Neurocoaching content', 'neurocoaching' ) ) );
	$fields = array(
		'contact_url' => array( 'LinkedIn CTA URL', 'https://www.linkedin.com/in/belka80/', 'url', 'esc_url_raw' ),
		'booking_url' => array( 'Booking CTA URL', 'https://calendly.com/digitalbelka/consultation', 'url', 'esc_url_raw' ),
		'instagram_url' => array( 'Instagram URL', 'https://www.instagram.com/belka80', 'url', 'esc_url_raw' ),
		'telegram_url' => array( 'Telegram URL', 'https://t.me/BEL_KA80', 'url', 'esc_url_raw' ),
		'email_url' => array( 'Email URL', neurocoaching_email_url(), 'url', 'esc_url_raw' ),
		'about_name'  => array( 'About page name', 'Ksenia Belousova', 'text', 'sanitize_text_field' ),
	);
	foreach ( $fields as $key => $field ) {
		$customizer->add_setting( $key, array( 'default' => $field[1], 'sanitize_callback' => $field[3] ) );
		$customizer->add_control( $key, array( 'label' => $field[0], 'section' => 'neurocoaching_content', 'type' => $field[2] ) );
	}
	$gallery_fields = array(
		'about_gallery_urls'  => array( 'About: In real life image URLs', implode( "\n", neurocoaching_about_gallery_urls() ) ),
		'career_gallery_urls' => array( 'Career: In real life image URLs', implode( "\n", neurocoaching_career_gallery_urls() ) ),
		'neuro_gallery_urls'  => array( 'Neurocoaching: In real life image URLs', implode( "\n", neurocoaching_neuro_gallery_urls() ) ),
	);
	foreach ( $gallery_fields as $key => $field ) {
		$customizer->add_setting( $key, array( 'default' => $field[1], 'sanitize_callback' => 'sanitize_textarea_field' ) );
		$customizer->add_control( $key, array( 'label' => $field[0], 'description' => __( 'One Media Library image URL per line.', 'neurocoaching' ), 'section' => 'neurocoaching_content', 'type' => 'textarea' ) );
	}
}
add_action( 'customize_register', 'neurocoaching_customize_register' );

/**
 * Keep enquiries private and visible only in the WordPress dashboard.
 */
function neurocoaching_register_enquiry_type() {
	register_post_type(
		'contact_enquiry',
		array(
			'labels'             => array(
				'name'          => 'Contact enquiries',
				'singular_name' => 'Contact enquiry',
			),
			'public'             => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => false,
			'menu_icon'          => 'dashicons-email-alt',
			'supports'           => array( 'title', 'editor' ),
			'capabilities'       => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'       => true,
		)
	);
}
add_action( 'init', 'neurocoaching_register_enquiry_type' );

function neurocoaching_route_templates( $template ) {
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/', PHP_URL_PATH );
	$routes = array(
		'/career-services/' => 'page-career-services.php',
		'/neurocoaching/'    => 'page-neurocoaching.php',
		'/contact/'          => 'page-contact.php',
	);
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
	if ( '/contact/' === trailingslashit( '/' . ltrim( (string) $path, '/' ) ) ) {
		$classes[] = 'contact-route';
	}
	return $classes;
}
add_filter( 'body_class', 'neurocoaching_route_body_class' );

function neurocoaching_page_url( $slug ) {
	return 'about' === $slug ? home_url( '/' ) : home_url( '/' . trim( $slug, '/' ) . '/' );
}

function neurocoaching_contact_url() {
	return neurocoaching_page_url( 'contact' );
}

function neurocoaching_booking_url() {
	return neurocoaching_mod( 'booking_url', 'https://calendly.com/digitalbelka/consultation' );
}

function neurocoaching_contact_redirect( $status ) {
	$url = add_query_arg( 'contact_status', sanitize_key( $status ), neurocoaching_contact_url() );
	wp_safe_redirect( $url . '#contact-form' );
	exit;
}

/**
 * Validate the public contact form, store it privately and send a notification
 * when the server has a working mail transport.
 */
function neurocoaching_handle_contact_form() {
	if ( 'POST' !== strtoupper( isset( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : '' ) ) {
		neurocoaching_contact_redirect( 'invalid' );
	}

	$nonce = isset( $_POST['neurocoaching_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['neurocoaching_contact_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'neurocoaching_contact' ) ) {
		neurocoaching_contact_redirect( 'invalid' );
	}

	$website = isset( $_POST['website'] ) ? sanitize_text_field( wp_unslash( $_POST['website'] ) ) : '';
	if ( '' !== $website ) {
		neurocoaching_contact_redirect( 'sent' );
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent = isset( $_POST['consent'] ) && '1' === sanitize_text_field( wp_unslash( $_POST['consent'] ) );

	if ( '' === $name || strlen( $name ) > 120 || ! is_email( $email ) || strlen( $phone ) > 80 || strlen( $message ) < 10 || strlen( $message ) > 5000 || ! $consent ) {
		neurocoaching_contact_redirect( 'invalid' );
	}

	$recipient = sanitize_email( get_option( 'admin_email' ) );
	$subject = sprintf( 'Digital Belka website enquiry from %s', $name );
	$body    = implode(
		"\n",
		array(
			'Name: ' . $name,
			'Email: ' . $email,
			'Phone: ' . ( '' !== $phone ? $phone : 'Not provided' ),
			'',
			'Message:',
			$message,
		)
	);
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	);

	$enquiry_id = wp_insert_post(
		array(
			'post_type'    => 'contact_enquiry',
			'post_status'  => 'private',
			'post_title'   => $name . ' — ' . $email,
			'post_content' => $body,
		),
		true
	);
	if ( is_wp_error( $enquiry_id ) || ! $enquiry_id ) {
		neurocoaching_contact_redirect( 'failed' );
	}

	if ( is_email( $recipient ) ) {
		wp_mail( $recipient, $subject, $body, $headers );
	}
	neurocoaching_contact_redirect( 'sent' );
}
add_action( 'admin_post_neurocoaching_contact', 'neurocoaching_handle_contact_form' );
add_action( 'admin_post_nopriv_neurocoaching_contact', 'neurocoaching_handle_contact_form' );

/**
 * Return the client-supplied About photo set in its intended sequence.
 */
function neurocoaching_about_gallery_urls() {
	$urls = array();
	$sequence = array_merge( array( 19 ), range( 1, 18 ), range( 20, 61 ) );
	foreach ( $sequence as $index ) {
		$urls[] = get_theme_file_uri( sprintf( '/assets/images/about-gallery-%03d.webp', $index ) );
	}

	return $urls;
}

/**
 * Return the client-supplied Career Services photo set in its intended sequence.
 */
function neurocoaching_career_gallery_urls() {
	$urls = array();
	for ( $index = 1; $index <= 21; $index++ ) {
		$urls[] = get_theme_file_uri( sprintf( '/assets/images/career-gallery-%03d.webp', $index ) );
	}

	return $urls;
}

/**
 * Return the client-supplied Neurocoaching photo set in its intended sequence.
 */
function neurocoaching_neuro_gallery_urls() {
	$urls = array();
	for ( $index = 1; $index <= 15; $index++ ) {
		$urls[] = get_theme_file_uri( sprintf( '/assets/images/neuro-gallery-%03d.webp', $index ) );
	}

	return $urls;
}

function neurocoaching_gallery_urls( $setting, $fallback ) {
	$urls = preg_split( '/\R+/', neurocoaching_mod( $setting, $fallback ) );
	$urls = array_values( array_filter( array_map( 'esc_url_raw', array_map( 'trim', $urls ) ) ) );
	$optimized_assets = array(
		'about-life-source.webp'  => 'about-life-hires.webp',
		'about-life-hires.jpg'    => 'about-life-hires.webp',
		'about-hero-source.webp'  => 'about-hero-hires.webp',
		'about-hero-hires.jpg'    => 'about-hero-hires.webp',
		'about-faq-source.webp'   => 'about-faq-hires.webp',
		'about-faq-hires.jpg'     => 'about-faq-hires.webp',
		'career-life-hires.jpg'   => 'career-life-hires.webp',
		'neuro-story-hires.jpg'   => 'neuro-story-hires.webp',
		'desktop-8139-place-your-image-here-double-click-to-edit.png'        => 'neuro-life-1-hires.webp',
		'desktop-1440-8139-place-your-image-here-double-click-to-edit.png'   => 'neuro-life-1-hires.webp',
		'desktop-1440-10825-place-your-image-here-double-click-to-edit-copy-3.png' => 'neuro-life-2-hires.webp',
		'desktop-1440-6037-place-your-image-here-double-click-to-edit-copy-2.png'  => 'neuro-hero-client-20260825.webp',
		'desktop-1440-5230-place-your-image-here-double-click-to-edit.png'   => 'neuro-life-4-hires.webp',
	);
	$urls = array_map( static function ( $url ) use ( $optimized_assets ) {
		$name = wp_basename( wp_parse_url( $url, PHP_URL_PATH ) );
		return isset( $optimized_assets[ $name ] ) ? get_theme_file_uri( '/assets/images/' . $optimized_assets[ $name ] ) : $url;
	}, $urls );
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
	$limit = 'about_gallery_urls' === $setting ? 100 : 24;
	return array_slice( $urls ? $urls : array( $fallback ), 0, $limit );
}

/**
 * Return intrinsic dimensions for an image stored in the theme image directory.
 */
function neurocoaching_theme_image_dimensions( $url ) {
	$filename = wp_basename( wp_parse_url( $url, PHP_URL_PATH ) );
	$path     = get_theme_file_path( '/assets/images/' . $filename );
	$size     = is_file( $path ) ? getimagesize( $path ) : false;

	return $size ? array( (int) $size[0], (int) $size[1] ) : array();
}

function neurocoaching_gallery( $setting, $fallback, $alt, $class_name, $mobile_fallback = '', $slides_override = array(), $fallback_srcset = '' ) {
	$slides = $slides_override ? array_values( array_filter( array_map( 'esc_url_raw', $slides_override ) ) ) : neurocoaching_gallery_urls( $setting, $fallback );
	$count  = count( $slides );
	?>
	<div class="<?php echo esc_attr( $class_name ); ?> site-gallery nc-gallery<?php echo 1 === $count ? ' nc-gallery--single' : ''; ?><?php echo $count > 12 ? ' nc-gallery--many' : ''; ?>" data-carousel tabindex="0" role="region" aria-roledescription="carousel" aria-label="In real life photo gallery" data-slide-count="<?php echo esc_attr( (string) $count ); ?>">
		<button class="nc-gallery__previous" type="button" data-carousel-previous aria-label="Previous photo"<?php echo 1 === $count ? ' disabled aria-disabled="true"' : ''; ?>>←</button>
		<div class="nc-gallery__viewport" aria-live="polite">
		<?php foreach ( $slides as $index => $url ) : ?>
			<?php
			$dimensions      = neurocoaching_theme_image_dimensions( $url );
			$filename        = wp_basename( wp_parse_url( $url, PHP_URL_PATH ) );
			$small_filename  = preg_replace( '/\.webp$/', '-700.webp', $filename );
			$small_path      = get_theme_file_path( '/assets/images/' . $small_filename );
			$small_dimensions = is_file( $small_path ) ? getimagesize( $small_path ) : false;
			$responsive_set  = '';
			$responsive_size = '';
			if ( $small_filename !== $filename && $small_dimensions && $dimensions && $small_dimensions[0] < $dimensions[0] ) {
				$responsive_set  = get_theme_file_uri( '/assets/images/' . $small_filename ) . ' ' . $small_dimensions[0] . 'w, ' . $url . ' ' . $dimensions[0] . 'w';
				$responsive_size = '(max-width: 700px) calc(100vw - 30px), 930px';
			} elseif ( 0 === $index && $fallback === $url && $fallback_srcset ) {
				$responsive_set  = $fallback_srcset;
				$responsive_size = '(max-width: 700px) 290px, 600px';
			}
			?>
			<figure class="nc-gallery__slide" data-carousel-slide<?php echo 0 !== $index ? ' hidden' : ''; ?> aria-label="Photo <?php echo esc_attr( (string) ( $index + 1 ) ); ?> of <?php echo esc_attr( (string) $count ); ?>">
				<?php if ( 0 === $index && $mobile_fallback && $fallback === $url ) : ?><picture><source media="(max-width: 700px)" srcset="<?php echo esc_url( $mobile_fallback ); ?>"><?php endif; ?>
				<img src="<?php echo esc_url( $url ); ?>"<?php echo $dimensions ? ' width="' . esc_attr( (string) $dimensions[0] ) . '" height="' . esc_attr( (string) $dimensions[1] ) . '"' : ''; ?><?php echo $responsive_set ? ' srcset="' . esc_attr( $responsive_set ) . '" sizes="' . esc_attr( $responsive_size ) . '"' : ''; ?> alt="<?php echo esc_attr( 0 === $index ? $alt : sprintf( 'Ksenia Belousova, gallery photo %d', $index + 1 ) ); ?>" loading="lazy" decoding="async">
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
 * The Neurocoaching-only certificate set supplied by the client.
 */
function neurocoaching_neuro_certificates() {
	return array(
		array( 'file' => 'neuro-integration-certificate-01-source.webp', 'alt' => 'Neurointegration Trainer professional retraining diploma' ),
		array( 'file' => 'neuro-integration-certificate-03-source.webp', 'alt' => 'HarvardX Managing Happiness verified certificate' ),
		array( 'file' => 'neuro-integration-certificate-04-source.webp', 'alt' => 'Certified Neurointegration Coach professional development certificate' ),
		array( 'file' => 'neuro-integration-certificate-05-source.webp', 'alt' => 'Inside LVMH certificate' ),
		array( 'file' => 'neuro-integration-certificate-06-source.webp', 'alt' => 'Neurointegration Fundamentals certificate of completion' ),
		array( 'file' => 'neuro-integration-certificate-07-source.webp', 'alt' => 'Neurointegration Practical Module certificate of completion' ),
		array( 'file' => 'neuro-integration-certificate-08-source.webp', 'alt' => 'Neurointegration Trainer certificate of completion' ),
	);
}

/**
 * Render the shared certificate preview and lightbox links.
 */
function neurocoaching_certificate_gallery( $class_name, $label, $certificates ) {
	?>
	<div class="<?php echo esc_attr( $class_name ); ?> site-certificates" tabindex="0" role="region" aria-label="<?php echo esc_attr( $label ); ?>" data-horizontal-track>
		<?php foreach ( $certificates as $certificate ) : ?>
			<?php
			$certificate_url = get_theme_file_uri( '/assets/images/' . $certificate['file'] );
			$thumbnail_file  = str_replace( '-source.webp', '-thumb.webp', $certificate['file'] );
			$small_file      = str_replace( '-source.webp', '-thumb-200.webp', $certificate['file'] );
			$thumbnail_path  = get_theme_file_path( '/assets/images/' . $thumbnail_file );
			$small_path      = get_theme_file_path( '/assets/images/' . $small_file );
			$thumbnail_url   = is_file( $thumbnail_path ) ? get_theme_file_uri( '/assets/images/' . $thumbnail_file ) : $certificate_url;
			$small_url       = is_file( $small_path ) ? get_theme_file_uri( '/assets/images/' . $small_file ) : '';
			$thumbnail_size  = is_file( $thumbnail_path ) ? getimagesize( $thumbnail_path ) : false;
			?>
			<figure><a href="<?php echo esc_url( $certificate_url ); ?>" data-certificate-lightbox><img src="<?php echo esc_url( $thumbnail_url ); ?>"<?php echo $small_url ? ' srcset="' . esc_url( $small_url ) . ' 200w, ' . esc_url( $thumbnail_url ) . ' 360w" sizes="(max-width: 700px) 180px, 230px"' : ''; ?><?php echo $thumbnail_size ? ' width="' . esc_attr( (string) $thumbnail_size[0] ) . '" height="' . esc_attr( (string) $thumbnail_size[1] ) . '"' : ''; ?> alt="<?php echo esc_attr( $certificate['alt'] ); ?>" loading="lazy" decoding="async"></a></figure>
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
			<h2 class="site-section-title site-education__title" id="<?php echo esc_attr( $args['id'] ); ?>">Education<br class="site-mobile-break"> &amp; Experience</h2>
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
	// All three mobile PSDs share this visual sequence. Keep desktop grid order.
	$mobile_prefixes = array( '15+', 'Managed', 'ICF', 'MBA', 'Worked', 'Human Resources', 'Works', '200+' );
	?>
	<section id="<?php echo esc_attr( $args['id'] ); ?>" class="site-section site-shell site-credentials <?php echo esc_attr( $args['section_class'] ); ?>" aria-label="<?php echo esc_attr( $args['label'] ); ?>" tabindex="-1">
		<ul>
			<?php foreach ( $args['items'] as $item ) : ?>
				<?php
				$mobile_order = count( $mobile_prefixes );
				foreach ( $mobile_prefixes as $order => $prefix ) {
					if ( 0 === strpos( $item, $prefix ) ) { $mobile_order = $order; break; }
				}
				?>
				<li style="--credential-mobile-order:<?php echo (int) $mobile_order; ?>"><span class="site-check" aria-hidden="true"></span><?php echo esc_html( $item ); ?></li>
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
			'button_url'    => neurocoaching_booking_url(),
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
			'image_mobile'   => '',
			'image_width'    => 600,
			'image_height'   => 800,
			'image_alt'      => 'Ksenia Belousova',
			'aside_heading'  => 'Ready to take the first step?',
			'aside_text'     => 'Leave with clarity, a defined direction, and a concrete next step.',
			'button_label'   => 'Book a free call',
			'button_url'     => neurocoaching_booking_url(),
		)
	);
	// Reserve the mobile photo's own ratio before its lazy request finishes.
	// The About mobile source is 1537x1346, not the desktop image's 700x910.
	$mobile_dimensions = $args['image_mobile'] ? neurocoaching_theme_image_dimensions( $args['image_mobile'] ) : array();
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
			<picture>
				<?php if ( $args['image_mobile'] ) : ?><source media="(max-width: 850px)" srcset="<?php echo esc_url( $args['image_mobile'] ); ?>"<?php echo $mobile_dimensions ? ' width="' . esc_attr( (string) $mobile_dimensions[0] ) . '" height="' . esc_attr( (string) $mobile_dimensions[1] ) . '"' : ''; ?>><?php endif; ?>
				<img src="<?php echo esc_url( $args['image'] ); ?>" width="<?php echo esc_attr( (string) $args['image_width'] ); ?>" height="<?php echo esc_attr( (string) $args['image_height'] ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>" loading="lazy" decoding="async">
			</picture>
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
		<a class="site-life__social nc-about__instagram" href="<?php echo esc_url( $instagram_url ); ?>">Follow on Instagram <img src="<?php echo esc_url( $images . 'about-instagram.svg' ); ?>" width="800" height="800" alt=""></a>
		<?php neurocoaching_gallery( $setting, $fallback, $alt, 'nc-about__life-photo', '', $slides_override ); ?>
	</section>
	<?php
}

function neurocoaching_header( $active ) {
	$about_images = get_template_directory_uri() . '/assets/images/';
	$faq_url      = 'contact' === $active ? home_url( '/#faqs' ) : '#faqs';
	$linkedin_url = neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/in/belka80/' );
	$instagram_url = neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/belka80' );
	$telegram_url = neurocoaching_mod( 'telegram_url', 'https://t.me/BEL_KA80' );
	?>
	<header class="site-header" data-site-header>
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Digital Belka home"><img src="<?php echo esc_url( $about_images . 'logo-belka.svg' ); ?>" width="110" height="58" alt="Digital Belka"></a>
		<div class="about-socials" aria-label="Social links">
			<a href="<?php echo esc_url( $linkedin_url ); ?>" aria-label="LinkedIn"><img src="<?php echo esc_url( $about_images . 'about-linkedin-v2.svg' ); ?>" width="28" height="28" alt=""></a>
			<a href="<?php echo esc_url( neurocoaching_email_url() ); ?>" aria-label="Email"><img src="<?php echo esc_url( $about_images . 'icon-mail.svg' ); ?>" width="28" height="28" alt=""></a>
			<a href="<?php echo esc_url( $instagram_url ); ?>" aria-label="Instagram"><img src="<?php echo esc_url( $about_images . 'about-instagram.svg' ); ?>" width="28" height="28" alt=""></a>
			<a href="<?php echo esc_url( $telegram_url ); ?>" aria-label="Telegram"><img src="<?php echo esc_url( $about_images . 'about-telegram-v2.svg' ); ?>" width="28" height="28" alt=""></a>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-menu-toggle><span class="screen-reader-text">Open menu</span><i></i><i></i><i></i></button>
		<nav id="primary-navigation" class="primary-nav nc-nav" aria-label="Primary navigation">
			<a<?php echo 'about' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( home_url( '/' ) ); ?>">About</a>
			<a<?php echo 'career' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( neurocoaching_page_url( 'career-services' ) ); ?>">Career services</a>
			<a<?php echo 'neuro' === $active ? ' aria-current="page"' : ''; ?> href="<?php echo esc_url( neurocoaching_page_url( 'neurocoaching' ) ); ?>">Neurocoaching</a>
			<a href="<?php echo esc_url( $faq_url ); ?>">FAQs</a>
		</nav>
		<a class="site-button button button--small" href="<?php echo esc_url( $linkedin_url ); ?>">Connect on LinkedIn</a>
	</header>
	<?php
}
