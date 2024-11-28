<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://google.com
 * @since      1.0.0
 *
 * @package    Dash_Datamanage
 * @subpackage Dash_Datamanage/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dash_Datamanage
 * @subpackage Dash_Datamanage/public
 * @author     Anirban <pramanik@gmail.com>
 */
class Dash_Datamanage_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dash_Datamanage_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dash_Datamanage_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dash-datamanage-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dash_Datamanage_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dash_Datamanage_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dash-datamanage-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'frontend_dev-js', plugin_dir_url( __FILE__ ) . 'js/frontend_dev.js', array( 'jquery' ), time(), false  );
		
		wp_localize_script( 'frontend_dev-js', 'frontend_ajax', 
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce('submit-form-nonce'),
				'admin_url' => admin_url(),
				'site_url'  => site_url(),
			)
			);
	}


	/**
	 * 
     * add code for submit frontend contatc form --- 
	 * 
     */

	 public function frontend_form_submission_function()
	 {
		$nonce = $_POST['nonce'];
        if (!wp_verify_nonce($nonce, 'submit-form-nonce')) {
            die('Security check failed.');
        }

		$post_id = $_POST['post_id'];
		$form_data = $_POST['form_data'];

		if (!isset($post_id) || !isset($form_data)) {
			wp_send_json_error(['message' => 'Invalid request.']);
			return;
		}

		$stored_data = array();
		foreach ($form_data as $field_name => $field_value) {
			$stored_data[sanitize_text_field($field_name)] = sanitize_text_field($field_value);
		}


		wp_send_json_success(['message' => 'Success', 'data' => $stored_data]);
	 }
	

}
