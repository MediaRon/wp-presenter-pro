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
		?>
		<div class="slides" style="background-color: <?php echo esc_html( $attributes['backgroundColor'] ); ?>;" data-transition="<?php echo esc_html( isset( $attributes['transition'] ) ? $attributes['transition'] : '' ); ?>" data-background-color="<?php echo esc_html( isset( $attributes['backgroundColor'] ) ? $attributes['backgroundColor'] : '' ); ?>">
			<section>
				This is enough.
			</section>
			<section>
				Enough I tell ya!.
			</section>
		</div>
		<script>
		// Full list of configuration options available here:
		// https://github.com/hakimel/reveal.js#configuration
			Reveal.initialize( {
								width : '100%',
								height : '100%',
								margin :                 <?php if ( '' == get_theme_mod( 'margin' ) ) {
				echo 0.1;
			} else {
				echo $margin;
			} ?>,
								minScale :               <?php if ( '' == get_theme_mod( 'minscale' ) ) {
				echo 0.2;
			} else {
				echo $min_scale;
			} ?>,
								maxScale :               <?php if ( '' == get_theme_mod( 'maxscale' ) ) {
				echo 1.5;
			} else {
				echo $max_scale;
			} ?>,
								controls :               <?php if ( get_theme_mod( 'controls_right_corner' ) ) {
				echo $controls;
			} else {
				echo 'true';
			} ?>,
								progress :               <?php if ( '' == get_theme_mod( 'progress' ) ) {
				echo 'true';
			} else {
				echo $progress;
			} ?>,
								slideNumber :            <?php if ( '' == get_theme_mod( 'number' ) ) {
				echo 'false';
			} else {
				echo $slide_number;
			} ?>,
								history :                <?php if ( '' == get_theme_mod( 'history' ) ) {
				echo 'false';
			} else {
				echo $history;
			} ?>,
								keyboard :               <?php if ( '' == get_theme_mod( 'keyboard_shortcuts' ) ) {
				echo 'true';
			} else {
				echo $keyboard;
			} ?>,
								overview :               <?php if ( '' == get_theme_mod( 'overview' ) ) {
				echo 'false';
			} else {
				echo $overview;
			} ?>,
								center :                 <?php if ( '' == get_theme_mod( 'center' ) ) {
				echo 'true';
			} else {
				echo $center;
			} ?>,
								touch :                  <?php if ( '' == get_theme_mod( 'touch' ) ) {
				echo 'true';
			} else {
				echo 'true';
			} ?>,
								loop :                   <?php if ( '' == get_theme_mod( 'loop_presentation' ) ) {
				echo 'false';
			} else {
				echo $loop;
			}?>,
								rtl :                    <?php if ( '' == get_theme_mod( 'rtl' ) ) {
				echo 'false';
			} else {
				echo $rtl;
			} ?>,
								embedded :               <?php if ( '' == get_theme_mod( 'embedded' ) ) {
				echo 'false';
			} else {
				echo $embedded;
			} ?>,
								help :                   <?php if ( '' == get_theme_mod( 'help' ) ) {
				echo 'true';
			} else {
				echo $help;
			} ?>,
								mouseWheel :             <?php if ( '' == get_theme_mod( 'mousewheel_navigation' ) ) {
				echo 'false';
			} else {
				echo $mouse;
			} ?>,
								hideAddressBar :         <?php if ( '' == get_theme_mod( 'hide_address_bar' ) ) {
				echo 'true';
			} else {
				echo $hide_address_bar;
			} ?>,
								previewLinks :           <?php if ( '' == get_theme_mod( 'preview_links' ) ) {
				echo 'false';
			} else {
				echo $preview_links;
			} ?>,
								transition :             <?php if ( '' == get_theme_mod( 'transitions' ) ) {
				echo '"default"';
			} else {
				echo '"' . $transition . '"';
			} ?>,
								transitionSpeed :        <?php if ( '' == get_theme_mod( 'transition_speed' ) ) {
				echo '"slow"';
			} else {
				echo '"' . $transition_speed . '"';
			} ?>,
								backgroundTransition :   <?php if ( '' == get_theme_mod( 'bkg_transitions' ) ) {
				echo '"default"';
			} else {
				echo '"' . $bkg_transition . '"';
			} ?>,
								viewDistance :           <?php if ( '' == get_theme_mod( 'view_distance' ) ) {
				echo '3';
			} else {
				echo $view_distance;
			} ?>,

								// Optional libraries used to extend on reveal.js
								dependencies : [
									<?php
									echo implode( ",\n", apply_filters( 'reveal_default_dependencies', array(
										'classList' => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/lib/js/classList.js', condition: function() { return !document.body.classList; } }",
										'highlight' => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } }",
										'zoom'      => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } }",
										'notes'     => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }",
									) ) );
									?>
								]
							} );
		</script>
		<?php
		return ob_get_clean();
	}
}
