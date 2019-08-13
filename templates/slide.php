<?php
/**
 * Output slide content for single slide.
 *
 * @package   WP_Presenter_Pro
 */

wp_enqueue_script( 'wp-presenter-head-js', WP_PRESENTER_PRO_URL . '/assets/reveal/lib/js/head.min.js', array(), WP_PRESENTER_PRO_VERSION, true );
wp_enqueue_script( 'wp-presenter-core-js', WP_PRESENTER_PRO_URL . '/assets/reveal/js/reveal.js', array(), WP_PRESENTER_PRO_VERSION, true );
wp_enqueue_script( 'html5shiv', '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js', array(), '3.7.2', false );
wp_enqueue_style( 'wp-presenter-core', WP_PRESENTER_PRO_URL . '/assets/reveal/css/reveal.css', array(), WP_PRESENTER_PRO_VERSION, 'all' );
wp_enqueue_style( 'wp-presenter-monokai', WP_PRESENTER_PRO_URL . '/assets/reveal/lib/css/monokai.css', array(), WP_PRESENTER_PRO_VERSION );

$theme = get_theme_mod( 'select_theme' );
if ( $theme ) :
	wp_enqueue_style( 'wp-presenter-display-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/' . $theme . '.css', array(), WP_PRESENTER_PRO_VERSION );
else :
	wp_enqueue_style( 'wp-presenter-default-theme', WP_PRESENTER_PRO_URL . '/assets/reveal/css/theme/sky.css', array(), WP_PRESENTER_PRO_VERSION );
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
			the_content();
		}
	}
	?>
</div>
<?php
do_action( 'wp_footer' );
