<?php
/**
 * Add a note block.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

/**
 * Class Show Notes
 */
class Show_Notes extends Block {

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
			'wppp/show-notes',
			array(
				'attributes'      => array(
					'notes'     => array(
						'type'    => 'string',
						'default' => '',
					),
					'listitems' => array(
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
		ob_start();
		?>
		<aside class="notes">
			<?php echo '<ul>' . wp_kses_post( $attributes['notes'] ) . '</ul>'; ?>
			<?php if ( isset( $attributes['listitems'] ) ) : ?>
				<?php echo '<ul>' . wp_kses_post( $attributes['listitems'] ) . '</ul>'; ?>
			<?php endif; ?>
		</aside>
		<?php
		return ob_get_clean();
	}
}
