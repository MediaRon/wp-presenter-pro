<?php
/**
 * Add a list item block.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

/**
 * Class Admin
 */
class List_Item {

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
			'wppp/list-item',
			array(
				'attributes'      => array(
					'content'         => array(
						'type'    => 'string',
						'default' => '',
					),
					'padding'         => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'radius'          => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'backgroundColor' => array(
						'type'    => 'string',
						'default' => 'inherit',
					),
					'textColor'       => array(
						'type'    => 'string',
						'default' => '#000000',
					),
					'font'            => array(
						'type'    => 'string',
						'default' => 'open-sans',
					),
					'transitions'     => array(
						'type'    => 'string',
						'default' => '',
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
