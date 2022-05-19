<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/webcreativeng
 * @since             2.0.0
 * @package           Cl_shiga_login
 *
 * @wordpress-plugin
 * Plugin Name:       Shiga - Custom WordPress Login for Rebranding your Login
 * Plugin URI:        https://webcreative.digital/
 * Description:       Shiga is a nice Custom Login Page for WordPress allowing you brand your login page.
 * Version:           2.0
 * Author:            webCreative Digital
 * Author URI:        https://webcreative.digital/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cl_shiga_login
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
define( 'CL_SHIGA_LOGIN_VERSION', '2.0' );
define( 'CL_SHIGA_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
define( 'CL_SHIGA_WP_LOGO', CL_SHIGA_PLUGIN_DIR . 'public/images/wp-default-logo.png' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cl_shiga_login-activator.php
 */
function activate_cl_shiga_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cl_shiga_login-activator.php';
	Cl_shiga_login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cl_shiga_login-deactivator.php
 */
function deactivate_cl_shiga_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cl_shiga_login-deactivator.php';
	Cl_shiga_login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cl_shiga_login' );
register_deactivation_hook( __FILE__, 'deactivate_cl_shiga_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cl_shiga_login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cl_shiga_login() {

	$plugin = new Cl_shiga_login();
	$plugin->run();

}

run_cl_shiga_login();
