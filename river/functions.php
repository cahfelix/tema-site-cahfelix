<?php

include_once get_template_directory() . '/theme-includes.php';

if ( ! function_exists( 'river_qode_rewrite_rules_on_theme_activation' ) ) {
	function river_qode_rewrite_rules_on_theme_activation() {
		flush_rewrite_rules();
	}

	add_action( 'after_switch_theme', 'river_qode_rewrite_rules_on_theme_activation' );
}

if ( ! function_exists( 'river_qode_add_theme_support' ) ) {
	function river_qode_add_theme_support() {
		//add support for feed links
		add_theme_support( 'automatic-feed-links' );

		//add support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );

		//add theme support for post thumbnails
		add_theme_support( 'post-thumbnails' );

		//add theme support for title tag
		add_theme_support( 'title-tag' );

		//defined content width variable
		$GLOBALS['content_width'] = 1060;

		load_theme_textdomain( 'river', get_template_directory() . '/languages' );

		//add theme support for editor style
		add_editor_style( 'css/admin/editor-style.css' );

		add_image_size( 'river-portfolio-square', 520, 520, true );
		add_image_size( 'river-menu-featured-post', 345, 198, true );

		register_nav_menus(
			array(
				'top-navigation' => esc_html__( 'Top Navigation', 'river' )
			)
		);
	}

	add_action( 'after_setup_theme', 'river_qode_add_theme_support' );
}

if ( ! function_exists( 'river_qode_styles' ) ) {
	function river_qode_styles() {
		$global_options = river_qode_return_global_options();

		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_style( "river-default-style", QODE_ROOT . "/style.css" );

		do_action( 'river_qode_action_enqueue_before_main_css' );

		wp_enqueue_style( "river-stylesheet", QODE_CSS_ROOT . "/stylesheet.min.css" );

		if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic.css' ) && river_qode_is_css_folder_writable() && ! is_multisite() ) {
			wp_enqueue_style( 'river-style-dynamic', QODE_CSS_ROOT . '/style_dynamic.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic.css' ) );
		} else if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.css' ) && river_qode_is_css_folder_writable() && is_multisite() ) {
			wp_enqueue_style( 'river-style-dynamic', QODE_CSS_ROOT . '/style_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.css' ) );
		} else {
			wp_enqueue_style( 'river-style-dynamic', QODE_CSS_ROOT . '/style_dynamic_callback.php' ); // Temporary case for Major update
		}

		$responsiveness = "yes";
		if ( isset( $global_options['responsiveness'] ) ) {
			$responsiveness = $global_options['responsiveness'];
		}

		if ( $responsiveness != "no" ):
			wp_enqueue_style( "river-responsive", QODE_CSS_ROOT . "/responsive.min.css" );

			//include proper styles
			if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive.css' ) && river_qode_is_css_folder_writable() && ! is_multisite() ) {
				wp_enqueue_style( 'river-style-dynamic-responsive', QODE_CSS_ROOT . '/style_dynamic_responsive.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive.css' ) );
			} else if ( file_exists( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive_ms_id_' . river_qode_get_multisite_blog_id() . '.css' ) && river_qode_is_css_folder_writable() && is_multisite() ) {
				wp_enqueue_style( 'river-style-dynamic-responsive', QODE_CSS_ROOT . '/style_dynamic_responsive_ms_id_' . river_qode_get_multisite_blog_id() . '.css', array(), filemtime( QODE_CSS_ROOT_DIR . '/style_dynamic_responsive_ms_id_' . river_qode_get_multisite_blog_id() . '.css' ) );
			} else {
				wp_enqueue_style( 'river-style-dynamic-responsive', QODE_CSS_ROOT . '/style_dynamic_responsive_callback.php' ); // Temporary case for Major update
			}
		endif;

		if( river_qode_return_toolbar_variable() ){
			wp_enqueue_style( "river-toolbar", QODE_CSS_ROOT . "/toolbar.css" );
		}

		wp_enqueue_style( 'js_composer_front' );

		$custom_css = $global_options['custom_css'];

		if ( ! empty( $custom_css ) ) {
			if ( $responsiveness != "no" ) {
				wp_add_inline_style( 'river-style-dynamic-responsive', $custom_css );
			} else {
				wp_add_inline_style( 'river-style-dynamic', $custom_css );
			}
		}

		$font_weight_str = '200,300,300i,400,400i,700';
		$font_subset_str = 'latin,latin-ext';

		//default fonts
		$default_font_family = array(
			'Oswald',
			'Open Sans'
		);

		$modified_default_font_family = array();
		foreach ( $default_font_family as $default_font ) {
			$modified_default_font_family[] = $default_font . ':' . str_replace( ' ', '', $font_weight_str );
		}

		$default_font_string = implode( '|', $modified_default_font_family );

		$available_font_options = array_filter( array(
			$global_options['google_fonts'],
			$global_options['page_title_google_fonts'],
			$global_options['h1_google_fonts'],
			$global_options['h2_google_fonts'],
			$global_options['h3_google_fonts'],
			$global_options['h4_google_fonts'],
			$global_options['h5_google_fonts'],
			$global_options['h6_google_fonts'],
			$global_options['text_google_fonts'],
			$global_options['menu_google_fonts'],
			$global_options['dropdown_google_fonts'],
			$global_options['dropdown_google_fonts_thirdlvl'],
			$global_options['mobile_google_fonts'],
			$global_options['button_title_google_fonts'],
			$global_options['message_title_google_fonts']
		) );

		//define available font options array
		$fonts_array = array();
		if ( ! empty( $available_font_options ) ) {
			foreach ( $available_font_options as $font_option_value ) {
				$font_option_string = $font_option_value . ':' . $font_weight_str;

				if ( ! in_array( str_replace( '+', ' ', $font_option_value ), $default_font_family ) && ! in_array( $font_option_string, $fonts_array ) ) {
					$fonts_array[] = $font_option_string;
				}
			}

			$fonts_array = array_diff( $fonts_array, array( '-1:' . $font_weight_str ) );
		}

		$google_fonts_string = implode( '|', $fonts_array );

		$protocol = is_ssl() ? 'https:' : 'http:';

		//is google font option checked anywhere in theme?
		if ( count( $fonts_array ) > 0 ) {

			//include all checked fonts
			$fonts_full_list      = $default_font_string . '|' . str_replace( '+', ' ', $google_fonts_string );
			$fonts_full_list_args = array(
				'family' => urlencode( $fonts_full_list ),
				'subset' => urlencode( $font_subset_str ),
			);

			$river_global_fonts = add_query_arg( $fonts_full_list_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'river-google-fonts', esc_url_raw( $river_global_fonts ), array(), '1.0.0' );

		} else {
			//include default google font that theme is using
			$default_fonts_args          = array(
				'family' => urlencode( $default_font_string ),
				'subset' => urlencode( $font_subset_str ),
			);
			$river_global_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'river-google-fonts', esc_url_raw( $river_global_fonts ), array(), '1.0.0' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'river_qode_styles' );
}

if ( ! function_exists( 'river_qode_scripts' ) ) {
	function river_qode_scripts() {
		$global_options = river_qode_return_global_options();
		global $is_IE;

		//init theme core scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-ui-resizable' );
		wp_enqueue_script( 'jquery-ui-selectable' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-effects-core' );
		wp_enqueue_script( 'jquery-effects-blind' );
		wp_enqueue_script( 'jquery-effects-bounce' );
		wp_enqueue_script( 'jquery-effects-clip' );
		wp_enqueue_script( 'jquery-effects-drop' );
		wp_enqueue_script( 'jquery-effects-explode' );
		wp_enqueue_script( 'jquery-effects-fade' );
		wp_enqueue_script( 'jquery-effects-fold' );
		wp_enqueue_script( 'jquery-effects-highlight' );
		wp_enqueue_script( 'jquery-effects-pulsate' );
		wp_enqueue_script( 'jquery-effects-scale' );
		wp_enqueue_script( 'jquery-effects-shake' );
		wp_enqueue_script( 'jquery-effects-slide' );
		wp_enqueue_script( 'jquery-effects-transfer' );
		wp_enqueue_script( 'jquery-ui-menu' );
		wp_enqueue_script( 'jquery-ui-position' );
		wp_enqueue_script( 'jquery-ui-progressbar' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'jquery-ui-spinner' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'wp-mediaelement' );

		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'doubletaptogo', QODE_JS_ROOT . '/plugins/doubletaptogo.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', QODE_JS_ROOT . '/plugins/modernizr.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'appear', QODE_JS_ROOT . '/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'absoluteCounter', QODE_JS_ROOT . '/plugins/absoluteCounter.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easypiechart', QODE_JS_ROOT . '/plugins/easypiechart.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'mixitup', QODE_JS_ROOT . '/plugins/jquery.mixitup.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'nicescroll', QODE_JS_ROOT . '/plugins/jquery.nicescroll.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyphoto', QODE_JS_ROOT . '/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids', QODE_JS_ROOT . '/plugins/jquery.fitvids.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'flexslider', QODE_JS_ROOT . '/plugins/jquery.flexslider-min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'isotope', QODE_JS_ROOT . '/plugins/jquery.isotope.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', QODE_JS_ROOT . '/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', QODE_JS_ROOT . '/plugins/waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'Chart', QODE_JS_ROOT . '/plugins/Chart.min.js', array( 'jquery' ), false, true );

		if ( $is_IE ) {
			wp_enqueue_script( "html5", QODE_JS_ROOT . "/plugins/html5.js", array( 'jquery' ), false, false );
		}

		if ( $global_options['enable_google_map'] == "yes" ) :
			if ( isset( $global_options['google_maps_api_key'] ) && $global_options['google_maps_api_key'] != '' ) {
				$google_maps_api_key = $global_options['google_maps_api_key'];
				wp_enqueue_script( "river-google-map-api", "https://maps.googleapis.com/maps/api/js?key=" . esc_attr( $google_maps_api_key ), array( 'jquery' ), false, true );
			}
		endif;

		if ( file_exists( QODE_JS_ROOT_DIR . '/default_dynamic.js' ) && river_qode_is_js_folder_writable() && ! is_multisite() ) {
			wp_enqueue_script( 'river-default-dynamic', QODE_JS_ROOT . '/default_dynamic.js', array( 'jquery' ), filemtime( QODE_JS_ROOT_DIR . '/default_dynamic.js' ), true );
		} else if ( file_exists( QODE_JS_ROOT_DIR . '/default_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.js' ) && river_qode_is_js_folder_writable() && is_multisite() ) {
			wp_enqueue_script( 'river-default-dynamic', QODE_JS_ROOT . '/default_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.js', array( 'jquery' ), filemtime( QODE_JS_ROOT_DIR . '/default_dynamic_ms_id_' . river_qode_get_multisite_blog_id() . '.js' ), true );
		} else {
			wp_enqueue_script( 'river-default-dynamic', QODE_JS_ROOT . '/default_dynamic_callback.php', array( 'jquery' ), false, true ); // Temporary case for Major update
		}

		wp_enqueue_script( "river-default", QODE_JS_ROOT . "/default.min.js", array( 'jquery' ), false, true );

		$custom_js = $global_options['custom_js'];
		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'river-default', $custom_js );
		}

		global $wp_scripts;
		$wp_scripts->add_data( 'comment-reply', 'group', 1 );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( "comment-reply" );
		}

		$has_ajax       = false;
		$qode_animation = "";
		if ( isset( $_SESSION['qode_animation'] ) ) {
			$qode_animation = $_SESSION['qode_animation'];
		}
		if ( ( $global_options['page_transitions'] != "0" ) && ( empty( $qode_animation ) || ( $qode_animation != "no" ) ) ) {
			$has_ajax = true;
		} elseif ( ! empty( $qode_animation ) && ( $qode_animation != "no" ) ) {
			$has_ajax = true;
		}

		if ( $has_ajax ) :
			wp_enqueue_script( "river-ajax", QODE_JS_ROOT . "/ajax.min.js", array( 'jquery' ), false, true );
		endif;

		wp_enqueue_script( 'wpb_composer_front_js' );

		if ( $global_options['use_recaptcha'] == "yes" ) :
			wp_enqueue_script( "recaptcha-ajax", "https://www.google.com/recaptcha/api/js/recaptcha_ajax.js", array( 'jquery' ), false, true );
		endif;

		if ( river_qode_return_toolbar_variable() ):
			wp_enqueue_script( "river-toolbar", QODE_ROOT . "/js/toolbar.js", array( 'jquery' ), false, true );
		endif;
	}

	add_action('wp_enqueue_scripts', 'river_qode_scripts');
}

if ( ! function_exists( 'river_qode_admin_jquery' ) ) {
	function river_qode_admin_jquery() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_style( 'river-admin-style', QODE_CSS_ROOT . '/admin/admin-style.css', false, '1.0', 'screen' );
		wp_enqueue_style( 'river-admin-colorstyle', QODE_CSS_ROOT . '/admin/admin-colorpicker.css', false, '1.0', 'screen' );
		wp_enqueue_script( 'color-picker', QODE_JS_ROOT . '/admin/colorpicker.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'river-admin-default', QODE_JS_ROOT . '/admin/default.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
	}

	add_action( 'admin_enqueue_scripts', 'river_qode_admin_jquery' );
}

if ( ! function_exists( 'river_qode_enqueue_editor_customizer_styles' ) ) {
	/**
	 * Enqueue supplemental block editor styles
	 */
	function river_qode_enqueue_editor_customizer_styles() {
		$protocol = is_ssl() ? 'https:' : 'http:';
		//include default google font that theme is using
		$default_fonts_args          = array(
			'family' => urlencode( 'Open Sans:300,400,600,700' ),
			'subset' => urlencode( 'latin-ext' ),
		);
		$river_global_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
		wp_enqueue_style( 'river-editor-google-fonts', esc_url_raw( $river_global_fonts ) );

		wp_enqueue_style( 'river-editor-customizer-style', QODE_CSS_ROOT . '/admin/editor-customizer-style.css' );
		wp_enqueue_style( 'river-editor-blocks-style', QODE_CSS_ROOT . '/admin/editor-blocks-style.css' );
	}

	add_action( 'enqueue_block_editor_assets', 'river_qode_enqueue_editor_customizer_styles' );
}

if ( ! function_exists( 'river_qode_enqueue_gutenberg_styles' ) ) {
	function river_qode_enqueue_gutenberg_styles() {
		if ( function_exists( 'is_gutenberg_page' ) && is_admin() ) {
			wp_enqueue_style( 'river-gutenberg-fix', get_template_directory_uri() . '/css/gutenberg.css', array(), '1.0' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'river_qode_enqueue_gutenberg_styles' );
}

if ( ! function_exists( 'river_qode_get_page_id' ) ) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see river_qode_is_woocommerce_installed()
	 * @see river_qode_is_woocommerce_shop()
	 */
	function river_qode_get_page_id() {

		if ( is_archive() || is_search() || is_404() || ( is_front_page() && is_home() ) ) {
			return - 1;
		}

		return get_queried_object_id();
	}
}

if ( ! function_exists( 'river_qode_user_scalable_meta' ) ) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to river_qode_action_header_meta action
	 */
	function river_qode_user_scalable_meta() {
		$global_options = river_qode_return_global_options();

		//is responsiveness option is chosen?
		if ( isset( $global_options['responsiveness'] ) && $global_options['responsiveness'] !== 'no' ) { ?>
			<meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
		<?php } else { ?>
			<meta name=viewport content="width=1200,user-scalable=no">
		<?php }
	}

	add_action( 'river_qode_action_header_meta', 'river_qode_user_scalable_meta' );
}

if ( ! function_exists( 'river_qode_excerpt_more' ) ) {
	function river_qode_excerpt_more( $more ) {
		return '...';
	}

	add_filter( 'excerpt_more', 'river_qode_excerpt_more' );
}

if ( ! function_exists( 'river_qode_excerpt_length' ) ) {
	function river_qode_excerpt_length( $length ) {
		$global_options = river_qode_return_global_options();

		if ( $global_options['number_of_chars'] ) {
			return $global_options['number_of_chars'];
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'river_qode_excerpt_length', 999 );
}

if ( ! function_exists( 'river_qode_the_excerpt_max_charlength' ) ) {
	function river_qode_the_excerpt_max_charlength( $charlength ) {
		$global_options = river_qode_return_global_options();

		$via        = isset( $global_options['twitter_via'] ) && $global_options['twitter_via'] !== '' ? $global_options['twitter_via'] : '';
		$excerpt    = get_the_excerpt();
		$charlength = 136 - ( mb_strlen( $via ) + $charlength );

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex   = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}

if ( ! function_exists( 'river_qode_excerpt' ) ) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in river_qode_set_blog_word_count function
	 */
	function river_qode_excerpt() {
		$global_options = river_qode_return_global_options();
		global $word_count, $post;

		if ( post_password_required() ) {
			echo get_the_password_form();
		} else {
			$word_count    = isset( $word_count ) && $word_count != "" ? $word_count : $global_options['number_of_chars'];
			$post_excerpt = $post->post_excerpt !== '' ? $post->post_excerpt : strip_tags( strip_shortcodes( $post->post_content ) );
			$clean_excerpt = strlen( $post_excerpt ) && strpos( $post_excerpt, '...' ) ? strstr( $post_excerpt, '...', true ) : $post_excerpt;

			if ( $clean_excerpt !== '' ) {
				$excerpt_word_array = explode( ' ', $clean_excerpt );
				$excerpt_word_array = array_slice( $excerpt_word_array, 0, $word_count );
				$excerpt            = implode( ' ', $excerpt_word_array ) . '...';

				echo '<p>' . wp_kses_post( $excerpt ) . '</p>';
			}
		}
	}
}

if ( ! function_exists( 'river_qode_shortcode_empty_paragraph_fix' ) ) {
	function river_qode_shortcode_empty_paragraph_fix( $content ) {
		$array = array(
			'<p>['    => '[',
			']</p>'   => ']',
			']<br />' => ']'
		);

		$content = strtr( $content, $array );

		return $content;
	}

	add_filter( 'the_content', 'river_qode_shortcode_empty_paragraph_fix' );
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once QODE_INCLUDES_ROOT_DIR . '/class-tgm-plugin-activation.php';

if ( ! function_exists( 'river_qode_register_required_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 *
	 * In this example, we register two plugins - one included with the TGMPA library
	 * and one from the .org repo.
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function river_qode_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// This is an example of how to include a plugin pre-packaged with a theme
			array(
				'name'               => esc_html__( 'River Core', 'river' ),
				'slug'               => 'river-core',
				'source'             => get_template_directory() . '/plugins/river-core.zip',
				'version'            => '1.1',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'LayerSlider WP', 'river' ),
				'slug'               => 'LayerSlider',
				'source'             => get_template_directory() . '/plugins/LayerSlider.zip',
				'version'            => '7.0.5',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'WPBakery Visual Composer', 'river' ),
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/plugins/js_composer.zip',
				'version'            => '6.7.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => ''
			),
			array(
				'name'     => esc_html__( 'Envato Market', 'river' ),
				'slug'     => 'envato-market',
				'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' => false
			)
		);

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       => 'river',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'river' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'river' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'river' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'river' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'river' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'river' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'river' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'river' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'river' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'river' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'river' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'river' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'river' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'river' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'river' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'river' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'river' ),
				'nag_type'                        => 'updated'
			)
		);

		tgmpa( $plugins, $config );
	}

	add_action( 'tgmpa_register', 'river_qode_register_required_plugins' );
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

// Initialising Shortcodes
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) && ! function_exists( 'river_qode_include_main_vc_file' ) ) {
	function river_qode_include_main_vc_file() {
		require_once QODE_ROOT_DIR . '/extendvc/extend-vc.php';
	}

	add_action( 'init', 'river_qode_include_main_vc_file', 2 );
}

if ( ! function_exists( 'river_qode_remove_vc_grid_element' ) ) {
	/**
	 * Function that removes Grid Elements Post Type
	 * that comes with Visual Composer from version 4.4.2
	 */
	function river_qode_remove_vc_grid_element() {
		remove_action( 'init', 'vc_grid_item_editor_create_post_type' );
	}

	add_action( 'vc_after_init', 'river_qode_remove_vc_grid_element', 12 );
}

if ( ! function_exists( 'river_qode_compare_portfolio_images' ) ) {
	function river_qode_compare_portfolio_images( $a, $b ) {
		if ( isset( $a['portfolioimgordernumber'] ) && isset( $b['portfolioimgordernumber'] ) ) {
			if ( $a['portfolioimgordernumber'] == $b['portfolioimgordernumber'] ) {
				return 0;
			}

			return ( $a['portfolioimgordernumber'] < $b['portfolioimgordernumber'] ) ? - 1 : 1;
		}

		return 0;
	}
}

if ( ! function_exists( 'river_qode_compare_portfolio_options' ) ) {
	function river_qode_compare_portfolio_options( $a, $b ) {
		if ( isset( $a['optionlabelordernumber'] ) && isset( $b['optionlabelordernumber'] ) ) {
			if ( $a['optionlabelordernumber'] == $b['optionlabelordernumber'] ) {
				return 0;
			}

			return ( $a['optionlabelordernumber'] < $b['optionlabelordernumber'] ) ? - 1 : 1;
		}

		return 0;
	}
}

if ( ! function_exists( 'river_qode_get_font_awesome_icon_array' ) ) {
	function river_qode_get_font_awesome_icon_array() {
		$icons = array(
			'icon-glass'                  => '\\f000',
			'icon-music'                  => '\\f001',
			'icon-search'                 => '\\f002',
			'icon-envelope-alt'           => '\\f003',
			'icon-heart'                  => '\\f004',
			'icon-star'                   => '\\f005',
			'icon-star-empty'             => '\\f006',
			'icon-user'                   => '\\f007',
			'icon-film'                   => '\\f008',
			'icon-th-large'               => '\\f009',
			'icon-th'                     => '\\f00a',
			'icon-th-list'                => '\\f00b',
			'icon-ok'                     => '\\f00c',
			'icon-remove'                 => '\\f00d',
			'icon-zoom-in'                => '\\f00e',
			'icon-zoom-out'               => '\\f010',
			'icon-off'                    => '\\f011',
			'icon-signal'                 => '\\f012',
			'icon-cog'                    => '\\f013',
			'icon-trash'                  => '\\f014',
			'icon-home'                   => '\\f015',
			'icon-file-alt'               => '\\f016',
			'icon-time'                   => '\\f017',
			'icon-road'                   => '\\f018',
			'icon-download-alt'           => '\\f019',
			'icon-download'               => '\\f01a',
			'icon-upload'                 => '\\f01b',
			'icon-inbox'                  => '\\f01c',
			'icon-play-circle'            => '\\f01d',
			'icon-repeat'                 => '\\f01e',
			'icon-refresh'                => '\\f021',
			'icon-list-alt'               => '\\f022',
			'icon-lock'                   => '\\f023',
			'icon-flag'                   => '\\f024',
			'icon-headphones'             => '\\f025',
			'icon-volume-off'             => '\\f026',
			'icon-volume-down'            => '\\f027',
			'icon-volume-up'              => '\\f028',
			'icon-qrcode'                 => '\\f029',
			'icon-barcode'                => '\\f02a',
			'icon-tag'                    => '\\f02b',
			'icon-tags'                   => '\\f02c',
			'icon-book'                   => '\\f02d',
			'icon-bookmark'               => '\\f02e',
			'icon-print'                  => '\\f02f',
			'icon-camera'                 => '\\f030',
			'icon-font'                   => '\\f031',
			'icon-bold'                   => '\\f032',
			'icon-italic'                 => '\\f033',
			'icon-text-height'            => '\\f034',
			'icon-text-width'             => '\\f035',
			'icon-align-left'             => '\\f036',
			'icon-align-center'           => '\\f037',
			'icon-align-right'            => '\\f038',
			'icon-align-justify'          => '\\f039',
			'icon-list'                   => '\\f03a',
			'icon-indent-left'            => '\\f03b',
			'icon-indent-right'           => '\\f03c',
			'icon-facetime-video'         => '\\f03d',
			'icon-picture'                => '\\f03e',
			'icon-pencil'                 => '\\f040',
			'icon-map-marker'             => '\\f041',
			'icon-adjust'                 => '\\f042',
			'icon-tint'                   => '\\f043',
			'icon-edit'                   => '\\f044',
			'icon-share'                  => '\\f045',
			'icon-check'                  => '\\f046',
			'icon-move'                   => '\\f047',
			'icon-step-backward'          => '\\f048',
			'icon-fast-backward'          => '\\f049',
			'icon-backward'               => '\\f04a',
			'icon-play'                   => '\\f04b',
			'icon-pause'                  => '\\f04c',
			'icon-stop'                   => '\\f04d',
			'icon-forward'                => '\\f04e',
			'icon-fast-forward'           => '\\f050',
			'icon-step-forward'           => '\\f051',
			'icon-eject'                  => '\\f052',
			'icon-chevron-left'           => '\\f053',
			'icon-chevron-right'          => '\\f054',
			'icon-plus-sign'              => '\\f055',
			'icon-minus-sign'             => '\\f056',
			'icon-remove-sign'            => '\\f057',
			'icon-ok-sign'                => '\\f058',
			'icon-question-sign'          => '\\f059',
			'icon-info-sign'              => '\\f05a',
			'icon-screenshot'             => '\\f05b',
			'icon-remove-circle'          => '\\f05c',
			'icon-ok-circle'              => '\\f05d',
			'icon-ban-circle'             => '\\f05e',
			'icon-arrow-left'             => '\\f060',
			'icon-arrow-right'            => '\\f061',
			'icon-arrow-up'               => '\\f062',
			'icon-arrow-down'             => '\\f063',
			'icon-share-alt'              => '\\f064',
			'icon-resize-full'            => '\\f065',
			'icon-resize-small'           => '\\f066',
			'icon-plus'                   => '\\f067',
			'icon-minus'                  => '\\f068',
			'icon-asterisk'               => '\\f069',
			'icon-exclamation-sign'       => '\\f06a',
			'icon-gift'                   => '\\f06b',
			'icon-leaf'                   => '\\f06c',
			'icon-fire'                   => '\\f06d',
			'icon-eye-open'               => '\\f06e',
			'icon-eye-close'              => '\\f070',
			'icon-warning-sign'           => '\\f071',
			'icon-plane'                  => '\\f072',
			'icon-calendar'               => '\\f073',
			'icon-random'                 => '\\f074',
			'icon-comment'                => '\\f075',
			'icon-magnet'                 => '\\f076',
			'icon-chevron-up'             => '\\f077',
			'icon-chevron-down'           => '\\f078',
			'icon-retweet'                => '\\f079',
			'icon-shopping-cart'          => '\\f07a',
			'icon-folder-close'           => '\\f07b',
			'icon-folder-open'            => '\\f07c',
			'icon-resize-vertical'        => '\\f07d',
			'icon-resize-horizontal'      => '\\f07e',
			'icon-bar-chart'              => '\\f080',
			'icon-twitter-sign'           => '\\f081',
			'icon-facebook-sign'          => '\\f082',
			'icon-camera-retro'           => '\\f083',
			'icon-key'                    => '\\f084',
			'icon-cogs'                   => '\\f085',
			'icon-comments'               => '\\f086',
			'icon-thumbs-up-alt'          => '\\f087',
			'icon-thumbs-down-alt'        => '\\f088',
			'icon-star-half'              => '\\f089',
			'icon-heart-empty'            => '\\f08a',
			'icon-signout'                => '\\f08b',
			'icon-linkedin-sign'          => '\\f08c',
			'icon-pushpin'                => '\\f08d',
			'icon-external-link'          => '\\f08e',
			'icon-signin'                 => '\\f090',
			'icon-trophy'                 => '\\f091',
			'icon-github-sign'            => '\\f092',
			'icon-upload-alt'             => '\\f093',
			'icon-lemon'                  => '\\f094',
			'icon-phone'                  => '\\f095',
			'icon-check-empty'            => '\\f096',
			'icon-bookmark-empty'         => '\\f097',
			'icon-phone-sign'             => '\\f098',
			'icon-twitter'                => '\\f099',
			'icon-facebook'               => '\\f09a',
			'icon-github'                 => '\\f09b',
			'icon-unlock'                 => '\\f09c',
			'icon-credit-card'            => '\\f09d',
			'icon-rss'                    => '\\f09e',
			'icon-hdd'                    => '\\f0a0',
			'icon-bullhorn'               => '\\f0a1',
			'icon-bell'                   => '\\f0a2',
			'icon-certificate'            => '\\f0a3',
			'icon-hand-right'             => '\\f0a4',
			'icon-hand-left'              => '\\f0a5',
			'icon-hand-up'                => '\\f0a6',
			'icon-hand-down'              => '\\f0a7',
			'icon-circle-arrow-left'      => '\\f0a8',
			'icon-circle-arrow-right'     => '\\f0a9',
			'icon-circle-arrow-up'        => '\\f0aa',
			'icon-circle-arrow-down'      => '\\f0ab',
			'icon-globe'                  => '\\f0ac',
			'icon-wrench'                 => '\\f0ad',
			'icon-tasks'                  => '\\f0ae',
			'icon-filter'                 => '\\f0b0',
			'icon-briefcase'              => '\\f0b1',
			'icon-fullscreen'             => '\\f0b2',
			'icon-group'                  => '\\f0c0',
			'icon-link'                   => '\\f0c1',
			'icon-cloud'                  => '\\f0c2',
			'icon-beaker'                 => '\\f0c3',
			'icon-cut'                    => '\\f0c4',
			'icon-copy'                   => '\\f0c5',
			'icon-paper-clip'             => '\\f0c6',
			'icon-save'                   => '\\f0c7',
			'icon-sign-blank'             => '\\f0c8',
			'icon-reorder'                => '\\f0c9',
			'icon-list-ul'                => '\\f0ca',
			'icon-list-ol'                => '\\f0cb',
			'icon-strikethrough'          => '\\f0cc',
			'icon-underline'              => '\\f0cd',
			'icon-table'                  => '\\f0ce',
			'icon-magic'                  => '\\f0d0',
			'icon-truck'                  => '\\f0d1',
			'icon-pinterest'              => '\\f0d2',
			'icon-pinterest-sign'         => '\\f0d3',
			'icon-google-plus-sign'       => '\\f0d4',
			'icon-google-plus'            => '\\f0d5',
			'icon-money'                  => '\\f0d6',
			'icon-caret-down'             => '\\f0d7',
			'icon-caret-up'               => '\\f0d8',
			'icon-caret-left'             => '\\f0d9',
			'icon-caret-right'            => '\\f0da',
			'icon-columns'                => '\\f0db',
			'icon-sort'                   => '\\f0dc',
			'icon-sort-down'              => '\\f0dd',
			'icon-sort-up'                => '\\f0de',
			'icon-envelope'               => '\\f0e0',
			'icon-linkedin'               => '\\f0e1',
			'icon-undo'                   => '\\f0e2',
			'icon-legal'                  => '\\f0e3',
			'icon-dashboard'              => '\\f0e4',
			'icon-comment-alt'            => '\\f0e5',
			'icon-comments-alt'           => '\\f0e6',
			'icon-bolt'                   => '\\f0e7',
			'icon-sitemap'                => '\\f0e8',
			'icon-umbrella'               => '\\f0e9',
			'icon-paste'                  => '\\f0ea',
			'icon-lightbulb'              => '\\f0eb',
			'icon-exchange'               => '\\f0ec',
			'icon-cloud-download'         => '\\f0ed',
			'icon-cloud-upload'           => '\\f0ee',
			'icon-user-md'                => '\\f0f0',
			'icon-stethoscope'            => '\\f0f1',
			'icon-suitcase'               => '\\f0f2',
			'icon-bell-alt'               => '\\f0f3',
			'icon-coffee'                 => '\\f0f4',
			'icon-food'                   => '\\f0f5',
			'icon-file-text-alt'          => '\\f0f6',
			'icon-building'               => '\\f0f7',
			'icon-hospital'               => '\\f0f8',
			'icon-ambulance'              => '\\f0f9',
			'icon-medkit'                 => '\\f0fa',
			'icon-fighter-jet'            => '\\f0fb',
			'icon-beer'                   => '\\f0fc',
			'icon-h-sign'                 => '\\f0fd',
			'icon-plus-sign-alt'          => '\\f0fe',
			'icon-double-angle-left'      => '\\f100',
			'icon-double-angle-right'     => '\\f101',
			'icon-double-angle-up'        => '\\f102',
			'icon-double-angle-down'      => '\\f103',
			'icon-angle-left'             => '\\f104',
			'icon-angle-right'            => '\\f105',
			'icon-angle-up'               => '\\f106',
			'icon-angle-down'             => '\\f107',
			'icon-desktop'                => '\\f108',
			'icon-laptop'                 => '\\f109',
			'icon-tablet'                 => '\\f10a',
			'icon-mobile-phone'           => '\\f10b',
			'icon-circle-blank'           => '\\f10c',
			'icon-quote-left'             => '\\f10d',
			'icon-quote-right'            => '\\f10e',
			'icon-spinner'                => '\\f110',
			'icon-circle'                 => '\\f111',
			'icon-reply'                  => '\\f112',
			'icon-github-alt'             => '\\f113',
			'icon-folder-close-alt'       => '\\f114',
			'icon-folder-open-alt'        => '\\f115',
			'icon-expand-alt'             => '\\f116',
			'icon-collapse-alt'           => '\\f117',
			'icon-smile'                  => '\\f118',
			'icon-frown'                  => '\\f119',
			'icon-meh'                    => '\\f11a',
			'icon-gamepad'                => '\\f11b',
			'icon-keyboard'               => '\\f11c',
			'icon-flag-alt'               => '\\f11d',
			'icon-flag-checkered'         => '\\f11e',
			'icon-terminal'               => '\\f120',
			'icon-code'                   => '\\f121',
			'icon-reply-all'              => '\\f122',
			'icon-mail-reply-all'         => '\\f122',
			'icon-star-half-empty'        => '\\f123',
			'icon-location-arrow'         => '\\f124',
			'icon-crop'                   => '\\f125',
			'icon-code-fork'              => '\\f126',
			'icon-unlink'                 => '\\f127',
			'icon-question'               => '\\f128',
			'icon-info'                   => '\\f129',
			'icon-exclamation'            => '\\f12a',
			'icon-superscript'            => '\\f12b',
			'icon-subscript'              => '\\f12c',
			'icon-eraser'                 => '\\f12d',
			'icon-puzzle-piece'           => '\\f12e',
			'icon-microphone'             => '\\f130',
			'icon-microphone-off'         => '\\f131',
			'icon-shield'                 => '\\f132',
			'icon-calendar-empty'         => '\\f133',
			'icon-fire-extinguisher'      => '\\f134',
			'icon-rocket'                 => '\\f135',
			'icon-maxcdn'                 => '\\f136',
			'icon-chevron-sign-left'      => '\\f137',
			'icon-chevron-sign-right'     => '\\f138',
			'icon-chevron-sign-up'        => '\\f139',
			'icon-chevron-sign-down'      => '\\f13a',
			'icon-html5'                  => '\\f13b',
			'icon-css3'                   => '\\f13c',
			'icon-anchor'                 => '\\f13d',
			'icon-unlock-alt'             => '\\f13e',
			'icon-bullseye'               => '\\f140',
			'icon-ellipsis-horizontal'    => '\\f141',
			'icon-ellipsis-vertical'      => '\\f142',
			'icon-rss-sign'               => '\\f143',
			'icon-play-sign'              => '\\f144',
			'icon-ticket'                 => '\\f145',
			'icon-minus-sign-alt'         => '\\f146',
			'icon-check-minus'            => '\\f147',
			'icon-level-up'               => '\\f148',
			'icon-level-down'             => '\\f149',
			'icon-check-sign'             => '\\f14a',
			'icon-edit-sign'              => '\\f14b',
			'icon-external-link-sign'     => '\\f14c',
			'icon-share-sign'             => '\\f14d',
			'icon-compass'                => '\\f14e',
			'icon-collapse'               => '\\f150',
			'icon-collapse-top'           => '\\f151',
			'icon-expand'                 => '\\f152',
			'icon-eur'                    => '\\f153',
			'icon-gbp'                    => '\\f154',
			'icon-usd'                    => '\\f155',
			'icon-inr'                    => '\\f156',
			'icon-jpy'                    => '\\f157',
			'icon-cny'                    => '\\f158',
			'icon-krw'                    => '\\f159',
			'icon-btc'                    => '\\f15a',
			'icon-file'                   => '\\f15b',
			'icon-file-text'              => '\\f15c',
			'icon-sort-by-alphabet'       => '\\f15d',
			'icon-sort-by-alphabet-alt'   => '\\f15e',
			'icon-sort-by-attributes'     => '\\f160',
			'icon-sort-by-attributes-alt' => '\\f161',
			'icon-sort-by-order'          => '\\f162',
			'icon-sort-by-order-alt'      => '\\f163',
			'icon-thumbs-up'              => '\\f164',
			'icon-thumbs-down'            => '\\f165',
			'icon-youtube-sign'           => '\\f166',
			'icon-youtube'                => '\\f167',
			'icon-xing'                   => '\\f168',
			'icon-xing-sign'              => '\\f169',
			'icon-youtube-play'           => '\\f16a',
			'icon-dropbox'                => '\\f16b',
			'icon-stackexchange'          => '\\f16c',
			'icon-instagram'              => '\\f16d',
			'icon-flickr'                 => '\\f16e',
			'icon-adn'                    => '\\f170',
			'icon-bitbucket'              => '\\f171',
			'icon-bitbucket-sign'         => '\\f172',
			'icon-tumblr'                 => '\\f173',
			'icon-tumblr-sign'            => '\\f174',
			'icon-long-arrow-down'        => '\\f175',
			'icon-long-arrow-up'          => '\\f176',
			'icon-long-arrow-left'        => '\\f177',
			'icon-long-arrow-right'       => '\\f178',
			'icon-apple'                  => '\\f179',
			'icon-windows'                => '\\f17a',
			'icon-android'                => '\\f17b',
			'icon-linux'                  => '\\f17c',
			'icon-dribbble'               => '\\f17d',
			'icon-skype'                  => '\\f17e',
			'icon-foursquare'             => '\\f180',
			'icon-trello'                 => '\\f181',
			'icon-female'                 => '\\f182',
			'icon-male'                   => '\\f183',
			'icon-gittip'                 => '\\f184',
			'icon-sun'                    => '\\f185',
			'icon-moon'                   => '\\f186',
			'icon-archive'                => '\\f187',
			'icon-bug'                    => '\\f188',
			'icon-vk'                     => '\\f189',
			'icon-weibo'                  => '\\f18a',
			'icon-renren'                 => '\\f18b',
		);

		ksort( $icons );

		return $icons;
	}
}

if ( ! function_exists( 'river_qode_hex2rgb' ) ) {
	function river_qode_hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );

		return $rgb; // returns an array with the rgb values
	}
}

if ( ! function_exists( 'river_qode_register_sidebars' ) ) {
	function river_qode_register_sidebars() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'river' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Default Sidebar area. In order to display this area you need to enable sidebar layout through global theme options or on page meta box options.', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
			'after_widget'  => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Page', 'river' ),
			'id'            => 'sidebar_page',
			'description'   => esc_html__( 'Default Sidebar area for Pages. In order to display this area you need to enable sidebar layout through global theme options or on page meta box options.', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
			'after_widget'  => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Header Top Left', 'river' ),
			'id'            => 'header_left',
			'description'   => esc_html__( 'Widgets added here will appear on the left side in top header area', 'river' ),
			'before_widget' => '<div class="header-widget %2$s header-left-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => ''
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Header Top Right', 'river' ),
			'id'            => 'header_right',
			'description'   => esc_html__( 'Widgets added here will appear on the right side in top header area', 'river' ),
			'before_widget' => '<div class="header-widget %2$s header-right-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => ''
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Side Area', 'river' ),
			'id'            => 'sidearea',
			'description'   => esc_html__( 'Widgets added here will appear inside Side Area', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 1', 'river' ),
			'id'            => 'footer_column_1',
			'description'   => esc_html__( 'Widgets added here will appear in the first column of top footer area', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 2', 'river' ),
			'id'            => 'footer_column_2',
			'description'   => esc_html__( 'Widgets added here will appear in the second column of top footer area', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 3', 'river' ),
			'id'            => 'footer_column_3',
			'description'   => esc_html__( 'Widgets added here will appear in the third column of top footer area', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column 4', 'river' ),
			'id'            => 'footer_column_4',
			'description'   => esc_html__( 'Widgets added here will appear in the fourth column of top footer area', 'river' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Text', 'river' ),
			'id'            => 'footer_text',
			'description'   => esc_html__( 'Widgets added here will appear in the footer bottom text area', 'river' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );
	}

	add_action( 'widgets_init', 'river_qode_register_sidebars' );
}

if ( ! function_exists( 'river_qode_comment' ) ) {
	function river_qode_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		$is_pingback_comment = $comment->comment_type == 'pingback';

		$comment_class = 'comment';

		if ( $is_pingback_comment ) {
			$comment_class .= ' pingback-comment';
		}
		?>
		<li>
		<div class="<?php echo esc_attr( $comment_class ); ?>">
			<?php if ( ! $is_pingback_comment ) { ?>
				<div class="image"> <?php echo get_avatar($comment, 90); ?> </div>
			<?php } ?>
			<div class="text">
				<h4 class="name"><?php if ( $is_pingback_comment ) { esc_html_e( 'Pingback:', 'river' ); } ?><?php echo get_comment_author_link(); ?></h4>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text'=>'<i class="icon-reply"></i>' ) ) ); ?>
				<?php if ( ! $is_pingback_comment ) { ?>
					<div class="text_holder" id="comment-<?php echo esc_attr( comment_ID() ); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'river' ); ?></em></p>
		<?php endif; ?>
		<?php
	}
}

