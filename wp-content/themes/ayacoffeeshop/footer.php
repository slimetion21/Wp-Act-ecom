<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "body-content-wrapper" div and all content after.
 *
 */
?>

				<div class="clear">
				</div>
			</div><!-- #global-content-wrapper -->

			<a href="#" class="scrollup"></a>

			<footer id="footer-main">

				<div id="footer-content-wrapper">

					<?php get_sidebar( 'footer' ); ?>

					<nav id="footer-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'footer', ) ); ?>
					</nav>

					<div class="clear">
					</div>

				</div><!-- #footer-content-wrapper -->

			</footer>
			<div id="footer-bottom-area">
				<div id="footer-bottom-content-wrapper">
					<div id="copyright">

						<p>
							<?php ayacoffeeshop_show_copyright_text(); ?>
						 	<a href="<?php echo esc_url( 'https://ayatemplates.com/product/ayacoffeeshop' ); ?>"
						 		title="<?php esc_attr_e( 'ayacoffeeshop Theme', 'ayacoffeeshop' ); ?>">
								<?php esc_html_e('ayacoffeeshop Theme', 'ayacoffeeshop'); ?>
							</a> 
							<?php
								/* translators: %s: WordPress name */
								printf( __( 'Powered by %s', 'ayacoffeeshop' ), 'WordPress' ); ?>
						</p>
						
					</div><!-- #copyright -->
				</div>
			</div><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>