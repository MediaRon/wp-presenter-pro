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
					'content'                 => array(
						'type'    => 'string',
						'default' => '',
					),
					'titleCapitalization'     => array(
						'type'    => 'boolean',
						'default' => false,
					),
					'padding'                 => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'radius'                  => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'backgroundColor'         => array(
						'type'    => 'string',
						'default' => 'inherit',
					),
					'textColor'               => array(
						'type'    => 'string',
						'default' => '#000000',
					),
					'font'                    => array(
						'type'    => 'string',
						'default' => 'open-sans',
					),
					'fontSize'                => array(
						'type'    => 'integer',
						'default' => '64',
					),
					'transitions'             => array(
						'type'    => 'string',
						'default' => '',
					),
					'opacity'                 => array(
						'type'    => 'number',
						'default' => 1,
					),
					'backgroundGradient'      => array(
						'type'    => 'string',
						'default' => '',
					),
					'backgroundGradientHover' => array(
						'type'    => 'string',
						'default' => '',
					),
					'backgroundType'          => array(
						'type'    => 'string',
						'default' => 'background',
					),
					'quoteStyle'              => array(
						'type'    => 'string',
						'default' => 'none',
					),
					'showAuthor'              => array(
						'type'    => 'boolean',
						'default' => false,
					),
					'author'                  => array(
						'type'    => 'string',
						'default' => '',
					),
					'authorFont'              => array(
						'type'    => 'string',
						'default' => 'open-sans',
					),
					'authorFontSize'          => array(
						'type'    => 'integer',
						'default' => 30,
					),
					'authorImage'             => array(
						'type'    => 'string',
						'default' => 'thumbnail',
					),
					'authorWidth'             => array(
						'type'    => 'integer',
						'default' => 150,
					),
					'authorRadius'            => array(
						'type'    => 'integer',
						'default' => 0,
					),
					'authorColor'         => array(
						'type'    => 'string',
						'default' => 'inherit',
					),
					'blockquoteAlign'         => array(
						'type'    => 'string',
						'default' => '',
					),
					'quoteFont'              => array(
						'type'    => 'string',
						'default' => 'source-sans-pro',
					),
					'quoteFontSize'              => array(
						'type'    => 'integer',
						'default' => 80,
					),
					'quoteColor'              => array(
						'type'    => 'string',
						'default' => inherit,
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
		$gradient = false;
		if ( isset( $attributes['backgroundType'] ) ) {
			if ( 'gradient' === $attributes['backgroundType'] ) {
				$gradient = true;
			}
		}
		ob_start()
		?>
		<div class="wp-presenter-pro-blockquote-wrapper">
			<blockquote class="wp-presenter-pro-blockquote
			<?php
			if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
				echo esc_html( $attributes['transitions'] );
				echo ' ';
				echo 'fragment';
			}
			if ( isset( $attributes['blockquoteAlign'] ) ) {
				echo esc_html( ' ' . $attributes['blockquoteAlign'] );
			}
			if ( isset( $attributes['titleCapitalization'] ) && true === $attributes['titleCapitalization'] ) {
				echo ' slide-blockquote-capitalized';
			}
			$background_hex     = isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : 'inherit';
			$background_opacity = isset( $attributes['opacity'] ) ? $attributes['opacity'] : '1';
			if ( 'inherit' !== $background_hex ) {
				$background_color = wppp_hex2rgba( $background_hex, $background_opacity );
			} else {
				$background_color = $background_hex;
			}
			?>
			" style="color: <?php echo isset( $attributes['textColor'] ) ? esc_html( $attributes['textColor'] ) : '#000000'; ?>; background-image: <?php echo isset( $attributes['backgroundGradient'] ) && $gradient ? esc_html( $attributes['backgroundGradient'] ) : 'inherit'; ?>; background-color: <?php echo esc_html( $background_color ); ?>; padding: <?php echo isset( $attributes['padding'] ) ? absint( $attributes['padding'] ) . 'px' : 0; ?>;
			font-family: <?php echo isset( $attributes['font'] ) ? esc_html( $attributes['font'] ) : esc_html( $this->font_family ); ?>; border-radius: <?php echo isset( $attributes['radius'] ) ? absint( $attributes['radius'] ) . 'px' : '0px'; ?>; font-size: <?php echo isset( $attributes['fontSize'] ) ? absint( $attributes['fontSize'] ) . 'px' : absint( $this->title_font_size ) . 'px'; ?>">
			<?php
			if ( isset( $attributes['quoteStyle'] ) && 'quotes' === $attributes['quoteStyle'] ) {
				$style = sprintf(
					'font-size: %dpx; font-family: %s; color: %s;',
					isset( $attributes['quoteFontSize'] ) ? absint( $attributes['quoteFontSize'] ) : 'inherit',
					isset( $attributes['quoteFont'] ) ? esc_attr( $attributes['quoteFont'] ) : 'inherit',
					isset( $attributes['quoteColor'] ) ? esc_attr( $attributes['quoteColor'] ) : 'inherit'
				);
				?>
				<div class="wp-presenter-top-left-quote" style="<?php echo esc_attr( $style ); ?>">
					&ldquo;
				</div>
				<div class="wp-presenter-bottom-right-quote" style="<?php echo esc_attr( $style ); ?>">
					&rdquo;
				</div>
				<?php
			}
			?>
			<?php echo wp_kses_post( $attributes['content'] ); ?>
			</blockquote>
			<?php
			if ( isset( $attributes['showAuthor'] ) && $attributes['showAuthor'] && isset( $attributes['author'] ) ) {
				?>
				<div class="wp-presenter-pro-blockquote-author" style="color: <?php echo isset( $attributes['authorColor'] ) ? esc_html( $attributes['authorColor'] ) : 'inherit'; ?>; 
			font-family: <?php echo isset( $attributes['authorFont'] ) ? esc_html( $attributes['authorFont'] ) : esc_html( $this->font_family ); ?>; font-size: <?php echo isset( $attributes['authorFontSize'] ) ? absint( $attributes['authorFontSize'] ) . 'px' : absint( $this->title_font_size ) . 'px'; ?>">
					<?php echo wp_kses_post( $attributes['author'] ); ?>
				</div>
				<?php
			}
		echo '</div>';
		return ob_get_clean();
	}
}
