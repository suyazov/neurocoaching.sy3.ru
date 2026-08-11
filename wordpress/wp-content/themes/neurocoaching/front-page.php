<?php
/** About page, rebuilt from the 1320 px and 320 px PSD artboards. @package Neurocoaching */
get_header();
neurocoaching_header( 'about' );
$booking = neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' );
$contact = neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' );
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
	'Who are you and what do you do?',
	'What is neurointegration and how is it different from regular coaching?',
	'Who is this for?',
	'Do I need to know what I want before working with you?',
	'How is your approach different from typical career coaching?',
	'How is working with you different from just reading self-help books or watching videos?',
	'What results can I expect?',
	'How long does it take to see results?',
	'Is this more about career or personal development?',
	'Do I need to choose between career coaching and neurointegration — or can I do both?',
	'Why should I choose to work with you?',
);
?>
<article class="page page--about about-psd">
	<section class="about-hero" aria-labelledby="about-name">
		<div class="about-hero__photo"><img src="<?php echo esc_url( $images . 'about-hero.webp' ); ?>" alt="Ksenia Belousova"></div>
		<div class="about-hero__copy">
			<p class="about-kicker">UN PROFESSIONAL &nbsp; | &nbsp; CAREER STRATEGIST &nbsp; | &nbsp; NEURO COACH</p>
			<h1 id="about-name">Ksenia Belousova</h1>
			<p class="about-lead">15+ years in the UN &amp; international organisations</p>
			<div class="about-intro">
				<p>That combination — insider knowledge of international organisations and the lived experience of navigating change — is exactly what I bring to every client.</p>
				<p><strong>Why me?</strong> Because I've been where you are. And I get it — not from a textbook, but from lived experience inside international organisations.</p>
				<p>I built my career across the United Nations and international organisations, working with diplomats and senior officials across the globe, leading HR across multiple missions and countries. Over 15 years, I hired people, shaped organisations, advised managers, and saw firsthand what it takes to succeed in complex international environments, including within the UN system and what quietly holds talented people back.</p>
				<p>I've also changed career paths myself more than once, relocated across four countries — Russia, the US, Japan, and Austria — and learned how to rebuild from scratch while holding together a career, a husband, two kids, and myself when everything kept changing.</p>
			</div>
			<a class="button about-button" href="<?php echo esc_url( $booking ); ?>">Book a free call</a>
		</div>
	</section>

	<section class="about-education" aria-labelledby="about-education-title">
		<div class="about-frame">
			<h2 id="about-education-title">Education &amp; Experience</h2>
			<div class="about-certificates" aria-label="Certificates">
				<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
					<figure><img src="<?php echo esc_url( $images . 'about-certificate-' . $i . '.webp' ); ?>" alt="Certificate <?php echo esc_attr( (string) $i ); ?>"></figure>
				<?php endfor; ?>
			</div>
			<a class="about-more" href="#credentials">View more <span aria-hidden="true">→</span></a>
		</div>
	</section>

	<section id="credentials" class="about-credentials about-frame" aria-label="Credentials">
		<ul><?php foreach ( $credentials as $item ) : ?><li><?php echo esc_html( $item ); ?></li><?php endforeach; ?></ul>
	</section>

	<section class="about-services about-frame" aria-labelledby="about-services-title">
		<h2 id="about-services-title">Services | B2B format</h2>
		<div class="about-service-card">
			<div class="about-service-summary">
				<div class="about-service-heading"><h3>Team<br>Workshops</h3><span>Corporate</span></div>
				<p class="about-scope">On request &nbsp;×&nbsp; Custom scope</p>
				<p>Practical, tailored workshops for teams covering stress management, burnout prevention, time management, and overall wellbeing. Delivered online or in-person, fully customised context around your team's specific needs.</p>
			</div>
			<div class="about-programmes">
				<h3>Programmes:</h3>
				<ul>
					<li><strong>From Surviving to Thriving —</strong><br>Stress &amp; Energy Management</li>
					<li><strong>Burnout-Proof —</strong><br>Recognise It Before It Hits</li>
					<li><strong>Work Smarter —</strong><br>Time, Focus &amp; Productivity</li>
					<li><strong>Building Resilience —</strong> Wellbeing That Actually Lasts</li>
				</ul>
				<p><em>A team that feels better, works better</em></p>
				<a class="button about-button" href="<?php echo esc_url( $booking ); ?>">Book a call</a>
			</div>
		</div>
	</section>

	<section class="about-life about-frame" aria-labelledby="about-life-title">
		<h2 id="about-life-title">In real life</h2>
		<a class="about-instagram" href="<?php echo esc_url( $contact ); ?>">Follow on Instagram</a>
		<div class="about-life__photo"><a href="<?php echo esc_url( $contact ); ?>" aria-label="Previous photo">←</a><img src="<?php echo esc_url( $images . 'about-life.webp' ); ?>" alt="Ksenia by the sea at sunset"><a href="<?php echo esc_url( $contact ); ?>" aria-label="Next photo">→</a></div>
		<p class="about-dots" aria-hidden="true">● ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○ ○</p>
	</section>

	<section class="about-cta">
		<div class="about-frame"><h2>Ready to take the first step?</h2><p>Free 30-min intro call · No commitment</p><a class="button about-button" href="<?php echo esc_url( $booking ); ?>">Book a call</a></div>
	</section>

	<section id="faqs" class="about-faq about-frame" aria-labelledby="about-faq-title">
		<header><h2 id="about-faq-title">FAQs</h2><p>(Frequently Asked Questions)</p></header>
		<div class="about-faq__questions">
			<?php foreach ( $questions as $question ) : ?><details><summary><?php echo esc_html( $question ); ?></summary></details><?php endforeach; ?>
			<details open><summary>What's the first step?</summary><p>Start with a conversation. You don't need a perfect plan — just the willingness to change something. Book a Discovery Session: free 30 minutes that will give you clarity on where you are, what's holding you back, and exactly what your next step looks like. From there, we build everything together.</p></details>
		</div>
		<aside><img src="<?php echo esc_url( $images . 'about-faq.webp' ); ?>" alt="Ksenia outdoors"><h2>Ready to take the first step?</h2><p>Leave with clarity, a defined direction, and a concrete next step.</p><a class="button about-button" href="<?php echo esc_url( $booking ); ?>">Book a call</a></aside>
	</section>
</article>
<?php get_footer();
