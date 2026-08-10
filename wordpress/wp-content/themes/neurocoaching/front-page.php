<?php /** About page. @package Neurocoaching */
get_header(); neurocoaching_header( 'about' );
$booking = neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' );
?>
<article class="page page--about">
	<section class="hero"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-hero.webp' ); ?>" alt="Ksenia Belousova"><div class="hero__content"><p class="eyebrow">UN professional&nbsp; | &nbsp;Career strategist&nbsp; | &nbsp;Neuro coach</p><h1><?php echo esc_html( neurocoaching_mod( 'about_name', 'Ksenia Belousova' ) ); ?></h1><p class="lead">15+ years in the UN &amp; international organisations</p><p>That combination — insider knowledge of international organisations and eleven years of navigating change — is exactly what I bring to every client.</p><p>Why me? Because I’ve been where you are. And I get it — not from a textbook, but from lived experience inside international organisations.</p><p>I built my career across the United Nations and international organisations, working with diplomats and senior officials across the globe. I combine that experience with practical coaching tools and a deep respect for the person behind the job title.</p><a class="button" href="<?php echo esc_url( $booking ); ?>">Book a free call</a></div></section>
	<?php neurocoaching_education(); ?>
	<?php neurocoaching_services( 'Services | B2B format', array( array( 'title' => 'Team Workshops', 'tag' => 'Corporate', 'text' => 'Practical, tailored workshops for team covering stress management, burnout prevention, time management and overall wellbeing.', 'items' => array( 'From Surviving to Thriving', 'Burnout-Proof', 'Work Smarter', 'Building Resilience' ) ) ) ); ?>
	<?php neurocoaching_life( 'about-life.webp', 'Ksenia by the sea at sunset' ); ?>
	<section class="main-cta"><div class="section-inner"><h2>Ready to take the first step?</h2><p>Free 30-min intro call — No commitment</p><a class="button button--light" href="<?php echo esc_url( $booking ); ?>">Book a call</a></div></section>
	<?php neurocoaching_faqs(); ?>
</article>
<?php get_footer();
