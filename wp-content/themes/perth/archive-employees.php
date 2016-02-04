<?php
/**
 * Services archives template
 *
 * @package Sydney
 */

get_header(); ?>

	<div id="primary" class="content-area fullwidth">
		<main id="main" class="post-wrap roll-team" role="main">

		<?php if ( have_posts() ) : ?>
		<div class="employee-area clearfix">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php //Get the custom field values
					$position = get_post_meta( get_the_ID(), 'wpcf-position', true );
					$facebook = get_post_meta( get_the_ID(), 'wpcf-facebook', true );
					$twitter  = get_post_meta( get_the_ID(), 'wpcf-twitter', true );
					$google   = get_post_meta( get_the_ID(), 'wpcf-google-plus', true );
					$link     = get_post_meta( get_the_ID(), 'wpcf-custom-link', true );
				?>
				<div class="employee">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="employee-photo">
						<?php the_post_thumbnail('perth-medium-thumb'); ?>
					</div>
					<?php endif; ?>
					<h4 class="employee-name">
				        <?php if ($link == '') : ?>
				        	<?php the_title(); ?>
				        <?php else : ?>
				        	<a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a>
				        <?php endif; ?>					
					</h4>
					<div class="employee-position"><?php echo esc_html($position); ?></div>								
					<div class="employee-social">
						<?php if ($facebook != '') : ?>
						<div class="svg-container employee-svg">
							<?php perth_svg_1(); ?>
							<a class="facebook" href="<?php echo esc_url($facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
						</div>	
						<?php endif; ?>
						<?php if ($twitter != '') : ?>
						<div class="svg-container employee-svg">
							<?php perth_svg_1(); ?>
							<a class="twitter" href="<?php echo esc_url($twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
						</div>	
						<?php endif; ?>
						<?php if ($google != '') : ?>
						<div class="svg-container employee-svg">
							<?php perth_svg_1(); ?>			
							<a href="<?php echo esc_url($google); ?>"><i class="fa fa-google-plus"></i></a>
						</div>
						<?php endif; ?>
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
