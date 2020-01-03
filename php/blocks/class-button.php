<?php
/**
 * Add a button block
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

/**
 * Class Code
 */
class Button extends Block {

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
			'wppp/button',
			array(
				'attributes'      => array(
					'content'         => array(
						'type'    => 'string',
						'default' => '',
					),
					'buttonUrl'       => array(
						'type'    => 'string',
						'default' => '',
					),
					'transitions'     => array(
						'type'    => 'string',
						'default' => '',
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
					'fontSize'        => array(
						'type'    => 'integer',
						'default' => '24',
					),
					'paddingLR'         => array(
						'type'    => 'integer',
						'default' => 20,
					),
					'paddingTB'         => array(
						'type'    => 'integer',
						'default' => 10,
					),
					'borderWidth'     => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'borderColor'     => array(
						'type'    => 'string',
						'default' => '',
					),
					'radius'          => array(
						'type'    => 'integer',
						'default' => 0,
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
		ob_start();
		?>
		<a class="wp-presenter-pro-button button
		<?php
		if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
			echo esc_html( $attributes['transitions'] );
			echo ' ';
			echo 'fragment';
		}
		?>
		" style="color: <?php echo isset( $attributes['textColor'] ) ? esc_html( $attributes['textColor'] ) : 'inherit'; ?>;<?php echo ( isset( $attributes['backgroundColor'] ) ) ? esc_html( 'background-color: ' . $attributes['backgroundColor'] ) . ';' : 'inherit'; ?> padding: <?php echo isset( $attributes['padding'] ) ? absint( $attributes['padding'] ) . 'px' : '0px'; ?>; border-radius: <?php echo isset( $attributes['radius'] ) ? absint( $attributes['radius'] ) . 'px' : '0px'; ?>;
		font-family: <?php echo isset( $attributes['font'] ) ? esc_html( $attributes['font'] ) : esc_html( $this->font_family ); ?>; font-size: <?php echo isset( $attributes['fontSize'] ) ? absint( $attributes['fontSize'] ) . 'px' : absint( $this->sub_title_font_size ) . 'px'; ?>" href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>">
			<?php echo wp_kses_post( $attributes['content'] ); ?>
		</a>
		<?php
		return ob_get_clean();
	}
}
