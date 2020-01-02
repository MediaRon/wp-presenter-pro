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
		$pro_fonts = array(
			'bubblebum'       => _x( 'Bubblegum', 'Font Name', 'wp-presenter-pro' ),
			'dosis'           => _x( 'Dosis', 'Font Name', 'wp-presenter-pro' ),
			'encode'          => _x( 'Encode', 'Font Name', 'wp-presenter-pro' ),
			'lato'            => _x( 'Lato', 'Font Name', 'wp-presenter-pro' ),
			'league'          => _x( 'League', 'Font Name', 'wp-presenter-pro' ),
			'merriweather'    => _x( 'Merriweather', 'Font Name', 'wp-presenter-pro' ),
			'montserrat'      => _x( 'Monstserrat', 'Font Name', 'wp-presenter-pro' ),
			'news-cycle'      => _x( 'News Cycle', 'Font Name', 'wp-presenter-pro' ),
			'open-sans'       => _x( 'Libre Baskerville', 'Font Name', 'wp-presenter-pro' ),
			'quicksand'       => _x( 'Quicksand', 'Font Name', 'wp-presenter-pro' ),
			'sinkins-sans'    => _x( 'Sinkins Sans', 'Font Name', 'wp-presenter-pro' ),
			'source-sans-pro' => _x( 'Source Sans Pro', 'Font Name', 'wp-presenter-pro' ),
			'ubuntu'          => _x( 'Ubuntu', 'Font Name', 'wp-presenter-pro' ),
		);

		// Add Typekit Fonts.
		if ( defined( 'CUSTOM_TYPEKIT_FONTS_FILE' ) ) {
			$fonts = get_option( 'custom-typekit-fonts', array() );
			if ( isset( $fonts['custom-typekit-font-details'] ) ) {
				foreach ( $fonts['custom-typekit-font-details'] as $font_name => $font_details ) {
					$pro_fonts[ $font_details['slug'] ] = $font_details['family'];
				}
			}
		}

		// Allowing others to add fonts.
		$pro_fonts = apply_filters( 'wp_presenter_pro_fonts', $pro_fonts );
		wp_localize_script(
			'wp-presenter-pro-js',
			'wp_presenter_pro',
			array(
				'rest_url'    => get_rest_url(),
				'rest_nonce'  => wp_create_nonce( 'wp_rest' ),
				'image_sizes' => $js_format_sizes,
				'mathjax'     => WP_PRESENTER_PRO_URL . 'js/mathjax.js',
				'fonts'       => $pro_fonts,
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
