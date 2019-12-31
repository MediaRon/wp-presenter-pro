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
$wppp_term = get_queried_object();
$theme     = function_exists( 'get_field' ) ? get_field( 'theme', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'black';
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
/*Reveal.initialize( {
			width : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'width', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : '1920' ); ?>,
			height : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'height', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : '1920' ); ?>,
			margin : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'margin', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : '0.1' ); ?>,
			minScale : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'min_scale', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : '0.2' ); ?>,
			maxScale : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'max_scale', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : '1.5' ); ?>,
			controls : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'display_controls', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'true' ); ?>,
			progress : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'progress_bar', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'true' ); ?>,
			slideNumber : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'slide_number', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'true' ); ?>,
			history : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'push_history', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'false' ); ?>,
			keyboard : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'keyboard_shortcuts', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'true' ); ?>,
			overview : false,
			center : true,
			touch : true,
			loop :<?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'loop', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'true' ); ?>,
			rtl : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'right_to_left', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'true' ); ?>,
			embedded : false,
			mouseWheel : <?php echo esc_html( function_exists( 'get_field' ) ? get_field( 'mouse_wheel_navigation', $wppp_term->taxonomy . '_' . $wppp_term->term_id ) : 'false' ); ?>,
			hideAddressBar : true,
			previewLinks : false,

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
		} );*/
		Reveal.initialize( {
				width : '960',
				height : '700',
				margin : '0.1',
				minScale : '0.2',
				maxScale : '1.5',
				controls : false,
				progress : false,
				slideNumber : false,
				overview : false,
				center : true,
				touch : true,
				mouseWheel: true,
				hideAddressBar: true,
				embedded : false,
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
