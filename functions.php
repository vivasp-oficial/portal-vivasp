<?php
/**
 * empath functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package empath
 */

 define( 'QUBAR_THEME_DRI', get_template_directory() );
 define( 'QUBAR_INC_DRI', get_template_directory() . '/inc/' );
 define( 'QUBAR_THEME_URI', get_template_directory_uri() );
 define( 'QUBAR_CSS_PATH', QUBAR_THEME_URI . '/assets/css' );
 define( 'QUBAR_JS_PATH', QUBAR_THEME_URI . '/assets/js' );
 define( 'QUBAR_IMG_PATH', QUBAR_THEME_URI . '/assets/images' );
 define( 'QUBAR_ADMIN_DRI', QUBAR_THEME_DRI . '/admin' );
 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function qubar_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on empath, use a find and replace
		* to change 'forcast' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'forcast', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_image_size('empath-img-size', 873, 450, true);
	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );
	remove_theme_support( 'widgets-block-editor' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// add support for post formats
	add_theme_support('post-formats', [
		'standard', 'image', 'video', 'gallery', 'audio'
	]);

	//Woocommerc
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'forcast' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'empath_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'qubar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function empath_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'empath_content_width', 640 );
}
add_action( 'after_setup_theme', 'empath_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function empath_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'forcast' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'forcast' ),
			'before_widget' => '<div id="%1$s" class="empath__sidebar-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Siderbar', 'forcast' ),
			'id'            => 'shop-sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'forcast' ),
			'before_widget' => '<div id="%1$s" class="widget mt-30 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'empath_widgets_init' );



/**
 *Google Font Load 
 */
if ( ! function_exists( 'empath_fonts_url' ) ) :
	
	function empath_fonts_url() {
		$fonts_url     = '';
		$font_families = array();
		$subsets       = 'latin';
	
	
		if ( 'off' !== _x( 'on', 'Inter: on or off', 'forcast' ) ) {
			$font_families[] = 'Inter:100,200,300,400,500,600,700,800,900';
		}
		if ( 'off' !== _x( 'on', 'Outfit: on or off', 'forcast' ) ) {
			$font_families[] = 'Outfit:100,200,300,400,500,600,700,800,900';
		}
	
		if ( $font_families ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}
	
		return esc_url_raw( $fonts_url );
	}
	endif;


/**
 * Enqueue scripts and styles.
 */
function empath_scripts() {

	wp_enqueue_style( 'empath-google-fonts', empath_fonts_url(), array(), null );

	wp_enqueue_style( 'bootstrap', QUBAR_CSS_PATH . '/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome', QUBAR_CSS_PATH . '/fontawesome.css' );
	wp_enqueue_style( 'empath-swiper', QUBAR_CSS_PATH . '/swiper.min.css' );
	wp_enqueue_style( 'mb-ytplayer', QUBAR_CSS_PATH . '/mb-ytplayer.min.css' );
	wp_enqueue_style( 'metis-menu', QUBAR_CSS_PATH . '/metis-menu.css' );
	wp_enqueue_style( 'e-animations', QUBAR_CSS_PATH . '/animate.css' );
	wp_enqueue_style( 'slick', QUBAR_CSS_PATH . '/slick.css' );
	wp_enqueue_style( 'forcast-core', QUBAR_CSS_PATH . '/forcast-core.css' );
	$your_curnt_lang = apply_filters('wpml_current_language', NULL);
	if (is_rtl() && $your_curnt_lang != 'en') {
		wp_enqueue_style('forcast-rtl', QUBAR_CSS_PATH . '/rtl.css');
	}
	wp_enqueue_style( 'forcast-style', get_stylesheet_uri(), array() );

	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'bootstrap', QUBAR_JS_PATH . '/bootstrap.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'jquery-marquee', QUBAR_JS_PATH . '/jquery.marquee.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'empath-swiper-bundle', QUBAR_JS_PATH . '/swiper-bundle.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'mb-YTPlayer', QUBAR_JS_PATH . '/mb-YTPlayer.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'metisMenu', QUBAR_JS_PATH . '/metisMenu.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'slick', QUBAR_JS_PATH . '/slick.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'forcast-core', QUBAR_JS_PATH . '/forcast-core.js', array('jquery'), time(), true );

	wp_localize_script('forcast-core', 'bookmarkAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('bookmark_nonce'),
    ));

	wp_localize_script( 'forcast-core', 'empath_ajax', array(	   
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'post_scroll_limit' => 5,
		'nonce' => wp_create_nonce( 'empath-nonce' )		 
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'empath_scripts' );

function qubar_add_defer_attribute($tag, $handle) {
    // List of script handles to defer
    $scripts_to_defer = array(
        'bootstrap',
        'jquery-marquee',
        'empath-swiper-bundle',
        'mb-YTPlayer',
        'metisMenu',
        'slick',
        'forcast-core'
    );

    if (in_array($handle, $scripts_to_defer)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'qubar_add_defer_attribute', 10, 2);


/**
 * Implement the Custom Header feature.
 */
require QUBAR_THEME_DRI . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require QUBAR_THEME_DRI . '/inc/template-tags.php';
/**
 * Breadcrumb
 */
require QUBAR_THEME_DRI . '/inc/breadcrumb-core.php';

/**
 * Custom template tags for this theme.
 */
require QUBAR_THEME_DRI . '/inc/class-wp-qubar-navwalker.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require QUBAR_THEME_DRI . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require QUBAR_THEME_DRI . '/inc/qubar-functions.php';

/**
 * Cs Fremwork Config
 */
require QUBAR_THEME_DRI . '/inc/cs-framework-functions.php';

/**
 * Dynamic Style
 */
require QUBAR_THEME_DRI . '/inc/dynamic-style.php';

/**
 * empath Core Functions
 */
require QUBAR_THEME_DRI . '/inc/qubar-helper-class.php';

/**
 * empath Core Functions
 */
require QUBAR_THEME_DRI . '/inc/admin/class-admin-dashboard.php';

/**
 * empath Core Functions
 */
require QUBAR_THEME_DRI . '/inc/admin/demo-import/functions.php';

/**
 * Customizer additions.
 */
require QUBAR_THEME_DRI . '/inc/customizer.php';

/**
 * Bookmark Function
 */
require QUBAR_THEME_DRI . '/bookmark/functions.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require QUBAR_THEME_DRI . '/inc/jetpack.php';
}

/**
 * Remove Action Hook
 */

 function empath_woo_theme_init(){
	$empath_exlude_hooks = require QUBAR_THEME_DRI . '/inc/remove_actions.php';
	foreach( $empath_exlude_hooks as $k => $v )
	{
		foreach( $v as $value )
		remove_action( $k, $value[0], $value[1] );
	}

}
add_action( 'init', 'empath_woo_theme_init');

function empath_megamenu_enable() {
	return true;
}
add_filter( 'th_enable_megamenu', 'empath_megamenu_enable' );

/**
 * Exclude Other
 *
 * @param [type] $query
 * @return void
 */
function bytf_filter_search_query($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'bytf_filter_search_query');
