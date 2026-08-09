<?php
/**
 * Neurocoaching theme setup and editable staging content.
 *
 * @package Neurocoaching
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neurocoaching_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'neurocoaching_setup' );

function neurocoaching_assets() {
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'neurocoaching', get_stylesheet_uri(), array(), $version );
	wp_enqueue_script( 'neurocoaching-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'neurocoaching_assets' );

function neurocoaching_mod( $key, $fallback ) {
	$value = get_theme_mod( $key, $fallback );
	return is_string( $value ) ? $value : $fallback;
}

function neurocoaching_customize_register( $customizer ) {
	$customizer->add_section(
		'neurocoaching_content',
		array(
			'title'       => __( 'Neurocoaching content', 'neurocoaching' ),
			'description' => __( 'Edit the key staging headings, descriptions and contact links.', 'neurocoaching' ),
			'priority'    => 30,
		)
	);

	$fields = array(
		'about_intro'      => array( 'About introduction', 'Career & neurointegration coach. Helping thoughtful people create work and lives that fit who they are.' ),
		'career_intro'     => array( 'Career introduction', 'A practical, human approach to work that helps you move from stuck and uncertain to clear and in motion.' ),
		'neuro_intro'      => array( 'Neurocoaching introduction', 'A brain-aware coaching space for finding steadier ways to work, decide and live.' ),
		'linkedin_url'     => array( 'LinkedIn URL', 'https://www.linkedin.com/' ),
		'instagram_url'    => array( 'Instagram URL', 'https://www.instagram.com/' ),
		'contact_url'      => array( 'Contact URL', 'https://www.linkedin.com/' ),
	);

	foreach ( $fields as $key => $field ) {
		$customizer->add_setting(
			$key,
			array(
				'default'           => $field[1],
				'sanitize_callback' => '_url' === substr( $key, -4 ) ? 'esc_url_raw' : 'sanitize_textarea_field',
			)
		);
		$customizer->add_control(
			$key,
			array(
				'label'   => $field[0],
				'section' => 'neurocoaching_content',
				'type'    => '_url' === substr( $key, -4 ) ? 'url' : 'textarea',
			)
		);
	}
}
add_action( 'customize_register', 'neurocoaching_customize_register' );

/**
 * Serve the two agreed staging routes without requiring database page creation.
 */
function neurocoaching_route_templates( $template ) {
	$path   = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/', PHP_URL_PATH );
	$routes = array(
		'/career-services/' => 'page-career-services.php',
		'/neurocoaching/'    => 'page-neurocoaching.php',
	);
	$path   = trailingslashit( '/' . ltrim( (string) $path, '/' ) );

	if ( isset( $routes[ $path ] ) ) {
		global $wp_query;
		if ( $wp_query ) {
			$wp_query->is_404 = false;
		}
		status_header( 200 );
		return get_theme_file_path( $routes[ $path ] );
	}

	return $template;
}
add_filter( 'template_include', 'neurocoaching_route_templates', 99 );

function neurocoaching_page_url( $slug ) {
	if ( 'about' === $slug ) {
		return home_url( '/' );
	}
	return home_url( '/' . trim( $slug, '/' ) . '/' );
}

function neurocoaching_faqs( $context = 'coaching' ) {
	$items = array(
		array( 'What can I expect from our first conversation?', 'We will clarify what is happening now, what you want to change, and whether this way of working feels right for you.' ),
		array( 'Do I need to prepare?', 'No formal preparation is needed. Bring the question, tension, or decision that feels most present.' ),
		array( 'Is this therapy?', 'No. This is coaching focused on awareness, choices and action. It does not replace medical or mental-health care.' ),
		array( 'Can we work online?', 'Yes. Sessions can take place online; practical details are confirmed directly before booking.' ),
	);
	?>
	<section class="nc-section nc-section--cream" id="faqs" aria-labelledby="<?php echo esc_attr( $context ); ?>-faqs-title">
		<div class="nc-container">
			<p class="nc-eyebrow">Questions</p>
			<h2 class="nc-heading" id="<?php echo esc_attr( $context ); ?>-faqs-title">FAQs</h2>
			<div class="nc-faq">
				<?php foreach ( $items as $item ) : ?>
					<details>
						<summary><?php echo esc_html( $item[0] ); ?></summary>
						<p><?php echo esc_html( $item[1] ); ?></p>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

function neurocoaching_placeholder( $label = 'Client photo placeholder — awaiting source asset' ) {
	printf( '<div class="nc-photo-placeholder" role="img" aria-label="%1$s"><span class="nc-placeholder-label">%1$s</span></div>', esc_attr( $label ) );
}
