<?php
/** Career Services page reproduced from the client 1440/320 PSD artboards. @package Neurocoaching */
get_header();
neurocoaching_header( 'career' );
$booking_url = neurocoaching_booking_url();
$social_url    = neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' );
$instagram_url = neurocoaching_mod( 'instagram_url', 'https://www.instagram.com/belka80' );
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
	'Who is this for?' => 'For people who feel stuck, overlooked, at a crossroads, or ready to make a thoughtful professional change.',
	'Do I need to know what I want before working with you?' => 'No. Creating a clear direction can be the first part of our work together.',
	'How is your approach different from typical career coaching?' => 'We work with the whole person: goals, context, energy, patterns and the next realistic experiment.',
	'How is working with you different from just reading self-help books or watching videos?' => 'Our work is personal, structured and accountable. Advice becomes a practical strategy built around your experience and goals.',
	'What results can I expect?' => 'Greater clarity, a defined direction, practical decisions and a concrete next step.',
	'How long does it take to see results?' => 'Many clients gain useful clarity in the first session; deeper change depends on your goals and chosen format.',
	'Is this more about career or personal development?' => 'Career decisions and personal development often overlap, so we focus on the combination that supports your goal.',
	'Do I need to choose between career coaching and neurointegration — or can I do both?' => 'You can combine both. We select the tools that are useful for your situation rather than forcing a fixed format.',
	'Why should I choose to work with you?' => 'You receive international hiring insight, career strategy and supportive coaching from someone who understands change from both sides.',
	"What's the first step?" => 'Start with a conversation. You don’t need a perfect plan — just the willingness to change something. Book a Discovery Session: free 30 minutes that will give you clarity on where you are, what’s holding you back, and exactly what your next step looks like. From there, we build everything together.',
);
?>
<article class="site-page site-page--career career-psd">
	<section class="site-section site-hero career-hero">
		<div class="site-hero__media career-hero__photo"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/career-hero-client.webp' ) ); ?>" width="600" height="900" alt="Ksenia Belousova" decoding="async" fetchpriority="high"></div>
		<div class="site-hero__content career-hero__copy">
			<h1>Stop postponing your life</h1>
			<p class="career-quote">Your time is limited, so don’t waste it living someone else’s life.<br>– Steve Jobs</p>
			<ul class="career-hero__checklist">
				<li>You are ready for more, but your next step feels unclear.</li>
				<li>You want to move into the UN, an international organisation, or a global role, but you are not sure how to position yourself.</li>
				<li>You have been applying and hearing nothing back.</li>
				<li>You have strong experience, but your CV does not fully show your value.</li>
			</ul>
			<p>This is not a talent problem. It is a clarity, positioning, and strategy problem and this is where I can help.</p>
			<p>I spent 15+ years inside the UN, intergovernmental organisations, and international environments – designing job profiles, leading hiring processes, sitting on recruitment panels, and building HR strategies from the inside.</p>
			<p>I know what gets noticed, what gets missed, and why strong candidates often never receive the call.</p>
			<p class="career-accent">I have also been on the other side: changing careers, moving countries, starting over, and rebuilding my professional identity.</p>
			<p>You get strategic guidance from someone who understands both how international organisations work and what it feels like when your confidence is shaken and your next step is unclear.</p>
			<a class="site-button career-button" href="<?php echo esc_url( $booking_url ); ?>">Book a consultation</a>
		</div>
	</section>

	<?php
	neurocoaching_education_section(
		array(
			'id'                 => 'career-education-title',
			'target_id'          => 'career-credentials',
			'section_class'      => 'career-education',
			'inner_class'        => 'career-wrap',
			'certificates_class' => 'career-certificates',
			'certificates'       => neurocoaching_about_career_certificates(),
		)
	);
	neurocoaching_credentials_section(
		array(
			'id'            => 'career-credentials',
			'section_class' => 'career-credentials career-wrap',
			'label'         => 'Career credentials',
			'items'         => $credentials,
		)
	);
	?>

	<section class="career-positioning">
		<div class="career-positioning__statement">
			<h2><span>Stand out.</span><span class="career-positioning__accent">Get shortlisted.</span><span>Get hired.</span></h2>
			<p>I help professionals secure roles in the UN, international organisations, and leading global companies through strategic career positioning, compelling applications, and interview coaching.</p>
			<img class="career-positioning__zigzag" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/career-zigzag-white.svg' ) ); ?>" width="75" height="51" alt="" loading="lazy" decoding="async">
			<p>I know exactly what recruiters look for because I’ve been on the hiring side — reviewing applications, interviewing candidates, and advising hiring managers. I know what makes an application stand out and what gets overlooked.</p>
		</div>
		<div class="career-positioning__help">
			<h2>How can<br>I help you</h2>
			<ul>
				<li>Strategic career positioning</li>
				<li>CV / UN Application · LinkedIn · Cover Letter optimisation</li>
				<li>Competency-based interview preparation</li>
				<li>Communicate your strengths with clarity, confidence and impact</li>
				<li>10+ years of international HR &amp; talent acquisition expertise</li>
			</ul>
			<a class="site-button career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Book a free call</a>
		</div>
	</section>

	<section class="site-section site-shell site-services career-services career-wrap" aria-labelledby="career-services-title">
		<h2 class="site-section-title" id="career-services-title">Services | Career</h2>
		<div class="site-service-grid career-service-grid">
			<article class="site-service-card career-card">
				<h3>Consultation Session<br>90 min</h3><p class="career-card__label">Single Session</p>
				<div class="career-card__motif" aria-hidden="true"></div>
				<p>One focused 90 min session to identify what’s holding you back and define your clearest next step — whether you’re applying for your first job, going through a career shift, burnout,<br class="career-desktop-break"> or simply feeling stuck.</p>
				<h4>Includes:</h4>
				<p class="career-card__free">Free 30-min intro call</p>
				<ul><li>60-min deep-dive strategy session</li><li>Personal one-page action summary</li><li>Personalised next-step plan</li></ul>
				<p class="career-card__outcome">You leave knowing exactly what to do next</p>
				<p class="career-price">150 €</p><a class="site-button career-button" href="<?php echo esc_url( $booking_url ); ?>">Book a session</a>
			</article>
			<article class="site-service-card site-service-card--featured career-card career-card--featured">
				<span class="career-card__flag">Flagship</span><h3>Career Accelerator<br>4 × 60 min</h3><p class="career-card__label">4 SESSIONS</p>
				<div class="career-card__motif" aria-hidden="true"></div>
				<p>Four focused sessions to go from stuck<br class="career-desktop-break"> to executing. We refine your positioning, sharpen your CV and LinkedIn, prepare you<br class="career-desktop-break"> for interviews and stay available between sessions for questions and application reviews.</p>
				<h4>Includes:</h4>
				<ul><li>Positioning &amp; job search strategy</li><li>CV, LinkedIn &amp; cover letter refinement</li><li>Interview preparation &amp; techniques</li><li>Full mock interview with written feedback</li><li>Between-session support (application reviews &amp; questions)</li><li>One-page action summary — your profile, strategy, and next steps</li></ul>
				<p class="career-card__outcome">A compelling professional profile, a focused strategy, and the confidence to execute.</p>
				<p class="career-price"><s>650 €</s> <strong>450 €</strong></p><span class="career-offer">Special Offer</span><a class="site-button career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Buy premium package</a>
			</article>
		</div>
	</section>

	<section class="career-suitable">
		<div class="career-suitable__copy">
			<h2>This is for you if…</h2>
			<ul><li>You are ready for more, but your next step feels unclear</li><li>You want to move into the UN, an international organisation, or a global role</li><li>Your CV does not reflect your real value</li><li>You are changing direction and want to do it strategically</li><li>You feel stuck, overlooked, or unsure where to start</li></ul>
			<p>You do not have to figure this out alone.</p>
			<p>Together, we will clarify your direction, make your experience visible, and create a clear plan for your next move.</p>
			<p>My approach combines international HR expertise, career strategy, and nervous-system-aware guidance – so you can move forward with clarity and confidence.</p>
			<a class="site-button career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Book a free call</a>
		</div>
		<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/career-suitable-client.webp' ) ); ?>" width="1200" height="1782" alt="Ksenia Belousova in a blue beret" loading="lazy" decoding="async">
	</section>

	<section class="site-section site-reviews career-reviews" aria-labelledby="career-reviews-title"><div class="site-shell career-wrap">
		<h2 class="site-section-title" id="career-reviews-title">Reviews</h2>
		<div class="site-review-track career-review-track" tabindex="0" role="region" aria-label="Career reviews; use left and right arrow keys to browse" data-horizontal-track>
			<blockquote><header><strong>Andrea Scherer</strong><span>Logistics Enginee</span><a href="<?php echo esc_url( $social_url ); ?>">View profile on LinkedIn</a></header><p>I had the pleasure of connecting with Ksenia during my job search, and I was truly impressed by her dedication and support. She is incredibly empathetic, open-hearted, and genuinely cares about helping others.<br><br>Conversations with Ksenia are not only productive but also leave you with a real sense of comfort and encouragement. Her efforts go above and beyond, and I can wholeheartedly recommend her to anyone seeking guidance or support in their professional journey!</p><button class="career-review-more" type="button" aria-expanded="false">View full version</button></blockquote>
			<blockquote><header><strong>Sayazhan Tuyakova</strong><span>Erasmus Mundus<br>Master of Arts<br>in European Studies</span><a href="<?php echo esc_url( $social_url ); ?>">View profile on LinkedIn</a></header><p>I would like to share my impressions of Ksenia’s professional expertise in preparing candidates for vacancies at international organizations and navigating their hiring systems. I learned valuable new tips on improving my CV, profile, and motivation letters.<br><br>She helped me narrow down the range of vacancies that best align with my career path, and she highlighted my strengths while helping me structure a strong cover letter. I greatly appreciate her guidance, encouragement, and optimism.</p><button class="career-review-more" type="button" aria-expanded="false">View full version</button></blockquote>
			<blockquote><header><strong>Fernand Gouveia</strong><span>Building Innovation<br>Ecosystems<br>Princeton University</span><a href="<?php echo esc_url( $social_url ); ?>">View profile on LinkedIn</a></header><p>I highly recommend Ksenia for senior HR or project management roles. She is a dedicated mentor with a great deal of perspective and great communicator who inspires those around her to do their best, bringing out the best in both people and by extension the projects they work on.<br><br>She’s a natural leader who combines strategic vision with hands-on execution, always delivering excellent results, even in challenging international settings where her perspective is an obvious asset. Ksenia’s mix of technical skills, cultural understanding, and data-driven thinking makes her a valuable addition to any global team.</p><button class="career-review-more" type="button" aria-expanded="false">View full version</button></blockquote>
			<blockquote>
				<header><strong>Ekaterina Li</strong><span>Growth Manager @Moloco</span><a href="<?php echo esc_url( 'https://www.linkedin.com/in/ekaterina-li/' ); ?>">View profile on LinkedIn</a></header>
				<p>I had the privilege of consulting with Ksenia, and her depth of expertise in HR, particularly in employee engagement, organizational culture, and DEI, is truly impressive. She has an incredible ability to navigate the intricacies of HR management while offering practical, actionable advice tailored to individual challenges.<br><br>What sets Ksenia apart is her contagious energy and passion for creating thriving workplaces. Her mentorship has been invaluable to me—not only in developing my skills but also in boosting my confidence and perspective. Ksenia’s approach is both strategic and empathetic, making her a joy to work with and learn from. If you have the opportunity to collaborate with Ksenia, consider yourself lucky. She’s not only a seasoned professional but also a genuine and supportive leader who inspires everyone around her.</p>
				<button class="career-review-more" type="button" aria-expanded="false">View full version</button>
			</blockquote>
			<blockquote>
				<header><strong>Zuura Adanova</strong><span>Project Specialist</span><a href="<?php echo esc_url( 'https://www.linkedin.com/in/zuuraadanova/' ); ?>">View profile on LinkedIn</a></header>
				<p>I have had the privilege of connecting with Ksenia. She is a wonderful mentor and guide. Her vast experience has helped me decide on my path and she has given me the most helpful advice and direction. Thank you so much for your time and insightful mentoring.</p>
				<button class="career-review-more" type="button" aria-expanded="false">View full version</button>
			</blockquote>
			<blockquote>
				<header><strong>Yuliya Selivanova</strong><span>Project &amp; Border Management Specialist, IOM</span><a href="<?php echo esc_url( 'https://www.linkedin.com/in/yuliya-selivanova/' ); ?>">View profile on LinkedIn</a></header>
				<p>Очень благодарна Ксении за полное погружение в мою ситуацию и разработку целой стратегии по поиску работы именно в моем конкретном случае. Под чутким руководством я подавалась на желаемые и подходящие мне вакансии - с обновленным резюме и проработанными мотивационными письмами.<br><br>Несмотря на то, что пока поиск продолжается (а в моей сфере это может длиться очень долго), я уже чувствую себя гораздо увереннее, т.к. Ксения помогла посмотреть на мой опыт с другой стороны - глазами опытного HR специалиста. И именно с ее помощью я поняла свои сильные стороны, а также над чем нужно поработать. Уверенна, в скором времени меня ждет оффер)</p>
				<button class="career-review-more" type="button" aria-expanded="false">View full version</button>
			</blockquote>
		</div>
		<div class="career-review-nav" aria-label="Review navigation">
			<button class="career-review-nav__previous" type="button" aria-label="Previous review" data-review-previous></button>
			<button class="career-review-nav__next" type="button" aria-label="Next review" data-review-next></button>
		</div>
	</div></section>

	<?php
	$career_life_defaults = neurocoaching_career_gallery_urls();
	$career_life_slides = neurocoaching_gallery_urls( 'career_gallery_urls', implode( "\n", $career_life_defaults ) );
	$career_life_image = $career_life_slides[0];
	neurocoaching_real_life_section( 'career-life-title', $instagram_url, 'career_gallery_urls', $career_life_image, 'Ksenia at an international flags installation', $career_life_slides );
	?>

	<?php
	neurocoaching_cta_section(
		array(
			'button_label'  => 'Book a Consultation Session',
			'button_url'    => $booking_url,
			'section_class' => 'career-cta',
			'inner_class'   => 'career-wrap',
		)
	);
	neurocoaching_faq_section(
		array(
			'id'              => 'career-faq-title',
			'section_class'   => 'career-faq career-wrap',
			'questions_class' => 'career-faq__questions',
			'questions'       => $faqs,
			'open_question'   => "What's the first step?",
			'image'           => get_theme_file_uri( '/assets/images/career-faq-client.webp' ),
			'image_width'     => 700,
			'image_height'    => 910,
			'image_alt'       => 'Ksenia Belousova sailing',
			'button_label'    => 'Book a Consultation Session',
			'button_url'      => $booking_url,
		)
	);
	?>
</article>
<?php get_footer();
