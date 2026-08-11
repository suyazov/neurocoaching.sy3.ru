<?php
/** Career Services page reproduced from the client 1440/320 PSD artboards. @package Neurocoaching */
get_header();
neurocoaching_header( 'career' );
$booking_url = neurocoaching_mod( 'booking_url', 'mailto:hello@example.com' );
$social_url  = neurocoaching_mod( 'contact_url', 'https://www.linkedin.com/' );
?>
<article class="career-psd">
	<section class="career-hero">
		<div class="career-hero__photo"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/career-hero.webp' ) ); ?>" alt="Ksenia Belousova"></div>
		<div class="career-hero__copy">
			<h1>Stop postponing <span>your life</span></h1>
			<p class="career-quote">Your time is limited, so don’t waste it living someone else’s life.”<br>– Steve Jobs</p>
			<p class="career-intro"><strong>You are ready for more, but your next step feels unclear.</strong></p>
			<p>You want to move into the UN, an international organisation, or a global role, but you are not sure how to position yourself. You have been applying and hearing nothing back. You have strong experience, but your CV does not fully show your value.</p>
			<p>This is not a talent problem. It is a clarity, positioning, and strategy problem and this is where I can help. I spent 15+ years inside the UN, intergovernmental organisations, and international environments – designing job profiles, leading hiring processes, sitting on recruitment panels, and building HR strategies from the inside. I know what gets noticed, what gets missed, and why strong candidates often never receive the call.</p>
			<p class="career-accent">I have also been on the other side: changing careers, moving countries, starting over, and rebuilding my professional identity.</p>
			<p>You get strategic guidance from someone who understands both how international organisations work and what it feels like when your confidence is shaken and your next step is unclear.</p>
			<a class="career-button" href="<?php echo esc_url( $booking_url ); ?>">Book a consultation</a>
		</div>
	</section>

	<section class="career-education" aria-labelledby="career-education-title">
		<div class="career-wrap">
			<h2 id="career-education-title">Education &amp; Experience</h2>
			<div class="career-certificates" aria-label="Selected certificates">
				<figure><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/about-certificate-1.webp' ) ); ?>" alt="Webster University certificate"></figure>
				<figure><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/about-certificate-2.webp' ) ); ?>" alt="Neurointegration Institute certificate"></figure>
				<figure><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/about-certificate-3.webp' ) ); ?>" alt="Cornell University certificate"></figure>
				<figure><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/about-certificate-4.webp' ) ); ?>" alt="Professional qualification certificate"></figure>
				<figure><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/about-certificate-5.webp' ) ); ?>" alt="Coaching qualification certificate"></figure>
			</div>
			<a class="career-view-more" href="#career-credentials">View more <span aria-hidden="true">→</span></a>
		</div>
	</section>

	<section id="career-credentials" class="career-credentials career-wrap" aria-label="Career credentials">
		<ul>
			<li>15+ years in the UN &amp; international organisations — HR, project management, organisational development</li>
			<li>Worked with diplomats, senior UN officials, and international teams across the world</li>
			<li>Managed multi-million dollar international projects across UN missions</li>
			<li>Human Resources Management Certificate, Cornell University, USA</li>
			<li>ICF Certified Neurointegration Coach, Neurointegration Institute, USA</li>
			<li>Works with clients in English, Russian &amp; Italian</li>
			<li>MBA, Webster University, USA</li>
			<li>200+ hours of individual coaching practice</li>
		</ul>
	</section>

	<section class="career-positioning">
		<div class="career-positioning__statement">
			<h2>Stand out.<br>Get shortlisted.<br>Get hired.</h2>
			<p>I help professionals secure roles in the UN, international organisations, and leading global companies through strategic career positioning, compelling applications, and interview coaching.</p>
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
			<a class="career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Book a free call</a>
		</div>
	</section>

	<section class="career-services career-wrap" aria-labelledby="career-services-title">
		<h2 id="career-services-title">Services | Career</h2>
		<div class="career-service-grid">
			<article class="career-card">
				<h3>Consultation Session<br>90 min</h3><p class="career-card__label">Single Session</p>
				<p>One focused 90 min session to identify what’s holding you back and define your clearest next step — whether you’re applying for your first job, going through a career shift, burnout, or simply feeling stuck.</p>
				<h4>Includes:</h4>
				<p class="career-card__free">Free 30-min intro call</p>
				<ul><li>60-min deep-dive strategy session</li><li>Personal one-page action summary</li><li>Personalised next-step plan</li></ul>
				<p class="career-card__outcome">You leave knowing exactly what to do next</p>
				<p class="career-price">150 €</p><a class="career-button" href="<?php echo esc_url( $booking_url ); ?>">Book a session</a>
			</article>
			<article class="career-card career-card--featured">
				<span class="career-card__flag">Flagship</span><h3>Career Accelerator<br>4 × 60 min</h3><p class="career-card__label">4 SESSIONS</p>
				<p>Four focused sessions to go from stuck to executing. We refine your positioning, sharpen your CV and LinkedIn, prepare you for interviews and stay available between sessions for questions and application reviews.</p>
				<h4>Includes:</h4>
				<ul><li>Positioning &amp; job search strategy</li><li>CV, LinkedIn &amp; cover letter refinement</li><li>Interview preparation &amp; techniques</li><li>Full mock interview with written feedback</li><li>Between-session support (application reviews &amp; questions)</li><li>One-page action summary — your profile, strategy, and next steps</li></ul>
				<p class="career-card__outcome">A compelling professional profile, a focused strategy, and the confidence to execute.</p>
				<p class="career-price"><s>650 €</s> <strong>450 €</strong></p><span class="career-offer">Special Offer</span><a class="career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Buy premium package</a>
			</article>
		</div>
	</section>

	<section class="career-suitable">
		<div class="career-suitable__copy">
			<h2>This is for you if…</h2>
			<ul><li>You are ready for more, but your next step feels unclear</li><li>You want to move into the UN, an international organisation, or a global role</li><li>Your CV does not reflect your real value</li><li>You are changing direction and want to do it strategically</li><li>You feel stuck, overlooked, or unsure where to start</li></ul>
			<p>You do not have to figure this out alone. Together, we will clarify your direction, make your experience visible, and create a clear plan for your next move. My approach combines international HR expertise, career strategy, and nervous-system-aware guidance – so you can move forward with clarity and confidence.</p>
			<a class="career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Book a free call</a>
		</div>
		<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/career-portrait.webp' ) ); ?>" alt="Ksenia Belousova in a blue beret">
	</section>

	<section class="career-reviews" aria-labelledby="career-reviews-title"><div class="career-wrap">
		<h2 id="career-reviews-title">Reviews</h2>
		<div class="career-review-track">
			<blockquote><header><strong>Andrea Scherer</strong><span>Logistics Engineer</span><a href="<?php echo esc_url( $social_url ); ?>">View profile on LinkedIn</a></header><p>I had the pleasure of connecting with Ksenia during my job search, and I was truly impressed by her dedication and support. She is incredibly empathetic, open-hearted, and genuinely cares about helping others. Conversations with Ksenia are not only productive but also leave you with a real sense of comfort and encouragement. Her efforts go above and beyond, and I can wholeheartedly recommend her to anyone seeking guidance or support in their professional journey!</p></blockquote>
			<blockquote><header><strong>Sayazhan Tuyakova</strong><span>Erasmus Mundus<br>Master of Arts in European Studies</span><a href="<?php echo esc_url( $social_url ); ?>">View profile on LinkedIn</a></header><p>I would like to share my impressions of Ksenia’s professional expertise in preparing candidates for vacancies at international organizations and navigating their hiring systems. I learned valuable new tips on improving my CV, profile, and motivation letters. She helped me narrow down the range of vacancies that best align with my career path, and she highlighted my strengths while helping me structure a strong cover letter. I greatly appreciate her guidance, encouragement, and optimism.</p></blockquote>
			<blockquote><header><strong>Fernand Gouveia</strong><span>Building Innovation Ecosystems<br>Princeton University</span><a href="<?php echo esc_url( $social_url ); ?>">View profile on LinkedIn</a></header><p>I highly recommend Ksenia for senior HR or project management roles. She is a dedicated mentor with a great deal of perspective and a great communicator who inspires those around her to do their best. She’s a natural leader who combines strategic vision with hands-on execution, always delivering excellent results in challenging international settings.</p></blockquote>
		</div>
	</div></section>

	<section class="career-life career-wrap" aria-labelledby="career-life-title"><h2 id="career-life-title">In real life</h2><a href="<?php echo esc_url( $social_url ); ?>">Follow on Instagram</a><div><button type="button" aria-label="Previous photo">←</button><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/career-life.webp' ) ); ?>" alt="Ksenia at an international flags installation"><button type="button" aria-label="Next photo">→</button></div><p aria-hidden="true">● ○ ○ ○ ○ ○ ○ ○ ○ ○</p></section>

	<section class="career-cta"><div class="career-wrap"><h2>Ready to take the first step?</h2><p>Free 30-min intro call · No commitment</p><a class="career-button career-button--light" href="<?php echo esc_url( $booking_url ); ?>">Book a Consultation Session</a></div></section>

	<section id="faqs" class="career-faq career-wrap" aria-labelledby="career-faq-title">
		<header><h2 id="career-faq-title">FAQs</h2><p>(Frequently Asked Questions)</p></header>
		<div class="career-faq__questions">
		<?php
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
		foreach ( $faqs as $question => $answer ) : ?>
			<details><summary><?php echo esc_html( $question ); ?></summary><p><?php echo esc_html( $answer ); ?></p></details>
		<?php endforeach; ?>
		</div>
		<aside><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/about-faq.webp' ) ); ?>" alt="Ksenia Belousova"><h2>Ready to take the first step?</h2><p>Leave with clarity, a defined direction, and a concrete next step.</p><a class="career-button" href="<?php echo esc_url( $booking_url ); ?>">Book a Consultation Session</a></aside>
	</section>
</article>
<?php get_footer();
