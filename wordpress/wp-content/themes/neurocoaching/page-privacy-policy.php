<?php
/** Display the existing WordPress policy, without changing its legal text.
 * @package Neurocoaching
 */
get_header();
// A document page has no local FAQ block; use the home page FAQ destination.
neurocoaching_header( 'contact' );
?>
<article class="site-privacy" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</article>
<?php get_footer(); ?>
