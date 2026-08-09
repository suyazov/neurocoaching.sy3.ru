<?php
/** Header. @package Neurocoaching */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#content">Skip to content</a>
<header class="nc-header" data-site-header>
	<div class="nc-container nc-header__bar">
		<a class="nc-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Ksenia Belousova — About">Ksenia<br>Belousova</a>
		<button class="nc-menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-menu-toggle><span aria-hidden="true">☰</span><span class="screen-reader-text">Menu</span></button>
		<nav class="nc-nav" id="primary-navigation" aria-label="Primary navigation">
			<a href="<?php echo esc_url( neurocoaching_page_url( 'about' ) ); ?>">About</a>
			<a href="<?php echo esc_url( neurocoaching_page_url( 'career-services' ) ); ?>">Career services</a>
			<a href="<?php echo esc_url( neurocoaching_page_url( 'neurocoaching' ) ); ?>">Neurocoaching</a>
			<a href="#faqs">FAQs</a>
		</nav>
		<div class="nc-socials" aria-label="Social links">
			<a href="<?php echo esc_url( neurocoaching_mod( 'linkedin_url', 'https://www.linkedin.com/' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.5 8.5H3V21h3.5V8.5ZM4.75 3A2.05 2.05 0 1 0 4.75 7.1 2.05 2.05 0 0 0 4.75 3ZM21 14.1c0-3.75-2-5.5-4.68-5.5a4.05 4.05 0 0 0-3.67 2.02V8.5H9.16V21h3.49v-6.2c0-1.63.3-3.21 2.32-3.21 2 0 2.02 1.87 2.02 3.32V21H21v-6.9Z"/></svg>
			</a>
			<a href="<?php echo esc_url( neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/' ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2c3.1 0 3.49.01 4.71.07 3.16.14 5.07 2.06 5.22 5.22.06 1.22.07 1.61.07 4.71s-.01 3.49-.07 4.71c-.15 3.16-2.06 5.08-5.22 5.22-1.22.06-1.61.07-4.71.07s-3.49-.01-4.71-.07c-3.16-.14-5.08-2.06-5.22-5.22C2.01 15.49 2 15.1 2 12s.01-3.49.07-4.71C2.21 4.13 4.13 2.21 7.29 2.07 8.51 2.01 8.9 2 12 2Zm0 1.8c-3.05 0-3.41.02-4.63.07-2.23.1-3.4 1.26-3.5 3.5C3.82 8.59 3.8 8.95 3.8 12s.02 3.41.07 4.63c.1 2.23 1.27 3.4 3.5 3.5 1.22.05 1.58.07 4.63.07s3.41-.02 4.63-.07c2.23-.1 3.4-1.27 3.5-3.5.05-1.22.07-1.58.07-4.63s-.02-3.41-.07-4.63c-.1-2.24-1.27-3.4-3.5-3.5C15.41 3.82 15.05 3.8 12 3.8Zm0 3.06a5.14 5.14 0 1 1 0 10.28 5.14 5.14 0 0 1 0-10.28Zm0 8.48a3.34 3.34 0 1 0 0-6.68 3.34 3.34 0 0 0 0 6.68Zm5.34-9.88a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4Z"/></svg>
			</a>
		</div>
		<a class="nc-button nc-header__cta" href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>">Connect on LinkedIn</a>
	</div>
</header>
<main id="content">
