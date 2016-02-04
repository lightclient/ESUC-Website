<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Perth
 */
?>
		</div>
	</div><!-- #content -->

    <a class="go-top"><i class="fa fa-angle-up"></i></a>


	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
    
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
	    <div class="footer-area">
		    <div class="footer-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</div>
			<?php get_sidebar('footer'); ?>
		</div>
		<?php endif; ?>

		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'perth' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'perth' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %2$s by %1$s.', 'perth' ), 'aThemes', '<a href="http://athemes.com/theme/perth" rel="designer">Perth</a>' ); ?>
		</div><!-- .site-info -->
	</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
