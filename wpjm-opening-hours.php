<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Radu.com
 * @since             1.0.0
 * @package           Opening_Hours
 *
 * @wordpress-plugin
 * Plugin Name:       WPJM Opening Hours
 * Plugin URI:        http://radu-c.com/wpjm-opening-hours
 * Description:       Using this plugin you'll have a opening hours field for your listings
 * Version:           1.0.0
 * Author:            Radu
 * Author URI:        http://radu-c.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpjm-opening-hours
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpjm-opening-hours.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpjm_opening_hours() {

	$opening_hours_plugin = new WPJM_Opening_Hours();
	$opening_hours_plugin->run();

}
run_wpjm_opening_hours();
