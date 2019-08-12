<?php
/**
 * WP Presenter Pro
 *
 * @package   WP_Presenter_Pro
 * @copyright Copyright(c) 2019, MediaRon LLC
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 *
 * Plugin Name: WP Presenter Pro
 * Plugin URI: https://mediaron.com/downloads/wp-presenter-pro/
 * Description: A plugin for allowing you to do presentations using WordPress.
 * Version: 1.0.0
 * Author: MediaRon LLC
 * Author URI: https://mediaron.com
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-presenter-pro
 * Domain Path: languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'WP_PRESENTER_PRO_VERSION', '1.0.0' );
define( 'WP_PRESENTER_PRO_PLUGIN_NAME', 'User Profile Picture Enhanced' );
define( 'WP_PRESENTER_PRO_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_PRESENTER_PRO_URL', plugins_url( '/', __FILE__ ) );
define( 'WP_PRESENTER_PRO_SLUG', plugin_basename( __FILE__ ) );
define( 'WP_PRESENTER_PRO_FILE', __FILE__ );

// Setup the plugin auto loader.
require_once 'php/autoloader.php';

/**
 * Admin notice for incompatible versions of PHP.
 */
function wp_presenter_pro_php_version_error() {
	printf( '<div class="error"><p>%s</p></div>', esc_html( wp_presenter_pro_php_version_text() ) );
}


/**
 * String describing the minimum PHP version.
 *
 * "Namespace" is a PHP 5.3 introduced feature. This is a hard requirement
 * for the plugin structure.
 *
 * @return string
 */
function wp_presenter_pro_php_version_text() {
	return __( 'WP Presenter Pro plugin error: Your version of PHP is too old to run this plugin. You must be running PHP 5.4 or higher.', 'wp-presenter-pro' );
}

// If the PHP version is too low, show warning and return.
if ( version_compare( phpversion(), '5.4', '<' ) ) {
	add_action( 'admin_notices', 'wp_presenter_pro_php_version_error' );
	return;
}

/**
 * Get the plugin object.
 *
 * @return \WP_Presenter_Pro\Plugin
 */
function wp_presenter_pro() {
	static $instance;

	if ( null === $instance ) {
		$instance = new \WP_Presenter_Pro\Plugin();
	}

	return $instance;
}

/**
 * Setup the plugin instance.
 */
wp_presenter_pro()
	->set_basename( plugin_basename( __FILE__ ) )
	->set_directory( plugin_dir_path( __FILE__ ) )
	->set_file( __FILE__ )
	->set_slug( 'wp-presenter-pro' )
	->set_url( plugin_dir_url( __FILE__ ) )
	->set_version( __FILE__ );

/**
 * Sometimes we need to do some things after the plugin is loaded, so call the Plugin_Interface::plugin_loaded().
 */
add_action( 'plugins_loaded', array( wp_presenter_pro(), 'plugin_loaded' ), 20 );
add_action( 'init', 'wp_presenter_pro_add_i18n' );

/**
 * Add i18n to User Profile Picture Enhanced.
 */
function wp_presenter_pro_add_i18n() {
	load_plugin_textdomain( 'wp-presenter-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
