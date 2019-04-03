<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/corallus
 * @since      1.0.0
 *
 * @package    Scorm_Cloud_Woocommerce
 * @subpackage Scorm_Cloud_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Scorm_Cloud_Woocommerce
 * @subpackage Scorm_Cloud_Woocommerce/admin
 * @author     Vincent van Bergen <v.vanbergen@gmail.com>
 */
class Scorm_Cloud_Woocommerce_Admin {
	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'scorm_woo';

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
	 * Register the settings for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_setting() {
		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'scorm-cloud-woocommerce' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);
		add_settings_field(
			$this->option_name . '_appid',
			__( 'App ID', 'scorm-cloud-woocommerce' ),
			array( $this, $this->option_name . '_appid_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_appid' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_appid', 'string' );
		add_settings_field(
			$this->option_name . '_apikey',
			__( 'Secret Key', 'scorm-cloud-woocommerce' ),
			array( $this, $this->option_name . '_apikey_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_apikey' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_apikey', 'string' );
		add_settings_field(
			$this->option_name . '_origin',
			__( 'Origin', 'scorm-cloud-woocommerce' ),
			array( $this, $this->option_name . '_origin_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_origin' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_origin', 'string' );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function scorm_woo_general_cb() {
		echo '<p>' . __( 'Please change the settings accordingly.', 'scorm-cloud-woocommerce' ) . '</p>';
	}

	/**
	 * Render the API Key input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function scorm_woo_apikey_cb() {
		$value = get_option( $this->option_name . '_apikey' );
		echo '<input type="text" name="' . $this->option_name . '_apikey' . '" id="' . $this->option_name . '_apikey' . '" value="' . $value . '"> ';
	}

	/**
	 * Render the App id input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function scorm_woo_appid_cb() {
		$value = get_option( $this->option_name . '_appid' );
		echo '<input type="text" name="' . $this->option_name . '_appid' . '" id="' . $this->option_name . '_appid' . '" value="' . $value . '"> ';
	}

	/**
	 * Render the Origin input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function scorm_woo_origin_cb() {
		$value = get_option( $this->option_name . '_origin' );
		echo '<input type="text" name="' . $this->option_name . '_origin' . '" id="' . $this->option_name . '_origin' . '" value="' . $value . '"> ';
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since 1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_options_page( 'SCORM Cloud Settings', 'SCORM Cloud', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
	}
	/**
	 * Add settings action link to the plugins page.
	 * https://www.sitepoint.com/wordpress-plugin-boilerplate-part-2-developing-a-plugin/
	 *
	 * @since 1.0.0
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'SCORM Cloud Settings', 'scorm-cloud-woocommerce' ),
			__( 'SCORM Cloud', 'scorm-cloud-woocommerce' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/scorm-cloud-woocommerce-admin-display.php';
	}
}
