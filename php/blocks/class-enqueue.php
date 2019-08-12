<?php
/**
 * Enqueue necessary scripts and styles.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

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
		add_action( 'enqueue_block_assets', array( $this, 'frontend_css' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_js' ) );
	}

	/**
	 * Enqueue the block JS.
	 */
	public function block_js() {

		// Scripts.
		wp_enqueue_script(
			'wp-presenter-pro-js',
			WP_PRESENTER_PRO_URL . 'dist/blocks.build.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
			WP_PRESENTER_PRO_VERSION,
			true
		);
		wp_localize_script(
			'wp-presenter-pro-js',
			'wp_presenter_pro',
			array(
				'rest_url'   => get_rest_url(),
				'rest_nonce' => wp_create_nonce( 'wp_rest' ),
			)
		);

		wp_set_script_translations( 'wp-presenter-pro-js', 'wp-presenter-pro' );

		// Styles.
		wp_enqueue_style(
			'wp-presenter-pro-editor', // Handle.
			WP_PRESENTER_PRO_URL . 'dist/blocks.editor.build.css',
			array(),
			WP_PRESENTER_PRO_VERSION,
			'all'
		);
	}

	/**
	 * Enqueue the front-end CSS.
	 */
	public function frontend_css() {
		wp_enqueue_style(
			'wp-presenter-pro-front-end-css', // Handle.
			WP_PRESENTER_PRO_URL . 'dist/blocks.style.build.css',
			array( 'wp-editor' ),
			WP_PRESENTER_PRO_VERSION,
			'all'
		);
	}
}