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
	wp_print_styles( array( 'wp-presenter-display-theme', 'wp-presenter-pro-front-end-css', 'wp-presenter-core' ) );
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
		'meta_key'       => '_reorder_term_presentations_' . $wppp_term->slug, // phpcs:ignore
		'posts_per_page' => 100, // number of slides max.
	);
	$posts = get_posts( $query ); // phpcs:ignore
	if ( ! empty( $posts ) ) {
		foreach( $posts as $post ) { // phpcs:ignore
			$blocks = parse_blocks( $post->post_content );
			wp_presenter_pro_render_blocks( $blocks );
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
		} );
		</script>
</body>
</html>
