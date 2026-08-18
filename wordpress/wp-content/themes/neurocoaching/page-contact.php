<?php
/** Contact page and enquiry form. @package Neurocoaching */
get_header();
neurocoaching_header( 'contact' );

$status    = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';
$email_url = neurocoaching_email_url();
?>
<article class="site-page site-page--contact">
	<section class="site-section contact-page" aria-labelledby="contact-title">
		<div class="contact-page__inner">
			<div class="contact-page__intro">
				<p class="contact-page__eyebrow">CONTACT</p>
				<h1 id="contact-title">Let’s talk about your next step</h1>
				<p>Tell me where you are now and what you would like to change. I will reply personally and suggest the most useful next step.</p>
				<p class="contact-page__direct">Prefer email? <a href="<?php echo esc_url( $email_url ); ?>">Write to me directly</a>.</p>
			</div>

			<div class="contact-page__form-wrap">
				<?php if ( 'sent' === $status ) : ?>
					<p class="contact-form__status contact-form__status--success" role="status">Thank you. Your enquiry has been received.</p>
				<?php elseif ( 'invalid' === $status ) : ?>
					<p class="contact-form__status contact-form__status--error" role="alert">Please check the required fields and try again.</p>
				<?php elseif ( 'failed' === $status ) : ?>
					<p class="contact-form__status contact-form__status--error" role="alert">The message could not be sent. Please use the email link instead.</p>
				<?php endif; ?>

				<form id="contact-form" class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="neurocoaching_contact">
					<?php wp_nonce_field( 'neurocoaching_contact', 'neurocoaching_contact_nonce' ); ?>

					<p class="contact-form__field">
						<label for="contact-name">Name <span aria-hidden="true">*</span></label>
						<input id="contact-name" name="name" type="text" maxlength="120" autocomplete="name" required>
					</p>
					<p class="contact-form__field">
						<label for="contact-email">Email <span aria-hidden="true">*</span></label>
						<input id="contact-email" name="email" type="email" maxlength="254" autocomplete="email" required>
					</p>
					<p class="contact-form__field contact-form__field--wide">
						<label for="contact-phone">Phone or messenger</label>
						<input id="contact-phone" name="phone" type="text" maxlength="80" autocomplete="tel">
					</p>
					<p class="contact-form__field contact-form__field--wide">
						<label for="contact-message">How can I help? <span aria-hidden="true">*</span></label>
						<textarea id="contact-message" name="message" rows="7" minlength="10" maxlength="5000" required></textarea>
					</p>
					<p class="contact-form__trap" aria-hidden="true">
						<label for="contact-website">Leave this field blank</label>
						<input id="contact-website" name="website" type="text" tabindex="-1" autocomplete="off">
					</p>
					<label class="contact-form__consent">
						<input name="consent" type="checkbox" value="1" required>
						<span>I agree that my details may be used to reply to this enquiry.</span>
					</label>
					<button class="site-button contact-form__submit" type="submit">Send message</button>
				</form>
			</div>
		</div>
	</section>
</article>
<?php get_footer();
