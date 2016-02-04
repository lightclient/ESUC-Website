<?php
/**
 * @package Perth
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'post_feat_image' ) != 1 ) ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail('perth-large-thumb'); ?>
		</div>
	<?php endif; ?>
	
	<header class="entry-header">
		<?php if (get_theme_mod('hide_meta_single') != 1 ) : ?>
		<div class="entry-meta">
			<?php perth_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>	
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'perth' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php perth_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
