<?php
/**
 * Add a slide block.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Blocks;

/**
 * Class Slide - Find your power animal.
 */
class Slide {

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
			'wppp/slide',
			array(
				'attributes'      => array(
					'backgroundType'         => array(
						'type'    => 'string',
						'default' => 'background',
					),
					'backgroundVideo'        => array(
						'type'    => 'string',
						'default' => '',
					),
					'backgroundImg'          => array(
						'type'    => 'string',
						'default' => '',
					),
					'backgroundImageOptions' => array(
						'type'    => 'string',
						'default' => 'cover',
					),
					'backgroundColor'        => array(
						'type'    => 'string',
						'default' => '#f3a75b',
					),
					'textColor'              => array(
						'type'    => 'string',
						'default' => '#000000',
					),
					'transition'             => array(
						'type'    => 'string',
						'default' => 'slide',
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
		// Check for co-authors plus multi-authors.
		?>
		<div class="slides" style="background-color: <?php echo esc_html( $attributes['backgroundColor'] ); ?>;" data-transition="<?php echo esc_html( isset( $attributes['transition'] ) ? $attributes['transition'] : '' ); ?>" data-background-color="<?php echo esc_html( isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '' ); ?>">
			<section>
				This is enough.
			</section>
			<section>
				Enough I tell ya!.
			</section>
		</div>
		<?php
		return ob_get_clean();
	}
}
