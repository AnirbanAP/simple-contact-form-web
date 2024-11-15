<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://google.com
 * @since      1.0.0
 *
 * @package    Dash_Datamanage
 * @subpackage Dash_Datamanage/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dash_Datamanage
 * @subpackage Dash_Datamanage/admin
 * @author     Anirban <pramanik@gmail.com>
 */
class Dash_Datamanage_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dash-datamanage-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-datatables', plugin_dir_url( __FILE__ ) .  'css/datatables.min.css', [], $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-datatables-bootstrap', plugin_dir_url( __FILE__ ) .  'css/dataTables.bootstrap5.min.css', []);
        wp_enqueue_style( $this->plugin_name.'-datatables-buttons', plugin_dir_url( __FILE__ ) .  'css/buttons.dataTables.min.css', []);

	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script('jquery');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dash-datamanage-admin.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script($this->plugin_name.'-datatable', plugin_dir_url( __FILE__ ) . 'js/datatables.min.js', ['jquery' ], $this->version);
		wp_enqueue_script($this->plugin_name.'-btdatatable', plugin_dir_url( __FILE__ ) . 'js/dataTables.bootstrap5.min.js', ['jquery']);
        wp_enqueue_script($this->plugin_name.'-datatablebtn', plugin_dir_url( __FILE__ ) . 'js/dataTables-buttons-min.js', ['jquery']);

		wp_enqueue_script('custom-js', plugin_dir_url( __FILE__ ) . 'js/custom-developer.js', array( 'jquery' ), time(), false );


		wp_localize_script( 'custom-js', 'frontend_ajax_object', 
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('add-form-nonce'),
			'data_var_2' => 'value 2',
		)
	);

	}

	public function plugin_admin_menu()
	{
		add_menu_page( 'Contact Form', 'Contact Form','manage_options', 'dynamic_contact_form', [$this, 'admin_page_callback'], 'dashicons-feedback' );
		add_submenu_page( 'dynamic_contact_form', 'Add New', 'Add New','manage_options', 'add_new_form', [$this, 'admin_subpage_callback'] );
	}

	function admin_page_callback()
	{	
		// include_once('admin/plugin_templates/all-forms.php');
		require_once plugin_dir_path(__FILE__) . 'plugin_templates/all-forms.php';
	}

	function admin_subpage_callback()
	{
		// include_once('admin/plugin_templates/add-new-form.php');
        require_once plugin_dir_path(__FILE__) . 'plugin_templates/add-new-form.php';
	}


	public function custom_form_element_callback()
	{
		$nonce = $_POST['_ajax_nonce'];
		$element_type = $_POST['element_type'];
		$placeholder = $_POST['placeholder'];
		$elementLabel = $_POST['element_label'];
		$required = $_POST['field_required'];

		if (!wp_verify_nonce($nonce, 'add-form-nonce')) {
            die('Security check failed.');
        }

		if($required){
			$required ='required';
		}else{
			$required = '';
		}

		$field_html = '';

		switch ($element_type) {
			case 'text':
				$field_html = "<div class='form-group'>
					<label>{$elementLabel}</label>
					<input type='text' class='form-control' placeholder='{$placeholder}' {$required}>
				</div>";
				break;
			case 'number':
				$field_html = "<div class='form-group'>
					<label>{$elementLabel}</label>
					<input type='number' class='form-control' placeholder='{$placeholder}' {$required}>
				</div>";
				break;
			case 'textarea':
				$field_html = "<div class='form-group'>
					<label>{$elementLabel}</label>
					<textarea class='form-control' placeholder='{$placeholder}' {$required}></textarea>
				</div>";
				break;
			case 'checkbox':
				$field_html = "<div class='form-group'>
                    <label>{$elementLabel}</label>
                    <input type='checkbox' class='form-control' {$required}>
                </div>";
                break;
            case'date':
				$field_html = "<div class='form-group'>
                    <label>{$elementLabel}</label>
                    <input type='date' class='form-control' {$required}>
                </div>";
				break;
			case 'tel';
			    $field_html = "<div class='form-group'>
                    <label>{$elementLabel}</label>
                    <input type='tel' class='form-control' placeholder='{$placeholder}' {$required}>
                </div>";
				break;
			case 'email':
				$field_html = "<div class='form-group'>
                    <label>{$elementLabel}</label>
                    <input type='email' class='form-control' placeholder='{$placeholder}' {$required}>
                </div>";
                break;
            case 'file';
			    $field_html = "<div class='form-group'>
                    <label>{$elementLabel}</label>
                    <input type='file' class='form-control' {$required}>
                </div>";
				break;
			default:
				$field_html = "<p>Invalid element type</p>";
		}

		echo $field_html;

		die();
	}

}
