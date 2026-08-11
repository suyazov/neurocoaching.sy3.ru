<?php
/** About page reconstructed from the original 1320 px and 320 px PSD artboards. @package Neurocoaching */
get_header();
neurocoaching_header( 'about' );
$booking = neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' );
$instagram = neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/' );
$images  = get_template_directory_uri() . '/assets/images/';
$credentials = array(
	'15+ years in the UN & international organisations — HR, project management, organisational development',
	'Managed multi-million dollar international projects across UN missions',
	'IСF Certified Neurointegration Сoach, Neurointegration Institute, USA',
	'MBA, Webster University, USA',
	'Worked with diplomats, senior UN officials, and international teams across the world',
	'Human Resources Management Certificate, Cornell University, USA',
	'Works with clients in English, Russian & Italian',
	'200+ hours of individual coaching practice',
);
$questions = array(
	'Who are you and what do you do?' => 'I am a career strategist and neurointegration coach with more than 15 years of experience in the UN and international organisations. I help people turn uncertainty into a clear, practical direction.',
	'What is neurointegration and how is it different from regular coaching?' => 'Neurointegration combines coaching with practical, brain-friendly tools for attention, emotions, habits and sustainable change.',
	'Who is this for?' => 'It is for people who feel stuck, overloaded, at a crossroads, or ready to make a thoughtful professional or personal change.',
	'Do I need to know what I want before working with you?' => 'No. Creating a clear direction can be the first part of our work together.',
	'How is your approach different from typical career coaching?' => 'We work with the whole person: your goals, context, energy, patterns and the next realistic experiment.',
	'How is working with you different from just reading self-help books or watching videos?' => 'Our work is personal, structured and accountable. We translate insight into decisions and actions that fit your actual life.',
	'What results can I expect?' => 'You can expect greater clarity, a defined direction, practical decisions and a concrete next step.',
	'How long does it take to see results?' => 'Many clients gain useful clarity in the first session; deeper change depends on your goals and chosen format.',
	'Is this more about career or personal development?' => 'It can be either or both. Career decisions and personal wellbeing often affect each other, so we work with the combination that matters to you.',
	'Do I need to choose between career coaching and neurointegration — or can I do both?' => 'You do not need to choose in advance. We can combine both approaches around your goals.',
	'Why should I choose to work with you?' => 'I combine insider knowledge of international organisations with lived experience of career change, relocation and rebuilding from scratch.',
);
?>
<article class="nc-about">
	<section class="nc-about__hero" aria-labelledby="nc-about-name">
		<div class="nc-about__hero-photo"><img src="<?php echo esc_url( $images . 'about-hero-source.webp' ); ?>" alt="Ksenia Belousova"></div>
		<div class="nc-about__hero-copy">
			<p class="nc-about__eyebrow">UN PROFESSIONAL <span>|</span><br class="nc-about__mobile-break"> CAREER STRATEGIST <span>|</span><br class="nc-about__mobile-break"> NEURO COACH</p>
			<h1 id="nc-about-name">Ksenia<span class="nc-about__mobile-break"><br></span> Belousova</h1>
			<p class="nc-about__lead">15+ years in the UN &amp; international organisations</p>
			<div class="nc-about__intro">
				<p>That combination — insider knowledge of international organisations and the lived experience of navigating change — is exactly what I bring to every client.</p>
				<p><strong>Why me?</strong> Because I've been where you are. And I get it — not from a textbook, but from lived experience inside international organisations.</p>
				<p>I built my career across the United Nations and international organisations, working with diplomats and senior officials across the globe, leading HR across multiple missions and countries. Over 15 years, I hired people, shaped organisations, advised managers, and saw firsthand what it takes to succeed in complex international environments, including within the UN system and what quietly holds talented people back.</p>
				<p>I've also changed career paths myself more than once, relocated across four countries — Russia, the US, Japan, and Austria — and learned how to rebuild from scratch while holding together a career, a husband, two kids, and myself when everything kept changing.</p>
			</div>
			<a class="nc-about__button" href="<?php echo esc_url( $booking ); ?>">Book a free call</a>
		</div>
	</section>

	<section class="nc-about__education" aria-labelledby="nc-about-education-title">
		<div class="nc-about__frame">
			<h2 id="nc-about-education-title">Education &amp; Experience</h2>
			<div class="nc-about__certificates" aria-label="Certificates">
				<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
					<figure><img src="<?php echo esc_url( $images . 'about-certificate-' . $i . '-source.png' ); ?>" alt="Certificate <?php echo esc_attr( (string) $i ); ?>"></figure>
				<?php endfor; ?>
			</div>
			<a class="nc-about__more" href="#nc-about-credentials">View more <span aria-hidden="true">→</span></a>
		</div>
	</section>

	<section id="nc-about-credentials" class="nc-about__credentials nc-about__frame" aria-label="Credentials">
		<ul><?php foreach ( $credentials as $item ) : ?><li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" alt=""><?php echo esc_html( $item ); ?></li><?php endforeach; ?></ul>
	</section>

	<section class="nc-about__services" aria-labelledby="nc-about-services-title">
		<h2 id="nc-about-services-title">Services | B2B format</h2>
		<article class="nc-about__service-card">
			<div class="nc-about__service-summary">
				<div class="nc-about__service-heading"><h3>Team<br>Workshops</h3><span><img src="<?php echo esc_url( $images . 'about-corporate-flag.svg' ); ?>" alt=""><b>Corporate</b></span></div>
				<img class="nc-about__zigzag" src="<?php echo esc_url( $images . 'about-zigzag.svg' ); ?>" alt="">
				<p class="nc-about__scope">On request &nbsp;×&nbsp; Custom scope</p>
				<p>Practical, tailored workshops for teams covering stress management, burnout prevention, time management, and overall wellbeing. Delivered online or in-person, fully customised context around your team's specific needs.</p>
			</div>
			<div class="nc-about__programmes">
				<h3>Programmes:</h3>
				<ul>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" alt=""><strong>From Surviving to Thriving —</strong><br>Stress &amp; Energy Management</li>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" alt=""><strong>Burnout-Proof —</strong><br>Recognise It Before It Hits</li>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" alt=""><strong>Work Smarter —</strong><br>Time, Focus &amp; Productivity</li>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" alt=""><strong>Building Resilience —</strong> Wellbeing That Actually Lasts</li>
				</ul>
				<p><em>A team that feels better, works better</em></p>
				<a class="nc-about__button" href="<?php echo esc_url( $booking ); ?>">Book a call</a>
			</div>
		</article>
	</section>

	<section class="nc-about__life" aria-labelledby="nc-about-life-title">
		<h2 id="nc-about-life-title">In real life</h2>
		<a class="nc-about__instagram" href="<?php echo esc_url( $instagram ); ?>">Follow on Instagram</a>
		<?php neurocoaching_gallery( 'about_gallery_urls', $images . 'about-life-source.webp', 'Ksenia by the sea at sunset', 'nc-about__life-photo' ); ?>
	</section>

	<section class="nc-about__cta">
		<div class="nc-about__frame"><h2>Ready to take the first step?</h2><p>Free 30-min intro call · No commitment</p><a class="nc-about__button" href="<?php echo esc_url( $booking ); ?>">Book a call</a></div>
	</section>

	<section id="faqs" class="nc-about__faq" aria-labelledby="nc-about-faq-title">
		<header><h2 id="nc-about-faq-title">FAQs</h2><p>(Frequently Asked Questions)</p></header>
		<div class="nc-about__questions">
			<?php foreach ( $questions as $question => $answer ) : ?><details><summary><?php echo esc_html( $question ); ?></summary><p><?php echo esc_html( $answer ); ?></p></details><?php endforeach; ?>
			<details open><summary>What's the first step?</summary><p>Start with a conversation. You don't need a perfect plan — just the willingness to change something. Book a Discovery Session: free 30 minutes that will give you clarity on where you are, what's holding you back, and exactly what your next step looks like. From there, we build everything together.</p></details>
		</div>
		<aside><img src="<?php echo esc_url( $images . 'about-faq-source.webp' ); ?>" alt="Ksenia outdoors"><h2>Ready to take the first step?</h2><p>Leave with clarity, a defined direction, and a concrete next step.</p><a class="nc-about__button" href="<?php echo esc_url( $booking ); ?>">Book a call</a></aside>
	</section>
</article>
<?php get_footer();
