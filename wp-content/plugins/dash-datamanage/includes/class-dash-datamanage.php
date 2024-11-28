<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://google.com
 * @since      1.0.0
 *
 * @package    Dash_Datamanage
 * @subpackage Dash_Datamanage/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Dash_Datamanage
 * @subpackage Dash_Datamanage/includes
 * @author     Anirban <pramanik@gmail.com>
 */
class Dash_Datamanage {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Dash_Datamanage_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'DASH_DATAMANAGE_VERSION' ) ) {
			$this->version = DASH_DATAMANAGE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'dash-datamanage';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->register_shortcode();
	}

	public function register_shortcode() {
		error_log('Shortcode registered.');
        // add_shortcode('simple_custom_form', [$this, 'generate_form_shortcode']);
    }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Dash_Datamanage_Loader. Orchestrates the hooks of the plugin.
	 * - Dash_Datamanage_i18n. Defines internationalization functionality.
	 * - Dash_Datamanage_Admin. Defines all hooks for the admin area.
	 * - Dash_Datamanage_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dash-datamanage-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dash-datamanage-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dash-datamanage-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-dash-datamanage-public.php';

		$this->loader = new Dash_Datamanage_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Dash_Datamanage_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Dash_Datamanage_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Dash_Datamanage_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action('admin_menu', $plugin_admin, 'plugin_admin_menu');

		$this->loader->add_action( 'wp_ajax_add_form_element', $plugin_admin, 'custom_form_element_callback' ); 
    	$this->loader->add_action( 'wp_ajax_nopriv_add_form_element', $plugin_admin, 'custom_form_element_callback' );

		$this->loader->add_action( 'wp_ajax_add_form_data_to_post', $plugin_admin, 'add_form_data_post_callback' ); 
    	$this->loader->add_action( 'wp_ajax_nopriv_add_form_data_to_post', $plugin_admin, 'add_form_data_post_callback' );

		$this->loader->add_action( 'wp_ajax_delete_form', $plugin_admin, 'delete_form_function' ); 
    	$this->loader->add_action( 'wp_ajax_nopriv_delete_form', $plugin_admin, 'delete_form_function' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Dash_Datamanage_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action('admin_menu', $plugin_public, 'plugin_admin_menu');

		$this->loader->add_action( 'wp_ajax_frontend_form_submission', $plugin_public, 'frontend_form_submission_function' ); 
    	$this->loader->add_action( 'wp_ajax_nopriv_frontend_form_submission', $plugin_public, 'frontend_form_submission_function' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Dash_Datamanage_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
