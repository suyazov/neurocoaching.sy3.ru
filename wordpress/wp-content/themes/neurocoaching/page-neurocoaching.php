<?php
/** Neurocoaching page rebuilt from the supplied 1440 px and 320 px PSD artboards. @package Neurocoaching */
get_header();
neurocoaching_header( 'neuro' );
$images  = get_template_directory_uri() . '/assets/images/';
$desktop_source = $images . 'neurocoaching-source/desktop-1440/';
$mobile_source  = $images . 'neurocoaching-source/mobile-320/';
$booking = neurocoaching_contact_url();
$social    = neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' );
$instagram = neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/' );
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
$faqs = array(
	'Who are you and what do you do?' => 'I am a career and neurointegration coach with international leadership and HR experience. I help people find clarity and turn it into practical action.',
	'What is neurointegration and how is it different from regular coaching?' => 'It combines coaching with practical, brain-friendly tools for attention, emotions, habits and sustainable change.',
	'Who is this for?' => 'For people who feel stuck, overloaded, at a crossroads, or ready to make a thoughtful professional or personal change.',
	'Do I need to know what I want before working with you?' => 'No. Creating a clear direction can be the first part of our work together.',
	'How is your approach different from typical career coaching?' => 'We work with the whole person: goals, context, energy, patterns and the next realistic experiment.',
	'What results can I expect?' => 'Greater clarity, a defined direction, practical decisions and a concrete next step.',
	'How long does it take to see results?' => 'Many clients gain useful clarity in the first session; deeper change depends on your goals and chosen format.',
	'Is this more about career or personal development?' => 'It can be either or both. The work follows the change that matters most in your life right now.',
	'How is working with you different from just reading self-help books or watching videos?' => 'We turn insight into a personalised process, supported practice and decisions you can use in real life.',
	'Do I need to choose between career coaching and neurointegration — or can I do both?' => 'You can combine them. Career strategy gives direction while neurointegration helps you move with sustainable energy.',
	'Why should I choose to work with you?' => 'I combine lived international experience, structured coaching and a practical understanding of how change actually feels.',
	"What's the first step?" => "Start with a conversation. You don't need a perfect plan — just the willingness to change something.",
);
?>
<article class="site-page site-page--neuro neuro-psd">
	<section class="site-section site-hero neuro-hero">
		<div class="site-hero__media neuro-hero__photo"><img src="<?php echo esc_url( $images . 'neuro-hero-hires.webp' ); ?>" width="511" height="911" alt="Ksenia Belousova holding hydrangeas" decoding="async" fetchpriority="high"></div>
		<div class="site-hero__content neuro-hero__copy">
			<p class="neuro-kicker">Neurointegration coaching</p>
			<h1>Burned out, overwhelmed, or know something needs to change?</h1>
			<p>I had the United Nations career, four countries, the life that looked like a dream from the outside. Then I hit a wall — and what I discovered on the other side is what I now teach.</p>
			<p class="neuro-lead">If something needs to change but you don't know where to start — I'm here to help.</p>
			<a class="site-button neuro-button" href="<?php echo esc_url( $booking ); ?>">Book a free call</a>
		</div>
	</section>

	<?php
	neurocoaching_education_section(
		array(
			'id'                 => 'neuro-education-title',
			'target_id'          => 'neuro-credentials',
			'section_class'      => 'neuro-education',
			'inner_class'        => 'neuro-wrap',
			'certificates_class' => 'neuro-certificates',
			'certificates'       => neurocoaching_neuro_certificates(),
			'label'              => 'Professional certificates; swipe or use left and right arrow keys to browse',
		)
	);
	neurocoaching_credentials_section(
		array(
			'id'            => 'neuro-credentials',
			'section_class' => 'neuro-credentials neuro-wrap',
			'items'         => $credentials,
		)
	);
	?>

	<section class="neuro-difference neuro-wrap" aria-labelledby="neuro-difference-title">
		<div class="neuro-difference__intro">
			<h2 id="neuro-difference-title">Why this is<br>different</h2><span class="neuro-waves" aria-hidden="true">≋</span>
			<p>Most coaching changes what you think. NeuroIntegration changes how your brain responds to stress and change. That's why the results last.</p>
			<p>This isn't therapy. It's a structured, science-based process personalised to your needs and your pace.</p>
		</div>
		<div class="neuro-difference__process">
			<h2>We work with<br>your brain —<br>not against it</h2>
			<dl>
				<div><dt>Understand your patterns</dt><dd>We identify what's driving your reactions — not through theory, but through what's actually happening in your life right now.</dd></div>
				<div><dt>Stabilise your internal state</dt><dd>Before any plan, we restore your energy and clarity. You can't think straight when your nervous system is overloaded.</dd></div>
				<div><dt>Build from there</dt><dd>With a clear head and real capacity, we create a direction and plan your brain can actually sustain.</dd></div>
			</dl>
			<strong>No pressure. No overnight overhaul. Just real, lasting change.</strong>
		</div>
	</section>

	<section class="site-section site-shell site-services neuro-services neuro-wrap" aria-labelledby="neuro-services-title">
		<h2 class="site-section-title" id="neuro-services-title">Services | Neurointegration</h2>
		<div class="site-service-grid neuro-service-grid">
			<article class="site-service-card neuro-card">
				<p class="neuro-card__label">3 weeks (21 days) · 4 sessions</p><h3>Individual<br>NeuroSprint<br>Coaching</h3><span class="neuro-waves" aria-hidden="true">≋</span>
				<p>A personalised 3-week coaching programme designed to help you build sustainable habits, achieve the goals you set for the sprint, and create lasting change — at a pace your brain can actually absorb.</p>
				<h4>Includes:</h4>
				<ul><li><strong>Strategy Session (90 min)</strong><br>Assess your current state, needs, challenges, and goals. Together, we create your personalised strategy and sprint plan.</li><li><strong>Week 2: Check-in (45 min)</strong><br>Fine-tune your approach and maintain momentum.</li><li><strong>Sprint Integration Session (60–90 min)</strong><br>Reflect on achievements, consolidate new habits, and plan your next steps.</li><li>Personalised learning materials and exercises</li><li>Individual chat support between sessions</li><li>Templates, worksheets, and progress trackers</li><li>Full confidentiality</li></ul>
				<p class="neuro-price">350 €</p><a class="site-button neuro-button" href="<?php echo esc_url( $booking ); ?>">Book NeuroSprint</a>
			</article>
			<article class="site-service-card site-service-card--featured neuro-card neuro-card--featured">
				<span class="neuro-card__flag">Flagship</span><p class="neuro-card__label">Career strategy + NeuroSprint in parallel<br>3 weeks · 8 sessions · personalised support</p><h3>Integrated<br>Transformation</h3><span class="neuro-waves" aria-hidden="true">≋</span>
				<p>For those who are ready to move forward in their career with clarity, confidence, and sustainable energy — and turn their goals into realistic, achievable steps.</p><p>The programme combines strategic career work with NeuroSprint coaching, helping you build the focus, emotional balance, and resilience needed to move forward without falling back into chronic stress or burnout.</p>
				<h4>Includes:</h4>
				<ul><li><strong>Career strategy &amp; action plan</strong><br>Clarify your value, strengths, positioning, and next career direction.</li><li><strong>Individual NeuroSprint coaching</strong><br>A personalised sprint to strengthen focus, balance, and resilience.</li><li><strong>NeuroIntegration practices</strong><br>Practical tools for focus, emotional balance, and stress regulation.</li><li><strong>Worksheets and templates</strong><br>Structured materials to support reflection and action.</li><li><strong>Individual chat support and full confidentiality</strong></li></ul>
				<p class="neuro-card__outcome">Clear direction, stronger positioning, renewed energy, and a realistic plan you can actually follow.</p>
				<p class="neuro-price"><s>800 €</s> <strong>700 €</strong></p><span class="neuro-card__offer">Special Offer</span><a class="site-button neuro-button" href="<?php echo esc_url( $booking ); ?>">Book Combo Package</a>
			</article>
		</div>
	</section>

	<section class="neuro-story">
		<div class="neuro-story__photo"><img src="<?php echo esc_url( $images . 'neuro-story-hires.webp' ); ?>" width="600" height="800" alt="Ksenia Belousova beside flowering trees" loading="lazy" decoding="async"></div>
		<div class="neuro-story__copy">
			<h2>I didn't find this in a book.<br>I found it in the hardest years of my life.</h2>
			<p>I built a successful international career at the United Nations — working alongside diplomats, leading people across different cultures, and changing my career path several times along the way. I relocated to four countries, travelled constantly, and lived a life that, from the outside, looked extraordinary.</p>
			<p>And it was. I also had a husband I love, two children growing up too fast, and aging parents who needed me. Every role I played, I gave it everything. What I didn't realise was how far I had overstretched — until the day I simply couldn't go on anymore. Not because something broke. Because I had nothing left.</p>
			<p>That's when I stopped looking for a better strategy and started understanding how my brain actually works. That search led me to neuroscience — and changed everything.</p>
			<h3>I was doing everything right. And I still felt completely lost.</h3>
			<p>That's the moment I understand better than any theory. It's not about not trying hard enough. It's about running a system that was never designed for this much — and not knowing how to reset it.</p>
		</div>
	</section>

	<section class="neuro-method neuro-wrap" aria-labelledby="neuro-method-title">
		<div class="neuro-method__copy"><h2 id="neuro-method-title">The method based on the NeuroIntegration method by Katerina Lengold</h2><p>The NeuroIntegration method was developed by Katerina Lengold, founder of the California Institute of Neurointegration.</p><p>It combines neuroscience, psychology, and behavioural science into a practical coaching framework that works with how your brain is actually wired. NeuroSprints apply this in focused 21-day cycles — structured enough to create real change, flexible enough to fit a full life.</p><a href="https://neurointegration.org/">Learn more about the science: neurointegration.org</a></div>
		<picture><source media="(max-width: 850px)" srcset="<?php echo esc_url( $mobile_source . 'mobile-320-12195-neuro-pyramid-web-transparent-copy.png' ); ?>"><img src="<?php echo esc_url( $desktop_source . 'desktop-1440-11037-neuro-pyramid-web-transparent-copy.png' ); ?>" width="728" height="398" alt="Three-stage NeuroIntegration method diagram" loading="lazy" decoding="async"></picture>
	</section>

	<section class="neuro-suitable neuro-wrap" aria-labelledby="neuro-suitable-title">
		<h2 id="neuro-suitable-title">Is this you?<br>You might be in the right place if...</h2>
		<div class="neuro-suitable__grid">
			<p><strong>You're exhausted but can't slow down</strong><span>You keep pushing through — but the energy just isn't there anymore.</span></p><p><strong>You're facing a big change</strong><span>New country, new role, new chapter — and you don't know where to start.</span></p><p><strong>You feel stuck but don't know why</strong><span>You've tried changing things — jobs, habits, routines. Nothing fully clicks.</span></p><p><strong>You've been putting yourself last</strong><span>Everyone else comes first. You've lost track of what you actually want.</span></p><p><strong>You're doing everything right — still feel empty</strong><span>On paper it looks good. Inside, something is missing.</span></p><p><strong>You know you're capable of more</strong><span>But something keeps getting in the way — and you're ready to find out what.</span></p>
		</div>
	</section>

	<section class="site-section site-reviews neuro-reviews" aria-labelledby="neuro-reviews-title"><div class="site-shell neuro-wrap"><h2 class="site-section-title" id="neuro-reviews-title">Reviews</h2><div class="site-review-track neuro-review-track" tabindex="0" role="region" aria-label="Neurocoaching reviews; use left and right arrow keys to browse" data-horizontal-track>
		<blockquote><header><strong>Elena P.</strong><a href="<?php echo esc_url( $social ); ?>">View profile on LinkedIn</a></header><p>Working with Ksenia helped me understand the real reasons behind my procrastination. I became more self-aware and grateful. I feel calmer now, and my anxiety has noticeably decreased.<br><br>I am very grateful to Ksenia for her openness, her genuine desire to support, and her ability to help me see and acknowledge my own progress.</p></blockquote>
		<blockquote><header><strong>Olesya K.</strong><a href="<?php echo esc_url( $social ); ?>">View profile on LinkedIn</a></header><p>I am truly grateful to Ksenia for the results I achieved, and for her professionalism, warmth, and thoughtful feedback. I learned to give myself more rest and to assess my energy and resources more realistically, so I can distribute them more harmoniously across different areas of my life.</p></blockquote>
		<blockquote><header><strong>Olga R.</strong><a href="<?php echo esc_url( $social ); ?>">View profile on LinkedIn</a></header><p>The sessions with Ksenia had a very warm, light, and supportive atmosphere. I felt truly seen, heard, and cared for throughout the process.<br><br>Ksenia brings a very positive energy. What I especially appreciated was the combination of lightness and depth in her work, as well as her sincere understanding and strong empathy.</p></blockquote>
	</div></div></section>

	<?php
	$neuro_life_image = $images . 'neuro-life-1-hires.webp';
	$neuro_life_defaults = array(
		$neuro_life_image,
		$images . 'neuro-life-2-hires.webp',
		$images . 'neuro-hero-hires.webp',
		$images . 'neuro-life-4-hires.webp',
	);
	$neuro_life_slides = neurocoaching_gallery_urls( 'neuro_gallery_urls', implode( "\n", $neuro_life_defaults ) );
	$neuro_life_slides = array_slice( array_values( array_unique( array_merge( $neuro_life_slides, $neuro_life_defaults ) ) ), 0, 4 );
	neurocoaching_real_life_section( 'neuro-life-title', $instagram, 'neuro_gallery_urls', $neuro_life_image, 'Neurointegration Institute gathering', $neuro_life_slides );
	?>

	<?php
	neurocoaching_cta_section(
		array(
			'heading'       => 'Ready to stop waiting for "someday"?',
			'button_url'    => $booking,
			'section_class' => 'neuro-cta',
			'inner_class'   => 'neuro-wrap',
		)
	);
	neurocoaching_faq_section(
		array(
			'id'              => 'neuro-faq-title',
			'section_class'   => 'neuro-faq neuro-wrap',
			'questions_class' => 'neuro-faq__questions',
			'questions'       => $faqs,
			'closing'         => "Start with a conversation. You don't need a perfect plan — just the willingness to change something. Book a Discovery Session: free 30 minutes that will give you clarity on where you are, what's holding you back, and exactly what your next step looks like. From there, we build everything together.",
			'image'           => $images . 'about-faq-hires.webp',
			'image_width'     => 600,
			'image_height'    => 800,
			'image_alt'       => 'Ksenia in the mountains',
			'button_url'      => $booking,
		)
	);
	?>
</article>
<?php get_footer();
