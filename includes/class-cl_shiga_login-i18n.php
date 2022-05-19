<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/webcreativeng
 * @since      1.0.0
 *
 * @package    Cl_shiga_login
 * @subpackage Cl_shiga_login/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cl_shiga_login
 * @subpackage Cl_shiga_login/includes
 * @author     Oderinde Oluwasegun (Victor) <info@webcreativeng.com>
 */
class Cl_shiga_login_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cl_shiga_login',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
