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

wp_enqueue_style( 'wp-presenter-display-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/black.css', array(), WP_PRESENTER_PRO_VERSION );
wp_enqueue_style(
	'wp-presenter-pro-front-end-css', // Handle.
	WP_PRESENTER_PRO_URL . 'dist/blocks.style.build.css',
	array( 'wp-editor' ),
	WP_PRESENTER_PRO_VERSION,
	'all'
);
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
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
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
<script>
		// Full list of configuration options available here:
		// https://github.com/hakimel/reveal.js#configuration
			Reveal.initialize( {
				width : '1920',
				height : '1080',
				margin : 0.1,
				minScale : 0.2,
				maxScale : 1.5,
				controls : false,
				progress : false,
				slideNumber : false,
				center: true,
				mouseWheel: true,
				hideAddressBar: true,
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
