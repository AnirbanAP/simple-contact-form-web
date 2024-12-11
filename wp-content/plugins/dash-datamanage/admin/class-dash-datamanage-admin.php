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
		wp_enqueue_style( $this->plugin_name.'-sweetalert', plugin_dir_url( __FILE__ ) .  'css/sweetalert2.min.css', []);

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

        wp_enqueue_script($this->plugin_name.'-sweetalertjs', plugin_dir_url( __FILE__ ) . 'js/sweetalert2.all.min.js', ['jquery']);

		wp_enqueue_script($this->plugin_name.'-froala_editor', plugin_dir_url( __FILE__ ) . 'js/froala_editor.min.js', ['jquery']);

		wp_enqueue_script('custom-js', plugin_dir_url( __FILE__ ) . 'js/custom-developer.js', array( 'jquery' ), time(), false );


		wp_localize_script( 'custom-js', 'frontend_ajax_object', 
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('add-form-nonce'),
			'delete_nonce' => wp_create_nonce('delete-form-nonce'),
			'admin_url' => admin_url(),
		)
	);

	}

	public function plugin_admin_menu()
	{
		add_menu_page( 'Contact Form', 'Contact Form','manage_options', 'dynamic_contact_form', [$this, 'admin_page_callback'], 'dashicons-feedback' );
		add_submenu_page( 'dynamic_contact_form', 'Add New', 'Add New','manage_options', 'add_new_form', [$this, 'admin_subpage_callback'] );
		add_submenu_page( 'dynamic_contact_form', 'Edit Form', 'Edit Form','edit_posts', 'edit_form', [$this, 'admin_edit_subpage_callback'] );
		add_submenu_page( 'dynamic_contact_form', 'Entries', 'Entries','manage_options', 's_c_entries', [$this, 'admin_entry_subpage_callback'] );
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

	function admin_entry_subpage_callback()
	{
		require_once plugin_dir_path(__FILE__) . 'plugin_templates/all-entries.php';
	}

	function admin_edit_subpage_callback(){
		// include_once('admin/plugin_templates/edit-form.php');
        require_once plugin_dir_path(__FILE__) . 'plugin_templates/edit-form.php';
	}

	//----------- generate unique id --- //

	function generate_unique_name($prefix = 'field') {
		return $prefix . '_' . uniqid();
	}
	


	public function custom_form_element_callback()
	{
		$nonce = $_POST['_ajax_nonce'];
		$element_type = $_POST['element_type'];
		$placeholder = $_POST['placeholder'];
		$elementLabel = $_POST['element_label'];
		$required = $_POST['field_required'];
		$dropdown_field = json_encode($_POST['dropdown_field']);
		$checkbox_field = json_encode($_POST['checkbox_field']);
		$radio_field    = json_encode($_POST['radio_field']);
		$fileinput     = $_POST['fileinput'];
		$filesize      = $_POST['filesize'];
		$extra_class   = ($_POST['extra_class']) ?? '';
		$element_name  = $_POST['element_name'];
		if (!wp_verify_nonce($nonce, 'add-form-nonce')) {
            die('Security check failed.');
        }

		if($required){
			$required ='required';
			$star  = '*';
		}else{
			$required = '';
			$star	  = '';
		}

		$field_html = '';

		switch ($element_type) {
			case 'text':
				$field_html = "<div class='form-group'>
					<label for='{$element_name}'>{$elementLabel} {$star}</label>
					<input type='text' name='{$element_name}' class='form-control {$extra_class}' placeholder='{$placeholder}' {$required}>
				</div>";
				break;
			case 'number':
				$field_html = "<div class='form-group'>
					<label for='{$element_name}'>{$elementLabel}</label>
					<input type='number' name='{$element_name}' class='form-control {$extra_class}' placeholder='{$placeholder}' {$required}>
				</div>";
				break;
			case 'textarea':
				$field_html = "<div class='form-group'>
					<label for='{$element_name}'>{$elementLabel}</label>
					<textarea class='form-control{$extra_class}' name='{$element_name}' placeholder='{$placeholder}' {$required}></textarea>
				</div>";
				break;
            case'date':
				$field_html = "<div class='form-group'>
                    <label for='{$element_name}'>{$elementLabel}</label>
                    <input type='date' name='{$element_name}' class='form-control {$extra_class}' {$required}>
                </div>";
				break;
			case 'tel';
			    $field_html = "<div class='form-group'>
                    <label for='{$element_name}'>{$elementLabel}</label>
                    <input type='tel' name='{$element_name}' class='form-control {$extra_class}' placeholder='{$placeholder}' {$required}>
                </div>";
				break;
			case 'email':
				$field_html = "<div class='form-group'>
                    <label for='{$element_name}'>{$elementLabel}</label>
                    <input type='email' name='{$element_name}' class='form-control {$extra_class}' placeholder='{$placeholder}' {$required}>
                </div>";
                break;
            case 'file';
			    $field_html = "<div class='form-group'>
                    <label for='{$element_name}'>{$elementLabel}</label>
                    <input type='file' name='{$element_name}' class='form-control {$extra_class}' {$required}>
                </div>";
				break;
			case 'checkbox':
				$checkbox_field = trim($checkbox_field, '"');
				$checkbox_labels = explode('\n', $checkbox_field);
				$checkbox_labels = array_map('trim', $checkbox_labels);
				$field_html = "<div class='form-group'><label for='{$element_name}'>{$elementLabel}</label><br>";
				foreach ($checkbox_labels as $label) {
					$field_html .= "<div class='form-check form-check-inline'>
						<input type='checkbox' class='form-check-input' name='{$element_name}' value= '{$label}' id='checkbox_{$label}' {$required}>
						<label class='form-check-label' for='{$element_name}'>{$label}</label>
					</div>";
				}
				$field_html .= "</div>";
				break;
			case 'radio':
				$radio_field = trim($radio_field, '"');
				$radio_labels = explode('\n', $radio_field);
				$radio_labels = array_map('trim', $radio_labels);
				$field_html = "<div class='form-group'><label for='{$element_name}'>{$elementLabel}</label><br>";
				foreach ($radio_labels as $label) {
					$field_html .= "<div class='form-check form-check-inline'>
						<input type='radio' class='form-check-input' name='{$element_name}' value= '{$label}' id='radio_{$label}' {$required}>
						<label class='form-check-label' for='{$element_name}'>{$label}</label>
					</div>";
				}
				$field_html .= "</div>";
				break;
			case 'select':
				$dropdown_field = trim($dropdown_field, '"');
				$dropdown_labels = explode('\n', $dropdown_field);
				$dropdown_labels = array_map('trim', $dropdown_labels);
				$field_html = "<div class='form-group'><label for='{$element_name}'>{$elementLabel}</label><br> <select class='form-select' name='{$element_name}' aria-label='Default select example'>";
				foreach ($dropdown_labels as $label) {
					$field_html .= "<option value='{$label}'>{$label}</option>";
				}
				$field_html .= "</select></div>";
				break;
			default:
				$field_html = "<p>Invalid element type</p>";
		}

		echo $field_html;

		die();
	}



	public function add_form_data_post_callback()
	{
		$nonce = $_POST['_ajax_nonce'];
		if (!wp_verify_nonce($nonce, 'add-form-nonce')) {
            die('Security check failed.');
        }
		$form_type = $_POST['form_type'];
		$form_name = $_POST['form_name'];
		$form_element = stripslashes($_POST['form_element']);
		$form_html_ele = $_POST['froala_editor'];
		$form_data = array();
		if(empty($form_element)){
			$form_data = $form_html_ele;
		}else{
			$form_data = $form_element;
		}

		$post_id = wp_insert_post([
			'post_title'   => $form_name,
			'post_content' => $form_data,
			'post_status'  => 'publish',
			'post_type'    => 'contact_simple_form', 
		]);
		if (is_wp_error($post_id)) {
			wp_send_json_error(['message' => 'Failed to create post.']);
		}

		// Parse the form HTML to extract field names
		$field_names = [];
		$dom = new DOMDocument();
		@$dom->loadHTML($form_data); // Suppress warnings for invalid HTML
		// print_r($dom);

		//fetch field labels ----------- 

		$labels = [];
		$label_elements = $dom->getElementsByTagName('label');
		foreach ($label_elements as $label) {
			$for = $label->getAttribute('for');
			$text = trim($label->nodeValue);
			if ($for) {
				$labels[$for] = $text;
			}
		}


		$inputs = $dom->getElementsByTagName('input');
		foreach ($inputs as $input) {
			$name = $input->getAttribute('name');
			$type = $input->getAttribute('type');
			$id = $input->getAttribute('id');
			$value = $input->getAttribute('value');
			$label = '';
			if ($id && isset($labels[$id])) {
				$label = $labels[$id];
			} elseif ($input->parentNode->nodeName === 'label') {
				$label = trim($input->parentNode->nodeValue);
			}
			if (empty($name)) {
				$name = $this->generate_unique_name('type');
				$input->setAttribute('name', $name); // Add the custom name attribute
			}
			if ($name) {
				$field_names[] = [
					'name'  => $name,
					'type'  => $type,
					'value' => $value,
					'label' => $label,
				];
			}
		}

		// Process <textarea> fields
		$textareas = $dom->getElementsByTagName('textarea');
		foreach ($textareas as $textarea) {
			$name = $textarea->getAttribute('name');
			$value = $textarea->nodeValue; // Content of the <textarea>
			$id = $textarea->getAttribute('id');

			$label = '';
			if ($id && isset($labels[$id])) {
				$label = $labels[$id];
			} elseif ($textarea->parentNode->nodeName === 'label') {
				$label = trim($textarea->parentNode->nodeValue);
			}
			if (empty($name)) {
				$name = $this->generate_unique_name('textarea');
				$input->setAttribute('name', $name); // Add the custom name attribute
			}
			if ($name) {
				$field_names[] = [
					'name'  => $name,
					'type'  => 'textarea',
					'value' => $value,
					'label' => $label,
				];
			}
		}

		// Process <select> fields
		$selects = $dom->getElementsByTagName('select');
		foreach ($selects as $select) {
			$name = $select->getAttribute('name');
			$options = $select->getElementsByTagName('option');
			$selected_value = '';
			$label = '';
			if ($id && isset($labels[$id])) {
				$label = $labels[$id];
			} elseif ($select->parentNode->nodeName === 'label') {
				$label = trim($select->parentNode->nodeValue);
			}
			// Find the selected option, if any
			foreach ($options as $option) {
				if ($option->getAttribute('selected')) {
					$selected_value = $option->nodeValue;
					break;
				}
			}

			if (empty($name)) {
				$name = $this->generate_unique_name('select');
				$input->setAttribute('name', $name); // Add the custom name attribute
			}

			if ($name) {
				$field_names[] = [
					'name'  => $name,
					'type'  => 'select',
					'value' => $selected_value,
					'label' => $label,
				];
			}
		}

		// Save field names and values as post meta
		update_post_meta($post_id, 'c_s_form_fields', $field_names);
		update_post_meta($post_id, 'c_s_form_element_type', $form_type);

		$shortcode = "[simple_custom_form id='{$post_id}' name='{$form_name}']";

		// Save the shortcode in post meta
		update_post_meta($post_id, 'c_s_form_shortcode', $shortcode);

		wp_send_json_success(['message' => 'Form saved successfully.', 'post_id' => $post_id, 'shortcode' => $shortcode]);

		die;
	}

	//---------------- delete form ----------- //

	public function delete_form_function()
	{
		$nonce = $_POST['_ajax_nonce'];
        if (!wp_verify_nonce($nonce, 'delete-form-nonce')) {
            die('Security check failed.');
        }
        $post_id = $_POST['postid'];

        if (!empty($post_id)) {
            wp_delete_post($post_id, true);
            wp_send_json_success(['message' => 'Form deleted successfully.']);
        }

        wp_send_json_error(['message' => 'Failed to delete form.']);

        die;
	}



}



function generate_form_shortcode($atts) {

	error_log('Shortcode was called with attributes: ' . print_r($atts, true));	
	// Extract attributes
	$atts = shortcode_atts(['id' => 0, 'name' => ''], $atts);
	$post_id = $atts['id'];

	if (!$post_id) {
		return '<p>No form found.</p>';
	}

	// Retrieve the form title and fields
	$form_title = $atts['name'];
	$form_fields = get_post_meta($post_id, 'c_s_form_fields', true);
	$form_field_data = get_the_content($post_id);
	$get_posts = get_post($post_id);
	$output =  apply_filters( 'the_content', $get_posts->post_content );
	$form_unique_id = 'form_' . $post_id . '_' . uniqid();
	// If $form_field_data is not empty, return it
	if (!empty($form_field_data)) {
		return "<div class='dynamic-form-html'>
					<input type='hidden' name='action' value='process_form_submission' />
					<input type='hidden' name='post_id' value='{$post_id}' />
					<input type='hidden' name='form_name' value='{$form_title}' />
					<input type='hidden' name='form_unique_id' value='{$form_unique_id}' />
					<h3 class='form-title'>" . esc_html($form_title) . "</h3>
					<div class='custom-form-content'>
						<form class='c_s_{$post_id}' id='{$form_unique_id}' method='post' action='' enctype='multipart/form-data'>
						 ".$output."
						</form>
					</div>
				</div>";
	}

	// Generate a unique form ID
	

	// Start form HTML with title and unique ID
	$form_html = "<div class='dynamic-form'>";
	$form_html.= "<input type='hidden' name='action' value='process_form_submission' />";
	$form_html.= "<input type='hidden' name='post_id' value='{$post_id}' />";
	$form_html.= "<input type='hidden' name='form_name' value='{$form_title}' />";
	$form_html.= "<input type='hidden' name='form_unique_id' value='{$form_unique_id}' />";
	$form_html .= "<h3 class='form-title'>" . esc_html($form_title) . "</h3>";
	$form_html .= "<form class='c_s_{$post_id}' id='{$form_unique_id}' method='post' action='' enctype='multipart/form-data'>";

	// Loop through fields and generate HTML
	if (!empty($form_fields)) {
		foreach ($form_fields as $field) {
			$name = $field['name'];
			$type = esc_attr($field['type']);
			$value = isset($field['value']) ? esc_attr($field['value']) : '';
			$label = $field['label'];
			
			if ($type === 'text' || $type === 'email' || $type === 'number' || $type === 'tel' || $type === 'file') {
				// Input fields
				$form_html .= "<div class='form-group'>
					<label for='{$name}'>". ucfirst($label) ."</label>
					<input type='{$type}' name='{$name}' id='{$name}' value='{$value}' class='form-control' />
				</div>";
			} elseif ($type === 'textarea') {
				// Textarea fields
				$form_html .= "<div class='form-group'>
					<label for='{$name}'>". ucfirst($label) ."</label>
					<textarea name='{$name}' id='{$name}' class='form-control'>{$value}</textarea>
				</div>";
			} elseif ($type === 'select') {
				// Select fields
				$form_html .= "<div class='form-group'>
					<label for='{$name}'>". ucfirst($label) ."</label>
					<select name='{$name}' id='{$name}' class='form-control'>
						<option value='{$value}' selected>{$value}</option>
					</select>
				</div>";
			}
		}

		// Add submit button
		$form_html .= "<div class='form-group'>
			<button type='submit' class='btn btn-primary contact_form'>Submit</button>
		</div>";
	} else {
		$form_html .= "<p>No form fields available.</p>";
	}

	// Close form and wrapper
	$form_html .= '</form>';
	$form_html .= '</div>';

	return $form_html;
}

add_shortcode('simple_custom_form', 'generate_form_shortcode');