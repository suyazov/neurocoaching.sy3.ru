<?php
/** Career services page. @package Neurocoaching */
get_header();
?>
<section class="nc-hero nc-hero--career" aria-labelledby="career-title">
	<div class="nc-container nc-hero__grid">
		<div><p class="nc-eyebrow">Career coaching</p><h1 class="nc-title" id="career-title">Stop postponing your life</h1><p class="nc-copy nc-hero__meta"><?php echo esc_html( neurocoaching_mod( 'career_intro', 'A practical, human approach to work that helps you move from stuck and uncertain to clear and in motion.' ) ); ?></p></div>
		<div class="nc-hero__placeholder" role="img" aria-label="Career services client photo placeholder — awaiting source asset"><span class="nc-placeholder-label">Photo placeholder — awaiting client asset</span></div>
	</div>
</section>

<section class="nc-section" aria-labelledby="career-education-title">
	<div class="nc-container nc-split">
		<div><p class="nc-eyebrow">Background</p><h2 class="nc-heading" id="career-education-title">Education &amp; Experience</h2><p class="nc-copy">Career work informed by coaching practice, real-world transitions and a systems view of how people make decisions.</p></div>
		<ul class="nc-facts"><li><strong>01</strong><span>Coaching and neurointegration training</span></li><li><strong>02</strong><span>Experience across career change and professional positioning</span></li><li><strong>03</strong><span>Practical tools translated into everyday action</span></li></ul>
	</div>
</section>

<section class="nc-section nc-section--forest" aria-labelledby="career-help-title">
	<div class="nc-container nc-split"><p class="nc-eyebrow">How I help</p><div><h2 class="nc-heading" id="career-help-title">Not another perfect plan. A direction you can actually move in.</h2><p class="nc-copy">We connect your experience, strengths and needs to practical choices — without separating your career from the life it has to support.</p></div></div>
</section>

<section class="nc-section nc-section--cream" aria-labelledby="career-services-title">
	<div class="nc-container"><p class="nc-eyebrow">Ways to work together</p><h2 class="nc-heading" id="career-services-title">Services | Career</h2><div class="nc-cards">
		<article class="nc-card"><span class="nc-card__number">01</span><h3>Career clarity</h3><p>Make sense of competing options and identify a credible next direction.</p></article>
		<article class="nc-card"><span class="nc-card__number">02</span><h3>Positioning</h3><p>Translate your experience into a clear, confident professional story.</p></article>
		<article class="nc-card"><span class="nc-card__number">03</span><h3>Change support</h3><p>Turn intention into a workable sequence of experiments and decisions.</p></article>
	</div></div>
</section>

<section class="nc-section" aria-labelledby="career-fit-title"><div class="nc-container nc-split"><div><p class="nc-eyebrow">Is this for you?</p><h2 class="nc-heading" id="career-fit-title">You do not need to have the answer yet.</h2></div><ul class="nc-facts"><li><strong>✓</strong><span>You are successful on paper but disconnected from your work.</span></li><li><strong>✓</strong><span>You are considering a change and keep circling the same options.</span></li><li><strong>✓</strong><span>You want thoughtful support that still leads to action.</span></li></ul></div></section>

<section class="nc-section nc-section--sage" aria-labelledby="career-reviews-title"><div class="nc-container"><p class="nc-eyebrow">Reviews</p><h2 class="screen-reader-text" id="career-reviews-title">Career coaching reviews</h2><blockquote class="nc-quote">“The conversation gave me a clearer way to see my experience and the confidence to take the next step.”<footer>Anonymous client · staging testimonial placeholder</footer></blockquote></div></section>

<section class="nc-section" aria-labelledby="career-life-title"><div class="nc-container"><p class="nc-eyebrow">Beyond the session</p><h2 class="nc-heading" id="career-life-title">In real life</h2><div class="nc-gallery"><?php neurocoaching_placeholder( 'Real-life photo placeholder 1 — awaiting source asset' ); neurocoaching_placeholder( 'Real-life photo placeholder 2 — awaiting source asset' ); neurocoaching_placeholder( 'Real-life photo placeholder 3 — awaiting source asset' ); ?></div></div></section>

<section class="nc-section nc-section--forest nc-cta" aria-labelledby="career-cta-title"><div class="nc-container"><p class="nc-eyebrow">Start here</p><h2 class="nc-heading" id="career-cta-title">Make space for the next chapter.</h2><p class="nc-copy">Bring the career question you cannot think your way out of alone.</p><p><a class="nc-button" href="<?php echo esc_url( neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' ) ); ?>">Connect on LinkedIn</a></p></div></section>
<?php neurocoaching_faqs( 'career' ); ?>
<?php get_footer(); ?>
