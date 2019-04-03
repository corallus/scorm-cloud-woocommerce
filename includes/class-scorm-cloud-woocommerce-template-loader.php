<?php
/**
 * @package   Scorm_Cloud_Woocommerce
 * @author    Vincent van Bergen
 * @link      
 * @copyright 2018 Vincent van Bergen
 * @license   GPL-2.0+
 */

/**
 * Template loader for Scorm_Cloud_Woocommerce.
 *
 * Only need to specify class properties here.
 *
 * @package Scorm_Cloud_Woocommerce
 * @author  Vincent van Bergen
 */
class Scorm_Cloud_Woocommerce_Template_Loader extends Gamajo_Template_Loader {
  /**
   * Prefix for filter names.
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $filter_prefix = 'scorm_cloud_woocommerce';
  /**
   * Directory name where custom templates for this plugin should be found in the theme.
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $theme_template_directory = 'scorm_cloud_woocommerce';
  /**
   * Reference to the root directory path of this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * In this case, `SCORM_CLOUD_WOOCOMMERCE_PLUGIN_DIR` would be defined in the root plugin file as:
   *
   * ~~~
   * define( 'SCORM_CLOUD_WOOCOMMERCE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
   * ~~~
   *
   * @since 1.0.0
   *
   * @var string
   */
  protected $plugin_directory = SCORM_CLOUD_WOOCOMMERCE_PLUGIN_DIR;
  /**
   * Directory name where templates are found in this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * e.g. 'templates' or 'includes/templates', etc.
   *
   * @since 1.1.0
   *
   * @var string
   */
  protected $plugin_template_directory = 'public/partials';
}
