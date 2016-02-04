<?php
/**
 * @package Perth
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('perth-large-thumb'); ?></a>
		</div>
	<?php endif; ?>
	
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() && get_theme_mod('hide_meta_index') != 1 ) : ?>
		<div class="entry-meta">
			<?php perth_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( (get_theme_mod('full_content_home') == 1 && is_home() ) || (get_theme_mod('full_content_archives') == 1 && is_archive() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'perth' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->