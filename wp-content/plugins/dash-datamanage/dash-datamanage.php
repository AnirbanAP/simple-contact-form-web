<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://google.com
 * @since             1.0.0
 * @package           Dash_Datamanage
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Contact Form Generator
 * Plugin URI:        https://wordpress.org
 * Description:       User data management plugin
 * Version:           1.0.0
 * Author:            Anirban
 * Author URI:        https://google.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dash-datamanage
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DASH_DATAMANAGE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dash-datamanage-activator.php
 */
function activate_dash_datamanage() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dash-datamanage-activator.php';
	Dash_Datamanage_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dash-datamanage-deactivator.php
 */
function deactivate_dash_datamanage() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dash-datamanage-deactivator.php';
	Dash_Datamanage_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dash_datamanage' );
register_deactivation_hook( __FILE__, 'deactivate_dash_datamanage' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dash-datamanage.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dash_datamanage() {

	$plugin = new Dash_Datamanage();
	$plugin->run();

}
run_dash_datamanage();
