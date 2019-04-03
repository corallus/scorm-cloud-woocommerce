<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/corallus
 * @since      1.0.0
 *
 * @package    Scorm_Cloud_Woocommerce
 * @subpackage Scorm_Cloud_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Scorm_Cloud_Woocommerce
 * @subpackage Scorm_Cloud_Woocommerce/public
 * @author     Vincent van Bergen <v.vanbergen@gmail.com>
 */
class Scorm_Cloud_Woocommerce_Public {

	private $template_loader;

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

	private $scormCloud;

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

		$this->scormCloud = new ScormEngineService(
			"https://cloud.scorm.com/EngineWebServices",
			get_option('scorm_woo_appid'),
			get_option('scorm_woo_apikey'),
			get_option('scorm_woo_origin'));
		$this->regService = $this->scormCloud->getRegistrationService();
		$this->courseService = $this->scormCloud->getCourseService();

		require plugin_dir_path( dirname(__FILE__) ) . 'includes/class-scorm-cloud-woocommerce-template-loader.php';
		$this->template_loader = new Scorm_Cloud_Woocommerce_Template_Loader;

	}

	/**
	 * Creates Scorm cloud registration 
	 *
	 * @since    1.0.0
	 */
	function scorm_order_status_completed( $order_id ){
		$order = wc_get_order( $order_id );
		$user = $order->get_user();
		if( $user ){
			$items = $order->get_items();
			foreach ( $items as $item ) {
				$product = wc_get_product( $item['product_id'] );
				$course_id = $product->get_sku();
				if ($course_id) {	
					$course_exists = $this->courseService->Exists($course_id);
					if ($course_exists) {	
						$result = $this->scormCloud->getInvitationService()->CreateInvitation(
							$product->get_sku(),
							'false',
							'false',
							$user->user_email
						);
					}
				}
			}
			$order->update_status( 'completed' );
		}
	}

	/**
	 * Adds link to order complete mail 
	 *
	 * @since    1.0.0
	 */
	function add_launch_to_order_item( $item_id, $item, $order ) { 
		$product = wc_get_product( $item['product_id'] );
		$course_id = $product->get_sku();
		if ( $course_id ) {
			$course_exists = $this->courseService->Exists($course_id);
			if ($course_exists) {	
				$user = $order->get_user();
				$registrations = $this->regService->GetRegistrationList(
					$course_id,
					$user->user_email
				);
				foreach ( $registrations as $registration ) {
					$launchUrl = $this->regService->GetLaunchUrl($registration->getRegistrationId(), get_permalink( get_option('woocommerce_myaccount_page_id') ));
					echo "<br /><a class=\"launch-button\" href=\"$launchUrl\">Begin met de cursus</a>";
				}
			}
		}
	}

	function register_shortcodes() {
		add_shortcode( 'registrations', array( $this, 'scorm_get_registrations') );
	}

	function scorm_get_registrations( ){
		$user = wp_get_current_user();
		$registrations = $this->regService->GetRegistrationList(
			null,
			$user->user_email
		);

		ob_start();
		$this->template_loader->
			set_template_data(array(
				'registrations' => $registrations,
				'regService' => $this->regService)
			)->
			get_template_part( 'registrations' );
		return ob_get_clean();
	}
}
