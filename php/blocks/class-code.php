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
class Code extends Block {

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
			'wppp/code',
			array(
				'attributes'      => array(
					'content'     => array(
						'type'    => 'string',
						'default' => '',
					),
					'transitions' => array(
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
		<div class="wp-presenter-pro-code-editor
		<?php
		if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
			echo esc_html( $attributes['transitions'] );
			echo ' ';
			echo 'fragment';
		}
		?>
		">
<pre><code data-trim data-noescape data-line-numbers>
<?php echo esc_html( $attributes['content'] ); // phpcs:ignore ?>
</code></pre>
		<?php
		return ob_get_clean();
	}
}
