<?php
/** About page reconstructed from the original 1320 px and 320 px PSD artboards. @package Neurocoaching */
get_header();
neurocoaching_header( 'about' );
$booking = neurocoaching_contact_url();
$instagram = neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/' );
$images  = get_template_directory_uri() . '/assets/images/';
$credentials = array(
	'15+ years in the UN & international organisations — HR, project management, organisational development',
	'Worked with diplomats, senior UN officials, and international teams across the world',
	'Managed multi-million dollar international projects across UN missions',
	'Human Resources Management Certificate, Cornell University, USA',
	'ICF Certified Neurointegration Coach, Neurointegration Institute, USA',
	'Works with clients in English, Russian & Italian',
	'MBA, Webster University, USA',
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
	"What's the first step?" => "Start with a conversation. You don't need a perfect plan — just the willingness to change something. Book a Discovery Session: free 30 minutes that will give you clarity on where you are, what's holding you back, and exactly what your next step looks like. From there, we build everything together.",
);
?>
<article class="site-page site-page--about nc-about">
	<section class="site-section site-hero nc-about__hero" aria-labelledby="nc-about-name">
		<div class="site-hero__media nc-about__hero-photo"><img src="<?php echo esc_url( $images . 'about-hero-768.webp' ); ?>" srcset="<?php echo esc_url( $images . 'about-hero-512.webp' ); ?> 512w, <?php echo esc_url( $images . 'about-hero-768.webp' ); ?> 768w, <?php echo esc_url( $images . 'about-hero-1200.webp' ); ?> 1200w, <?php echo esc_url( $images . 'about-hero-hires.webp' ); ?> 1537w" sizes="(max-width: 850px) min(100vw, 402px), 711px" width="768" height="1152" alt="Ksenia Belousova" decoding="async" fetchpriority="high"></div>
		<div class="site-hero__content nc-about__hero-copy">
			<p class="nc-about__eyebrow">UN PROFESSIONAL <span>|</span><br class="nc-about__mobile-break"> CAREER STRATEGIST <span>|</span><br class="nc-about__mobile-break"> NEURO COACH</p>
			<h1 id="nc-about-name">Ksenia Belousova</h1>
			<p class="nc-about__lead">15+ years in the UN &amp; international organisations</p>
			<div class="nc-about__intro">
				<p>That combination — insider knowledge of international organisations and the lived experience of navigating change — is exactly what I bring to every client.</p>
				<p><strong>Why me?</strong> Because I've been where you are. And I get it — not from a textbook, but from lived experience inside international organisations.</p>
				<p>I built my career across the <strong class="nc-about__intro-heavy">United Nations and international organisations</strong>, working with diplomats and senior officials across the globe, leading HR across multiple missions and countries. Over 15 years, I hired people, shaped organisations, advised managers, and saw firsthand what it takes to succeed in complex international environments, including within the UN system and what quietly holds talented people back.</p>
				<p>I've also changed career paths myself more than once, relocated across four countries — Russia, the US, Japan, and Austria — and learned how to rebuild from scratch while holding together a career, a husband, two kids, and myself when everything kept changing.</p>
			</div>
			<a class="site-button nc-about__button" href="<?php echo esc_url( $booking ); ?>">Book a free call</a>
		</div>
	</section>

	<?php
	neurocoaching_education_section(
		array(
			'id'                 => 'nc-about-education-title',
			'target_id'          => 'nc-about-credentials',
			'section_class'      => 'nc-about__education',
			'inner_class'        => 'nc-about__frame',
			'certificates_class' => 'nc-about__certificates',
			'certificates'       => neurocoaching_about_career_certificates(),
		)
	);
	neurocoaching_credentials_section(
		array(
			'id'            => 'nc-about-credentials',
			'section_class' => 'nc-about__credentials nc-about__frame',
			'label'         => 'Credentials',
			'items'         => $credentials,
		)
	);
	?>

	<section class="site-section site-shell site-services nc-about__services" aria-labelledby="nc-about-services-title">
		<h2 class="site-section-title" id="nc-about-services-title">Services | B2B format</h2>
		<article class="site-service-card nc-about__service-card">
			<div class="nc-about__service-summary">
				<div class="nc-about__service-heading"><h3>Team<br>Workshops</h3><span><img src="<?php echo esc_url( $images . 'flag-corporate-v2.svg' ); ?>" width="158" height="34" alt=""><b>Corporate</b></span></div>
				<img class="nc-about__zigzag" src="<?php echo esc_url( $images . 'about-zigzag-v2.svg' ); ?>" width="110" height="71" alt="">
				<p class="nc-about__scope">On request &nbsp;×&nbsp; Custom scope</p>
				<p>Practical, tailored workshops for teams covering stress management, burnout prevention, time management, and overall wellbeing. Delivered online or in-person, fully customised context around your team's specific needs.</p>
			</div>
			<div class="nc-about__programmes">
				<h3>Programmes:</h3>
				<ul>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" width="112" height="98" alt=""><strong>From Surviving to Thriving —</strong><br>Stress &amp; Energy Management</li>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" width="112" height="98" alt=""><strong>Burnout-Proof —</strong><br>Recognise It Before It Hits</li>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" width="112" height="98" alt=""><strong>Work Smarter —</strong><br>Time, Focus &amp; Productivity</li>
					<li><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" width="112" height="98" alt=""><strong>Building Resilience —</strong><br>Wellbeing That Actually Lasts</li>
				</ul>
				<p class="nc-about__programmes-outcome"><img src="<?php echo esc_url( $images . 'about-check.svg' ); ?>" width="112" height="98" alt=""><em>A team that feels better, works better</em></p>
				<a class="site-button nc-about__button" href="<?php echo esc_url( $booking ); ?>">Book a call</a>
			</div>
		</article>
	</section>

	<?php
	$about_life_defaults = neurocoaching_about_gallery_urls();
	$about_life_slides   = neurocoaching_gallery_urls( 'about_gallery_urls', implode( "\n", $about_life_defaults ) );
	$about_life_image    = $about_life_slides[0];
	neurocoaching_real_life_section( 'nc-about-life-title', $instagram, 'about_gallery_urls', $about_life_image, 'Ksenia Belousova with friends', $about_life_slides );
	?>

	<?php
	neurocoaching_cta_section(
		array(
			'button_label'  => 'Book a call',
			'button_url'    => $booking,
			'section_class' => 'nc-about__cta',
			'inner_class'   => 'nc-about__frame',
		)
	);
	neurocoaching_faq_section(
		array(
			'id'              => 'nc-about-faq-title',
			'section_class'   => 'nc-about__faq',
			'questions_class' => 'nc-about__questions',
			'questions'       => $questions,
			'open_question'   => "What's the first step?",
			'image'           => $images . 'about-faq-client-jump.webp',
			'image_width'     => 700,
			'image_height'    => 910,
			'image_alt'       => 'Ksenia outdoors',
			'button_label'    => 'Book a call',
			'button_url'      => $booking,
		)
	);
	?>
</article>
<?php get_footer();
