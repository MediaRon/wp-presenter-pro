<?php
/**
 * Enqueue necessary scripts and styles.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Admin
 */
class Enqueue {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
	}

	/**
	 * Enqueue the admin JS.
	 */
	public function add_scripts( $hook ) {
		if ( 'wppp_page_wp-presenter-pro-options' !== $hook ) {
			return;
		}

		// Scripts.
		wp_enqueue_script(
			'wp-presenter-pro-gradients',
			WP_PRESENTER_PRO_URL . 'js/gradientselector.js',
			array( 'jquery' ),
			WP_PRESENTER_PRO_VERSION,
			true
		);

		// Scripts.
		wp_enqueue_style(
			'wp-presenter-pro-gradients-css',
			WP_PRESENTER_PRO_URL . 'css/gradients.css',
			array( ),
			WP_PRESENTER_PRO_VERSION,
			'all'
		);
	}
}
