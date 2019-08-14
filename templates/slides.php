<?php
/**
 * Output slide content for single slide.
 *
 * @package   WP_Presenter_Pro
 */

wp_enqueue_script( 'wp-presenter-head-js', WP_PRESENTER_PRO_URL . '/assets/reveal/lib/js/head.min.js', array(), WP_PRESENTER_PRO_VERSION, false );
wp_enqueue_script( 'wp-presenter-classlist', WP_PRESENTER_PRO_URL . '/assets/reveal/lib/js/classList.js', array(), WP_PRESENTER_PRO_VERSION, false );
wp_enqueue_script( 'wp-presenter-core-js', WP_PRESENTER_PRO_URL . '/assets/reveal/js/reveal.js', array( 'wp-presenter-classlist' ), WP_PRESENTER_PRO_VERSION, false );
wp_enqueue_script( 'html5shiv', '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js', array(), '3.7.2', false );
wp_enqueue_style( 'wp-presenter-core', WP_PRESENTER_PRO_URL . '/assets/reveal/css/reveal.css', array(), WP_PRESENTER_PRO_VERSION, 'all' );
wp_enqueue_style( 'wp-presenter-monokai', WP_PRESENTER_PRO_URL . '/assets/reveal/lib/css/monokai.css', array(), WP_PRESENTER_PRO_VERSION, 'all' );
wp_enqueue_style(
	'wp-presenter-pro-front-end-css', // Handle.
	WP_PRESENTER_PRO_URL . 'dist/blocks.style.build.css',
	array( 'wp-editor' ),
	WP_PRESENTER_PRO_VERSION,
	'all'
);

$theme = get_theme_mod( 'select_theme' );
if ( $theme ) :
	wp_enqueue_style( 'wp-presenter-display-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/' . $theme . '.css', array(), WP_PRESENTER_PRO_VERSION );
else :
	wp_enqueue_style( 'wp-presenter-default-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/black.css', array(), WP_PRESENTER_PRO_VERSION );
endif;
?>
<?php
/**
 * The template for displaying the header.
 *
 * @package WP Presenter
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title><?php wp_title( '', true, 'right' ); ?></title>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	wp_print_scripts( array( 'wp-presenter-head-js', 'wp-presenter-classlist', 'wp-presenter-core-js', 'html5shiv' ) );
	wp_print_styles( array( 'wp-presenter-default-theme', 'wp-presenter-pro-front-end-css' ) );
	?>

</head>
<body>
<div class="reveal">
	<div class="slides">
	<?php
	$query = array(
		'orderby'        => 'meta_value_num title',
		'order'          => 'ASC',
		'post_status'    => 'publish',
		'post_type'      => 'wppp',
		'meta_key'       => '_reorder_term_presentations_wordcamp-mental-health-2019',
		'posts_per_page' => 100, // number of slides max
	);
	$posts = get_posts( $query ); // phpcs:ignore
	if ( ! empty( $posts ) ) {
		foreach( $posts as $post ) { // phpcs:ignore
			$blocks = parse_blocks( $post->post_content );
			foreach ( $blocks as $index => $block_info ) {
				?>
				<section data-background="<?php echo esc_attr( isset( $block_info['attrs']['backgroundColor'] ) ? $block_info['attrs']['backgroundColor'] : '' ); ?>">
					<?php
					foreach ( $block_info['innerBlocks'] as $block_slug => $inner_data ) {
						$attributes = $inner_data['attrs'];
						switch ( $block_slug ) {
							case 'wppp/slide-title':
								?>
								<div class="wp-presenter-pro-slide-title
								<?php
								if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
									echo esc_html( $attributes['transitions'] );
									echo 'fragment';
								}
								?>
								" style="color: <?php echo esc_html( $attributes['textColor'] ); ?>;<?php echo ( isset( $attributes['backgroundColor'] ) ) ? esc_html( 'background-color: ' . $attributes['backgroundColor'] ) . ';' : ''; ?> padding: <?php echo absint( $attributes['padding'] ); ?>px;
								font-family: <?php echo absint( $attributes['padding'] ); ?>px;">
								<?php echo wp_kses_post( $attributes['title'] ); ?>
								</div>
								<?php
								break;
						}
					}
					?>
				</section>
				<?php
			}
		}
	}
	?>
</div>
<?php
do_action( 'wp_footer' );
?>
<script>
		// Full list of configuration options available here:
		// https://github.com/hakimel/reveal.js#configuration
			Reveal.initialize( {
								width : '1920',
								height : '1080',
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
				echo 'true';
			} else {
				echo $slide_number;
			} ?>,
								history :                <?php if ( '' == get_theme_mod( 'history' ) ) {
				echo 'true';
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
				echo 'true';
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
				echo 'true';
			} else {
				echo $mouse;
			} ?>,
								hideAddressBar :         <?php if ( '' == get_theme_mod( 'hide_address_bar' ) ) {
				echo 'true';
			} else {
				echo 'true';
			} ?>,
								previewLinks :           <?php if ( '' == get_theme_mod( 'preview_links' ) ) {
				echo 'false';
			} else {
				echo $preview_links;
			} ?>,
								transition :             <?php if ( '' == get_theme_mod( 'transitions' ) ) {
				echo '"default"';
			} else {
				echo 'zoom';
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
</body>
</html>
