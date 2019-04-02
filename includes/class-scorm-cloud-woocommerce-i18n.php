<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/corallus
 * @since      1.0.0
 *
 * @package    Scorm_Cloud_Woocommerce
 * @subpackage Scorm_Cloud_Woocommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Scorm_Cloud_Woocommerce
 * @subpackage Scorm_Cloud_Woocommerce/includes
 * @author     Vincent van Bergen <v.vanbergen@gmail.com>
 */
class Scorm_Cloud_Woocommerce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'scorm-cloud-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
