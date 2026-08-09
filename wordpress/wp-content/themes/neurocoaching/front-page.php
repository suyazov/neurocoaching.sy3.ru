<?php
/** About landing page. @package Neurocoaching */
get_header();
?>
<section class="nc-hero" aria-labelledby="about-title">
	<div class="nc-container nc-hero__grid">
		<div>
			<p class="nc-eyebrow">Career services · Neurocoaching</p>
			<h1 class="nc-title" id="about-title">Ksenia Belousova</h1>
			<p class="nc-copy nc-hero__meta"><?php echo esc_html( neurocoaching_mod( 'about_intro', 'Career & neurointegration coach. Helping thoughtful people create work and lives that fit who they are.' ) ); ?></p>
		</div>
		<div class="nc-hero__placeholder" role="img" aria-label="Ksenia Belousova portrait placeholder — awaiting client photo">
			<span class="nc-placeholder-label">Portrait placeholder — awaiting client photo</span>
		</div>
	</div>
</section>

<section class="nc-section nc-section--forest" aria-labelledby="about-work-title">
	<div class="nc-container nc-split">
		<div>
			<p class="nc-eyebrow">What I do</p>
			<h2 class="nc-heading" id="about-work-title">Work can feel more like you.</h2>
		</div>
		<div class="nc-copy">
			<p>I combine career strategy with brain-aware coaching to help people understand what is keeping them stuck and take grounded next steps.</p>
			<p>This staging copy is provisional and remains clearly editable until the approved source text arrives.</p>
		</div>
	</div>
</section>

<section class="nc-section" aria-labelledby="about-paths-title">
	<div class="nc-container">
		<p class="nc-eyebrow">Ways to work together</p>
		<h2 class="nc-heading" id="about-paths-title">Choose the starting point that fits.</h2>
		<div class="nc-cards">
			<article class="nc-card"><span class="nc-card__number">01</span><h3>Career services</h3><p>For clarity, direction, positioning and practical movement in your working life.</p><p><a class="nc-button" href="<?php echo esc_url( neurocoaching_page_url( 'career-services' ) ); ?>">Explore career services</a></p></article>
			<article class="nc-card"><span class="nc-card__number">02</span><h3>Neurocoaching</h3><p>For sustainable change when thinking harder has stopped being the answer.</p><p><a class="nc-button" href="<?php echo esc_url( neurocoaching_page_url( 'neurocoaching' ) ); ?>">Explore neurocoaching</a></p></article>
			<article class="nc-card"><span class="nc-card__number">03</span><h3>A first conversation</h3><p>A calm place to name what is happening and see whether working together makes sense.</p><p><a class="nc-button" href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>">Connect on LinkedIn</a></p></article>
		</div>
	</div>
</section>

<section class="nc-section nc-section--sage" aria-labelledby="about-person-title">
	<div class="nc-container nc-split">
		<?php neurocoaching_placeholder(); ?>
		<div><p class="nc-eyebrow">Behind the practice</p><h2 class="nc-heading" id="about-person-title">Warm, direct and curious.</h2><p class="nc-copy">I believe useful coaching makes room for the whole person: your ambitions, nervous system, values, context and real life.</p></div>
	</div>
</section>

<?php neurocoaching_faqs( 'about' ); ?>
<?php get_footer(); ?>
