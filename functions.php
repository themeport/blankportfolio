<?php
/**
 * blankportfolio functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blankportfolio
 */

if ( ! function_exists( 'blankportfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blankportfolio_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blankportfolio, use a find and replace
	 * to change 'blankportfolio' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blankportfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog-img', 480, 360, true );
	add_image_size( 'blankportfolio-blog', 1000, 500, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main' => __( 'Primary Menu',      'blankportfolio' ),
		'social'  => __( 'Social Links Menu', 'blankportfolio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add Excerpt support to pages
	add_post_type_support( 'page', 'excerpt' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blankportfolio_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'blankportfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blankportfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blankportfolio_content_width', 1000 );
}
add_action( 'after_setup_theme', 'blankportfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sideblankportfolios/#registering-a-sideblankportfolio
 */
function blankportfolio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Single Page Widgets', 'blankportfolio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'blankportfolio' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blankportfolio_widgets_init' );

/**
 * Register Google Fonts
 */
function blankportfolio_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$opensans = _x( 'on', 'Open Sans font: on or off', 'blankportfolio' );

	if ( 'off' !== $opensans ) {

		$font_families = array();
		$font_families[] = 'Open+Sans:400,700';

		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function blankportfolio_scripts() {
	wp_enqueue_style( 'blankportfolio-style', get_stylesheet_uri() );

	wp_enqueue_style( 'google-font', blankportfolio_fonts_url(), array(), null );

	// Font Awesome
	wp_register_style( 'font-fontawesome', get_stylesheet_directory_uri() . '/assets/fonts/css/font-awesome.css', array(), '20151215' );
	wp_enqueue_style( 'font-fontawesome' );

	wp_enqueue_script( 'blankportfolio-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'blankportfolio-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blankportfolio_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
