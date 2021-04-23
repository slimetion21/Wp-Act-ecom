<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "body-content-wrapper" div.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<?php
            if ( is_singular() && pings_open() ) :
                printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
            endif;
        ?>
		<meta name="viewport" content="width=device-width" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<a class="skip-link screen-reader-text" href="#main-content-wrapper">
			<?php _e( 'Skip to content', 'ayacoffeeshop' ); ?>
		</a>
		<div id="body-content-wrapper">
			
			<header id="header-main-fixed"
				<?php if ( ayacoffeeshop_should_display_slider() ) : ?>

									style="background-repeat: no-repeat;height:100vh;"
									data-slides="<?php echo esc_attr( ayacoffeeshop_slides_json() ); ?>"
									data-currentslide="0"

						<?php endif; ?>>

				<?php if ( ayacoffeeshop_should_display_slider() ) : ?>

						<div id="slider-image-container">
							<div class="slider-prev">
								<span></span>
							</div>
							<div class="slider-next">
								<span></span>
							</div>

							<div class="slider-dots">
								<?php $slidesCount = ayacoffeeshop_get_slides_count(); ?>
								<?php for ($i = 0; $i < $slidesCount; ++$i) : ?>

										<span data-slidenum="<?php echo esc_attr( $i ); ?>">
										</span>

								<?php endfor; ?>
							</div>
						</div>

				<?php endif; ?>

				<div id="header-main-fixed-container">
					<div id="header-content-wrapper">

						<div id="header-logo">
							<?php
								if ( function_exists( 'the_custom_logo' ) ) :

									the_custom_logo();

								endif;

								$header_text_color = get_header_textcolor();

							    if ( 'blank' !== $header_text_color ) :
							?>    
							        <div id="site-identity">

							        	<a href="<?php echo esc_url( home_url('/') ); ?>"
							        		title="<?php esc_attr( get_bloginfo('name') ); ?>">

							        		<h1 class="entry-title">
							        			<?php echo esc_html( get_bloginfo('name') ); ?>
											</h1>
							        	</a>
							        	<strong>
							        		<?php echo esc_html( get_bloginfo('description') ); ?>
							        	</strong>
							        </div>
							<?php
							    endif;
							?>
						</div><!-- #header-logo -->

						<nav id="navmain">
							<?php wp_nav_menu( array( 'theme_location' => 'primary',
													  'fallback_cb'    => 'wp_page_menu',
													  
													  ) ); ?>
						</nav><!-- #navmain -->
						
						<div class="clear">
						</div><!-- .clear -->

					</div><!-- #header-content-wrapper -->
					</div><!-- #header-main-fixed-container -->
			</header><!-- #header-main-fixed -->
			

			<div id="global-content-wrapper">

