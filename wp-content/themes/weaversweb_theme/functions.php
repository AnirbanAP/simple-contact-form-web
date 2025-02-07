<?php
/**
 * Custom Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Custom_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'custom_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Custom Theme, use a find and replace
		 * to change 'custom_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'custom_theme', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'custom_theme' ),
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
				'custom_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

	}
endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );

/**
 * Add Helper Functions
 */
// require get_template_directory() . '/inc/helpers/helper-function-name.php';

/**
 * Add Post Types
 */
$post_type_path =  get_template_directory().'/inc/post-types/';
foreach (glob($post_type_path . '/*.php') as $file) {
    require_once $file;
}

/**
 * Implement the Meta Functions
 */
require get_template_directory() . '/inc/meta-functions.php';

/**
 * Add Template Functions
 */

	add_filter('theme_page_templates', function($post_templates) {
		$directories = glob(get_template_directory() . '/templates/*' , GLOB_ONLYDIR);
		
		foreach ($directories as $dir) {
		$templates = glob($dir.'/*.php');

		foreach ($templates as $template) {
			if (preg_match('|Template'.' '.'Name: (.*)$|mi', file_get_contents($template), $name)) {
			$post_templates['/templates/'.basename($dir).'/'.basename($template)] = $name[1];
			}
		}
		}

		return $post_templates;
	});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custom_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'custom_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'custom_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'custom_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'custom_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'custom_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function custom_theme_scripts() {
	wp_enqueue_style( 'custom_theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'custom_theme-style', 'rtl', 'replace' );

	wp_enqueue_style('bootstrap-min-css',get_template_directory_uri().'/css/bootstrap.min.css',array());
	wp_enqueue_style('font-awesome-all-min-css',get_template_directory_uri().'/css/font-awesome-all.min.css',array());
	wp_enqueue_style('custom-css',get_template_directory_uri().'/css/custom.css',array(),time());


	wp_enqueue_script('bootstrap-min-js',get_template_directory_uri().'/js/bootstrap.bundle.min.js',array('jquery'), time(), true);
	wp_enqueue_script('font-awesome-all-min-js',get_template_directory_uri().'/js/font-awesome-all.min.js',array('jquery'),time(), true);
	wp_enqueue_script('custom-js',get_template_directory_uri().'/js/custom.js',array('jquery'),time(),true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );

