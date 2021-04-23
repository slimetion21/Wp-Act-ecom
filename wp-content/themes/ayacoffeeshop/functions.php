<?php
/**
 * functions and definitions
 */

/**
 * Set a constant that holds the theme's minimum supported PHP version.
 */
define( 'AYACOFFEESHOP_MIN_PHP_VERSION', '5.6' );

/**
 * Immediately after theme switch is fired we we want to check php version and
 * revert to previously active theme if version is below our minimum.
 */
add_action( 'after_switch_theme', 'ayacoffeeshop_test_for_min_php' );

/**
 * Switches back to the previous theme if the minimum PHP version is not met.
 */
function ayacoffeeshop_test_for_min_php() {

	// Compare versions.
	if ( version_compare( PHP_VERSION, AYACOFFEESHOP_MIN_PHP_VERSION, '<' ) ) {
		// Site doesn't meet themes min php requirements, add notice...
		add_action( 'admin_notices', 'ayacoffeeshop_min_php_not_met_notice' );
		// ... and switch back to previous theme.
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	};
}

if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}

/**
 * An error notice that can be displayed if the Minimum PHP version is not met.
 */
function ayacoffeeshop_min_php_not_met_notice() {
	?>
	<div class="notice notice-error is_dismissable">
		<p>
			<?php esc_html_e( 'You need to update your PHP version to run this theme.', 'ayacoffeeshop' ); ?> <br />
			<?php
			printf(
				/* translators: 1 is the current PHP version string, 2 is the minmum supported php version string of the theme */
				esc_html__( 'Actual version is: %1$s, required version is: %2$s.', 'ayacoffeeshop' ),
				PHP_VERSION,
				AYACOFFEESHOP_MIN_PHP_VERSION
			); // phpcs: XSS ok.
			?>
		</p>
	</div>
	<?php
}


if ( ! function_exists( 'ayacoffeeshop_setup' ) ) :

	function ayacoffeeshop_setup() {

		$defaults = array(
	        'flex-height' => false,
	        'flex-width'  => false,
	        'header-text' => array( 'site-title', 'site-description' ),
	    );
		add_theme_support( 'custom-logo', $defaults );


		add_theme_support( 'custom-background', array ('default-color'  => '#ffffff') );

		add_theme_support( 'automatic-feed-links' );

		load_theme_textdomain( 'ayacoffeeshop', get_template_directory() . '/languages' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'title-tag' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'editor-styles' );

		add_editor_style( array( 'css/editor-style.css', 
								 get_template_directory_uri() . '/css/font-awesome.css',
								 ayacoffeeshop_fonts_url()
						  ) );

		add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption',	) );

		$GLOBALS['content_width'] = 900;

		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'ayacoffeeshop' ),
			'footer'    => __( 'Footer Menu', 'ayacoffeeshop' ),
		) );

		// Define and register starter content to showcase the theme on new sites.
		$starter_content = array(

			'widgets' => array(
				'sidebar-widget-area' => array(
					'search',
					'recent-posts',
					'categories',
					'archives',
				),

				'footer-column-1-widget-area' => array(
					'recent-comments'
				),

				'footer-column-2-widget-area' => array(
					'recent-posts'
				),

				'footer-column-3-widget-area' => array(
					'calendar'
				),
			),

			'posts' => array(
				'home',
				'blog',
				'about',
				'contact'
			),

			// Default to a static front page and assign the front and posts pages.
			'options' => array(
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),

			// Set the front page section theme mods to the IDs of the core-registered pages.
			'theme_mods' => array(
				'ayacoffeeshop_slide1_image' => esc_url( get_template_directory_uri() . '/images/slider/1.jpg' ),
				'ayacoffeeshop_slide2_image' => esc_url( get_template_directory_uri() . '/images/slider/2.jpg' ),
				'ayacoffeeshop_slide3_image' => esc_url( get_template_directory_uri() . '/images/slider/3.jpg' ),
			),

			'nav_menus' => array(

				// Assign a menu to the "primary" location.
				'primary' => array(
					'name' => __( 'Primary Menu', 'ayacoffeeshop' ),
					'items' => array(
						'link_home',
						'page_blog',
						'page_contact',
						'page_about',
					),
				),

				// Assign a menu to the "footer" location.
				'footer' => array(
					'name' => __( 'Footer Menu', 'ayacoffeeshop' ),
					'items' => array(
						'link_home',
						'page_about',
						'page_blog',
						'page_contact',
					),
				),
			),
		);

		$starter_content = apply_filters( 'ayacoffeeshop_starter_content', $starter_content );
		add_theme_support( 'starter-content', $starter_content );
	}
endif; // ayacoffeeshop_setup
add_action( 'after_setup_theme', 'ayacoffeeshop_setup' );

if ( ! function_exists( 'ayacoffeeshop_load_scripts' ) ) :

	function ayacoffeeshop_load_scripts() {

		wp_enqueue_style( 'ayacoffeeshop-fonts', ayacoffeeshop_fonts_url(), array(), null );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( ) );
		wp_enqueue_style( 'ayacoffeeshop-style', get_stylesheet_uri(), array() );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		// Load Utilities JS Script
		wp_enqueue_script( 'ayacoffeeshop-utilities',
			get_template_directory_uri() . '/js/utilities.js', array( 'jquery' ) );
	}

endif; // ayacoffeeshop_load_scripts

add_action( 'wp_enqueue_scripts', 'ayacoffeeshop_load_scripts' );

if ( ! function_exists( 'ayacoffeeshop_widgets_init' ) ) :
	/**
	 *	widgets-init action handler. Used to register widgets and register widget areas
	 */
	function ayacoffeeshop_widgets_init() {
		
		// Register Sidebar Widget.
		register_sidebar( array (
							'name'	 		 =>	 __( 'Sidebar Widget Area', 'ayacoffeeshop'),
							'id'		 	 =>	 'sidebar-widget-area',
							'description'	 =>  __( 'The sidebar widget area', 'ayacoffeeshop'),
							'before_widget'	 =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
							'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
						) );

		// Register Footer Column #1
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #1', 'ayacoffeeshop' ),
								'id' 			 =>  'footer-column-1-widget-area',
								'description'	 =>  __( 'The Footer Column #1 widget area', 'ayacoffeeshop' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #2
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #2', 'ayacoffeeshop' ),
								'id' 			 =>  'footer-column-2-widget-area',
								'description'	 =>  __( 'The Footer Column #2 widget area', 'ayacoffeeshop' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #3
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #3', 'ayacoffeeshop' ),
								'id' 			 =>  'footer-column-3-widget-area',
								'description'	 =>  __( 'The Footer Column #3 widget area', 'ayacoffeeshop' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
	}
endif; // ayacoffeeshop_widgets_init
add_action( 'widgets_init', 'ayacoffeeshop_widgets_init' );

if ( ! function_exists( 'ayacoffeeshop_fonts_url' ) ) :
	/**
	 *	Load google font url used in the ayacoffeeshop theme
	 */
	function ayacoffeeshop_fonts_url() {

	    $fonts_url = '';
	 
	    /* Translators: If there are characters in your language that are not
	    * supported by Yanone, translate this to 'off'. Do not translate
	    * into your own language.
	    */
	    $questrial = _x( 'on', 'Yanone font: on or off', 'ayacoffeeshop' );

	    if ( 'off' !== $questrial ) {
	        $font_families = array();
	 
	        $font_families[] = 'Yanone';
	 
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	            'subset' => urlencode( 'latin,latin-ext' ),
	        );
	 
	        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	    }
	 
	    return $fonts_url;
	}
endif; // ayacoffeeshop_fonts_url

if ( ! function_exists( 'ayacoffeeshop_show_copyright_text' ) ) :
	/**
	 *	Displays the copyright text.
	 */
	function ayacoffeeshop_show_copyright_text() {

		$footerText = get_theme_mod('ayacoffeeshop_footer_copyright', null);

		if ( !empty( $footerText ) ) {

			echo esc_html( $footerText ) . ' | ';		
		}
	}
endif; // ayacoffeeshop_show_copyright_text

if ( ! function_exists( 'ayacoffeeshop_custom_header_setup' ) ) :
  /**
   * Set up the WordPress core custom header feature.
   *
   * @uses ayacoffeeshop_header_style()
   */
  function ayacoffeeshop_custom_header_setup() {

  	add_theme_support( 'custom-header', array (
                         'default-image'          => '',
                         'flex-height'            => true,
                         'flex-width'             => true,
                         'uploads'                => true,
                         'width'                  => 900,
                         'height'                 => 100,
                         'default-text-color'     => '#434343',
                         'wp-head-callback'       => 'ayacoffeeshop_header_style',
                      ) );
  }
endif; // ayacoffeeshop_custom_header_setup
add_action( 'after_setup_theme', 'ayacoffeeshop_custom_header_setup' );

if ( ! function_exists( 'ayacoffeeshop_header_style' ) ) :

  /**
   * Styles the header image and text displayed on the blog.
   *
   * @see ayacoffeeshop_custom_header_setup().
   */
  function ayacoffeeshop_header_style() {

  	$header_text_color = get_header_textcolor();

      if ( ! has_header_image()
          && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
               || 'blank' === $header_text_color ) ) {

          return;
      }

      $headerImage = get_header_image();
  ?>
      <style id="ayacoffeeshop-custom-header-styles" type="text/css">

          <?php if ( has_header_image() ) : ?>

                  #header-main-fixed {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

          <?php endif; ?>

          <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                      && 'blank' !== $header_text_color ) : ?>

                  #header-main-fixed, #header-main-fixed h1.entry-title {color: #<?php echo sanitize_hex_color_no_hash( $header_text_color ); ?>;}

          <?php endif; ?>
      </style>
  <?php
  }
endif; // End of ayacoffeeshop_header_style.

if ( class_exists('WP_Customize_Section') ) {
	class ayacoffeeshop_Customize_Section_Pro extends WP_Customize_Section {

		// The type of customize section being rendered.
		public $type = 'ayacoffeeshop';

		// Custom button text to output.
		public $pro_text = '';

		// Custom pro button URL.
		public $pro_url = '';

		// Add custom parameters to pass to the JS via JSON.
		public function json() {
			$json = parent::json();

			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );

			return $json;
		}

		// Outputs the template
		protected function render_template() {
?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<h3 class="accordion-section-title">
					{{ data.title }}

					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-primary alignright" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}
}

/**
 * Singleton class for handling the theme's customizer integration.
 */
final class ayacoffeeshop_Customize {

	// Returns the instance.
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	// Constructor method.
	private function __construct() {}

	// Sets up initial actions.
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	// Sets up the customizer sections.
	public function sections( $manager ) {

		// Load custom sections.

		// Register custom section types.
		$manager->register_section_type( 'ayacoffeeshop_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new ayacoffeeshop_Customize_Section_Pro(
				$manager,
				'ayacoffeeshop',
				array(
					'title'    => esc_html__( 'AyaCoffeeShopPro', 'ayacoffeeshop' ),
					'pro_text' => esc_html__( 'Upgrade to Pro', 'ayacoffeeshop' ),
					'pro_url'  => esc_url( 'https://ayatemplates.com/product/ayacoffeeshoppro' )
				)
			)
		);
	}

	// Loads theme customizer CSS.
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'ayacoffeeshop-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'ayacoffeeshop-customize-controls', trailingslashit( get_template_directory_uri() ) . 'css/customize-controls.css' );
	}
}

// Doing this customizer thang!
ayacoffeeshop_Customize::get_instance();

if ( ! function_exists( 'ayacoffeeshop_customize_register' ) ) :
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function ayacoffeeshop_customize_register( $wp_customize ) {

		/**
		 * Add Slider Section
		 */
		$wp_customize->add_section(
			'ayacoffeeshop_slider_section',
			array(
				'title'       => __( 'Header Slider', 'ayacoffeeshop' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add slide 1 background image
		$wp_customize->add_setting( 'ayacoffeeshop_slide1_image',
			array(
				'default' => get_template_directory_uri().'/images/slider/' . '1.jpg',
	    		'sanitize_callback' => 'ayacoffeeshop_sanitize_url'
			)
		);

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ayacoffeeshop_slide1_image',
				array(
					'label'   	 => __( 'Slide 1 Image', 'ayacoffeeshop' ),
					'section' 	 => 'ayacoffeeshop_slider_section',
					'settings'   => 'ayacoffeeshop_slide1_image',
				) 
			)
		);
		
		// Add slide 2 background image
		$wp_customize->add_setting( 'ayacoffeeshop_slide2_image',
			array(
				'default' => get_template_directory_uri().'/images/slider/' . '2.jpg',
	    		'sanitize_callback' => 'ayacoffeeshop_sanitize_url'
			)
		);

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ayacoffeeshop_slide2_image',
				array(
					'label'   	 => __( 'Slide 2 Image', 'ayacoffeeshop' ),
					'section' 	 => 'ayacoffeeshop_slider_section',
					'settings'   => 'ayacoffeeshop_slide2_image',
				) 
			)
		);
		
		// Add slide 3 background image
		$wp_customize->add_setting( 'ayacoffeeshop_slide3_image',
			array(
				'default' => get_template_directory_uri().'/images/slider/' . '3.jpg',
	    		'sanitize_callback' => 'ayacoffeeshop_sanitize_url'
			)
		);

	    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ayacoffeeshop_slide3_image',
				array(
					'label'   	 => __( 'Slide 3 Image', 'ayacoffeeshop' ),
					'section' 	 => 'ayacoffeeshop_slider_section',
					'settings'   => 'ayacoffeeshop_slide3_image',
				) 
			)
		);

		/**
		 * Add Footer Section
		 */
		$wp_customize->add_section(
			'ayacoffeeshop_footer_section',
			array(
				'title'       => __( 'Footer', 'ayacoffeeshop' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add Footer Copyright Text
		$wp_customize->add_setting(
			'ayacoffeeshop_footer_copyright',
			array(
			    'default'           => '',
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ayacoffeeshop_footer_copyright',
	        array(
	            'label'          => __( 'Copyright Text', 'ayacoffeeshop' ),
	            'section'        => 'ayacoffeeshop_footer_section',
	            'settings'       => 'ayacoffeeshop_footer_copyright',
	            'type'           => 'text',
	            )
	        )
		);

		/**
		 * Add Animations Section
		 */
		$wp_customize->add_section(
			'ayacoffeeshop_animations_display',
			array(
				'title'       => __( 'Animations', 'ayacoffeeshop' ),
				'capability'  => 'edit_theme_options',
			)
		);

		// Add display Animations option
		$wp_customize->add_setting(
				'ayacoffeeshop_animations_display',
				array(
						'default'           => 1,
						'sanitize_callback' => 'ayacoffeeshop_sanitize_checkbox',
				)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
							'ayacoffeeshop_animations_display',
								array(
									'label'          => __( 'Enable Animations', 'ayacoffeeshop' ),
									'section'        => 'ayacoffeeshop_animations_display',
									'settings'       => 'ayacoffeeshop_animations_display',
									'type'           => 'checkbox',
								)
							)
		);
	}
endif; // ayacoffeeshop_customize_register
add_action( 'customize_register', 'ayacoffeeshop_customize_register' );


if ( ! function_exists( 'ayacoffeeshop_sanitize_checkbox' ) ) :

	function ayacoffeeshop_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

endif; // ayacoffeeshop_sanitize_checkbox

if ( ! function_exists( 'ayacoffeeshop_sanitize_url' ) ) :

	function ayacoffeeshop_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}

endif; // ayacoffeeshop_sanitize_url

if ( ! function_exists( 'ayacoffeeshop_should_display_slider' ) ) :

	function ayacoffeeshop_should_display_slider() {

		return (is_front_page() && get_option( 'show_on_front' ) == 'page')
					&& (ayacoffeeshop_get_slides_count() > 0);
	}

endif; // ayacoffeeshop_should_display_slider

if ( ! function_exists( 'ayacoffeeshop_slides_json' ) ) :

	function ayacoffeeshop_slides_json() {

		$result = array();
		for ( $i = 1; $i <= 3; ++$i ) {

			$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';
			$slideImage = get_theme_mod( 'ayacoffeeshop_slide'.$i.'_image', $defaultSlideImage );

			if ( $slideImage != '' ) {

				$slide = array( 'slideImage' => $slideImage, );

				array_push($result, $slide);
			}
		}

		return json_encode($result);
	}

endif; // ayacoffeeshop_slides_json

if ( ! function_exists( 'ayacoffeeshop_get_slides_count' ) ) :

	function ayacoffeeshop_get_slides_count() {

		$result = 0;
		for ( $i = 1; $i <= 3; ++$i ) {

			$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';
			$slideImage = get_theme_mod( 'ayacoffeeshop_slide'.$i.'_image', $defaultSlideImage );
			if ( $slideImage != '' ) {

				++$result;
			}
		}

		return $result;
	}

endif; // ayacoffeeshop_get_slides_count


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function ayacoffeeshop_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'ayacoffeeshop_skip_link_focus_fix' );
