<?php
/**
 * Add an image.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

/**
 * Class Code
 */
class Image {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {
	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Registers an Avatar Block.
	 */
	public function register_block() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}
		register_block_type(
			'wppp/image',
			array(
				'attributes'      => array(
					'img'         => array(
						'type'    => 'string',
						'default' => 'http://placehold.it/500',
					),
					'transitions' => array(
						'type'    => 'string',
						'default' => '',
					),
					'imgId'       => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'imgSize'     => array(
						'type'    => 'string',
						'default' => 'full',
					),
				),
				'render_callback' => array( $this, 'frontend' ),
			)
		);
	}

	/**
	 * Outputs the block content on the front-end
	 *
	 * @param array $attributes Array of attributes.
	 */
	public function frontend( $attributes ) {
		if ( is_admin() ) {
			return;
		}
	}
}
