<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://grandworks.co
 * @since      1.3
 *
 * @package    Karnataka_covid
 * @subpackage Karnataka_covid/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.3
 * @package    Karnataka_covid
 * @subpackage Karnataka_covid/includes
 * @author     GrandWorks <hello@grandworks.co>
 */
class Karnataka_covid_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.3
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'karnataka_covid',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
