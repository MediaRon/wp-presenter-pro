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

		if ( 'wppp' !== get_post_type() ) {
			return;
		}

		// Get Intermedia Image Sizes for use in components.
		$intermediate_sizes = get_intermediate_image_sizes();
		$js_format_sizes    = array();
		foreach ( $intermediate_sizes as $size ) {
			$js_format_sizes[ $size ] = $size;
		}
		$js_format_sizes['full'] = 'Full';

		// Scripts.
		wp_enqueue_script(
			'wp-presenter-pro-js',
			WP_PRESENTER_PRO_URL . 'dist/blocks.build.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-plugins', 'wp-edit-post', 'wp-data' ),
			WP_PRESENTER_PRO_VERSION,
			true
		);
		wp_localize_script(
			'wp-presenter-pro-js',
			'wp_presenter_pro',
			array(
				'rest_url'    => get_rest_url(),
				'rest_nonce'  => wp_create_nonce( 'wp_rest' ),
				'image_sizes' => $js_format_sizes,
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
