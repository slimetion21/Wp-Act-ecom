<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 */

 get_header(); ?>

<div id="main-content-wrapper">

	<div id="main-content">

		<div id="main-content-inner">

			<?php if ( have_posts() ) :
					
					while ( have_posts() ) :
					
						the_post();

						// includes the single page content templata here
						get_template_part( 'template-parts/content', 'page' );

						// if comments are open or there's at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					
					endwhile;
						
				  else : 
				  
					// if no content is loaded, show the 'no found' template
					get_template_part( 'template-parts/content', 'none' );
			 
				  endif; ?>

		</div><!-- #main-content-inner -->

	</div><!-- #main-content -->

	<?php get_sidebar(); ?>

</div><!-- #main-content-wrapper -->

<?php get_footer(); ?>