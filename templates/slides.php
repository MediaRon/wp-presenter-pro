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
$wppp_id     = get_queried_object_id();
$maybe_theme = get_post_meta( $wppp_id, 'slides-theme', true );
$theme       = $maybe_theme ? $maybe_theme : 'black';
wp_enqueue_style( 'wp-presenter-display-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/' . $theme . '.css', array(), WP_PRESENTER_PRO_VERSION );
add_filter( 'show_admin_bar', '__return_false' );
?>
<?php
/**
 * The template for displaying the header.
 *
 * @package WP Presenter
 */
?>
<!DOCTYPE html>
<html lang="en" style="margin: 0 !important;">
<head>
	<meta charset="utf-8">

	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	do_action( 'wp_head' );
	?>

</head>
<body>
<div class="reveal">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			global $post;
			the_post();
			?>
			<div class="slides">
			<?php
			$blocks = parse_blocks( $post->post_content );
			wp_presenter_pro_render_blocks( $blocks );
			?>
			</div>
			<?php
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
			width : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-slide-width', true ) ? get_post_meta( $wppp_id, 'slides-slide-width', true ) : '960' ); ?>,
			height : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-slide-height', true ) ? get_post_meta( $wppp_id, 'slides-slide-height', true ) : '700' ); ?>,
			margin : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-slide-margin', true ) ? get_post_meta( $wppp_id, 'slides-slide-margin', true ) : '0.1' ); ?>,
			maxScale : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-max-scale', true ) ? get_post_meta( $wppp_id, 'slides-max-scale', true ) : '1.5' ); ?>,
			minScale : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-min-scale', true ) ? get_post_meta( $wppp_id, 'slides-min-scale', true ) : '0.2' ); ?>,
			controls : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-display-controls', true ) ? get_post_meta( $wppp_id, 'slides-display-controls', true ) : 'true' ); ?>,
			progress : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-progress-bar', true ) ? get_post_meta( $wppp_id, 'slides-progress-bar', true ) : 'true' ); ?>,
			slideNumber : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-slide-number', true ) ? get_post_meta( $wppp_id, 'slides-slide-number', true ) : 'false' ); ?>,
			history : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-push-history', true ) ? get_post_meta( $wppp_id, 'slides-push-history', true ) : 'true' ); ?>,
			keyboard : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-keyboard-shortcuts', true ) ? get_post_meta( $wppp_id, 'slides-keyboard-shortcuts', true ) : 'true' ); ?>,
			overview : false,
			center : true,
			touch : true,
			loop :<?php echo esc_html( get_post_meta( $wppp_id, 'slides-loop-slides', true ) ? get_post_meta( $wppp_id, 'slides-loop-slides', true ) : 'false' ); ?>,
			rtl : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-right-to-left', true ) ? get_post_meta( $wppp_id, 'slides-right-to-left', true ) : 'false' ); ?>,
			embedded : false,
			mouseWheel : <?php echo esc_html( get_post_meta( $wppp_id, 'slides-mouse-wheel-navigation', true ) ? get_post_meta( $wppp_id, 'slides-mouse-wheel-navigation', true ) : 'true' ); ?>,
			hideAddressBar : true,
			previewLinks : true,

			// Optional libraries used to extend on reveal.js
			dependencies : [
				<?php
				echo implode( ",\n", apply_filters( 'reveal_default_dependencies', array( // phpcs:ignore
					'classList' => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/lib/js/classList.js', condition: function() { return !document.body.classList; } }",
					'highlight' => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } }",
					'zoom'      => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } }",
					'notes'     => "{ src: '" . WP_PRESENTER_PRO_URL . "/assets/reveal/plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }",
				) ) ); // phpcs:ignore
				?>
			]
		} );
		</script>
		<?php
		do_action( 'wp_footer' );
		?>
</body>
</html>
