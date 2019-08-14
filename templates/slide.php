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

$theme = get_theme_mod( 'select_theme' );
if ( $theme ) :
	wp_enqueue_style( 'wp-presenter-display-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/' . $theme . '.css', array(), WP_PRESENTER_PRO_VERSION );
else :
	wp_enqueue_style( 'wp-presenter-default-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/moon.css', array(), WP_PRESENTER_PRO_VERSION );
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
	<?php do_action( 'wp_head' ); ?>

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
			foreach ( $blocks as $index => $block_info ) {
				$slide_background = $block_info['attrs']['backgroundColor'];
				$slide_video      = '';
				if ( 'image' === $block_info['attrs']['backgroundType'] ) {
					$slide_background = $block_info['attrs']['backgroundImg'];
				}
				if ( 'video' === $block_info['attrs']['backgroundType'] ) {
					$slide_video = $block_info['attrs']['backgroundVideo'];
				}
				?>
				<section data-background-video="<?php echo esc_url( $slide_video ); ?>" data-background="<?php echo esc_html( $slide_background ); ?>" data-background-transition="<?php echo esc_attr( isset( $block_info['attrs']['backgroundTransition'] ) ? $block_info['attrs']['backgroundTransition'] : 'none' ); ?>">
					<?php
					foreach ( $block_info['innerBlocks'] as $index => $inner_data ) {
						if ( is_array( $inner_data ) ) {
							$attributes = $inner_data['attrs'];
							switch ( $inner_data['blockName'] ) {
								case 'wppp/slide-title':
									?>
									<div class="wp-presenter-pro-slide-title
									<?php
									if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
										echo esc_html( $attributes['transitions'] );
										echo ' ';
										echo 'fragment';
									}
									if ( isset( $attributes['titleCapitalization'] ) && true === $attributes['titleCapitalization'] ) {
										echo ' slide-title-capitalized';
									}
									?>
									" style="color: <?php echo esc_html( $attributes['textColor'] ); ?>;background-color: <?php echo isset( $attributes['backgroundColor'] ) ? esc_html( $attributes['backgroundColor'] ) : 'inherit'; ?>; padding: <?php echo absint( $attributes['padding'] ); ?>px;
									font-family: <?php echo esc_html( $attributes['font'] ); ?>;">
									<?php echo wp_kses_post( $attributes['title'] ); ?>
									</div>
									<?php
									break;
								case 'wppp/list-item':
									?>
									<div class="wp-presenter-pro-list-item
									<?php
									if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
										echo esc_html( $attributes['transitions'] );
										echo ' ';
										echo 'fragment';
									}
									?>
									" style="color: <?php echo esc_html( $attributes['textColor'] ); ?>;background-color: <?php echo esc_html( $attributes['backgroundColor'] ); ?>; padding: <?php echo absint( $attributes['padding'] ); ?>px;
									font-family: <?php echo esc_html( $attributes['font'] ); ?>;">
									<?php echo wp_kses_post( $attributes['content'] ); ?>
									</div>
									<?php
									break;
								case 'wppp/image':
									?>
									<div class="wp-presenter-pro-image
									<?php
									if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
										echo esc_html( $attributes['transitions'] );
										echo ' ';
										echo 'fragment';
									}
									?>
									">
									<?php
										echo wp_get_attachment_image( $attributes['imgId'], $attributes['imgSize'] );
									?>
									</div>
									<?php
									break;
								case 'wppp/text-box':
									?>
									<div class="wp-presenter-pro-text-box
									<?php
									if ( isset( $attributes['transitions'] ) && '' !== $attributes['transitions'] && 'none' !== $attributes['transitions'] ) {
										echo esc_html( $attributes['transitions'] );
										echo ' ';
										echo 'fragment';
									}
									?>
									" style="color: <?php echo esc_html( $attributes['textColor'] ); ?>;<?php echo ( isset( $attributes['backgroundColor'] ) ) ? esc_html( 'background-color: ' . $attributes['backgroundColor'] ) . ';' : ''; ?> padding: <?php echo absint( $attributes['padding'] ); ?>px;
									font-family: <?php echo esc_html( $attributes['font'] ); ?>px;">
									<?php echo wp_kses_post( $attributes['title'] ); ?>
									</div>
									<?php
									break;
								case 'wppp/code':
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
									</div>
									<?php
									break;
							}
						}
					}
					?>
				</section>
				<?php
			}
			?>
			</section>
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
