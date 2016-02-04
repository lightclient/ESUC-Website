<?php
/**
 * Services archives template
 *
 * @package Perth
 */

get_header(); ?>

	<div id="primary" class="content-area fullwidth">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

		<div class="service-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php $icon = get_post_meta( get_the_ID(), 'wpcf-service-icon', true ); ?>
				<?php $link = get_post_meta( get_the_ID(), 'wpcf-service-link', true ); ?>
				<div class="service columns3">
					<?php if ($icon) : ?>	
					<div class="svg-container service-icon-svg">
						<?php perth_svg_1(); ?>
						<span class="service-icon">
							<?php echo '<i class="fa ' . esc_html($icon) . '"></i>'; ?>
						</span>								
					</div>										
					<?php endif; ?>							
					<div class="content">
						<h4 class="service-title">
							<?php if ($link) : ?>
								<a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a>
							<?php else : ?>
								<?php the_title(); ?>
							<?php endif; ?>
						</h4>
						<?php the_content(); ?>
					</div>	
				</div>
			<?php endwhile; ?>
		</div>
			
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
