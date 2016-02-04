<?php
/**
 *
 * @package Perth
 */
?>


	<?php //Set widget areas classes based on user choice
		$widget_areas = get_theme_mod('footer_widget_areas', '2');
		if ($widget_areas == '2') {
			$cols = 'col-md-6 col-sm-6';
		} else {
			$cols = 'col-md-12';
		}
	?>

	<div id="sidebar-footer" class="footer-widgets clearfix" role="complementary">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="footer-column <?php echo $cols; ?>">
				<?php dynamic_sidebar( 'footer-1'); ?>
			</div>
		<?php endif; ?>	
		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="footer-column <?php echo $cols; ?>">
				<?php dynamic_sidebar( 'footer-2'); ?>
			</div>
		<?php endif; ?>	
	</div>