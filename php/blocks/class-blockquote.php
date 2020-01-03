<?php
/**
 * Add a code.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

/**
 * Class Code
 */
class BlockQuote extends Block {

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
			'wppp/blockquote',
			array(
				'attributes'      => array(
					'content'             => array(
						'type'    => 'string',
						'default' => '',
					),
					'titleCapitalization' => array(
						'type'    => 'boolean',
						'default' => false,
					),
					'padding'             => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'radius'              => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'backgroundColor'     => array(
						'type'    => 'string',
						'default' => 'inherit',
					),
					'textColor'           => array(
						'type'    => 'string',
						'default' => '#000000',
					),
					'font'                => array(
						'type'    => 'string',
						'default' => 'open-sans',
					),
					'fontSize'            => array(
						'type'    => 'integer',
						'default' => '64',
					),
					'transitions'         => array(
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
		ob_start()
		?>
		<blockquote class="wp-presenter-pro-slide-title
		<?php
		if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
			echo esc_html( $attributes['transitions'] );
			echo ' ';
			echo 'fragment';
		}
		if ( isset( $attributes['titleCapitalization'] ) && true === $attributes['titleCapitalization'] ) {
			echo ' slide-title-capitalized';
		}
		?>
		" style="color: <?php echo isset( $attributes['textColor'] ) ? esc_html( $attributes['textColor'] ) : '#000000'; ?>; background-color: <?php echo isset( $attributes['backgroundColor'] ) ? esc_html( $attributes['backgroundColor'] ) : 'inherit'; ?>; padding: <?php echo isset( $attributes['padding'] ) ? absint( $attributes['padding'] ) . 'px' : 0; ?>;
		font-family: <?php echo isset( $attributes['font'] ) ? esc_html( $attributes['font'] ) : esc_html( $this->font_family ); ?>; border-radius: <?php echo isset( $attributes['radius'] ) ? absint( $attributes['radius'] ) . 'px' : '0px'; ?>; font-size: <?php echo isset( $attributes['fontSize'] ) ? absint( $attributes['fontSize'] ) . 'px' : absint( $this->title_font_size ) . 'px'; ?>">
		<?php echo wp_kses_post( $attributes['content'] ); ?>
		</blockquote>
		<?php
		return ob_get_clean();
	}
}
