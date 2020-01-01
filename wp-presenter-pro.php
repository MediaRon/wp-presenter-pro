<?php
/**
 * WP Presenter Pro
 *
 * @package   WP_Presenter_Pro
 * @copyright Copyright(c) 2019, MediaRon LLC
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 *
 * Plugin Name: WP Presenter Pro
 * Plugin URI: https://mediaron.com/downloads/wp-presenter-pro/
 * Description: A plugin for allowing you to do presentations using WordPress.
 * Version: 2.0.0
 * Author: MediaRon LLC
 * Author URI: https://mediaron.com
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-presenter-pro
 * Domain Path: languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'WP_PRESENTER_PRO_VERSION', '2.0.0' );
define( 'WP_PRESENTER_PRO_PLUGIN_NAME', 'WP Presenter Pro' );
define( 'WP_PRESENTER_PRO_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_PRESENTER_PRO_URL', plugins_url( '/', __FILE__ ) );
define( 'WP_PRESENTER_PRO_SLUG', plugin_basename( __FILE__ ) );
define( 'WP_PRESENTER_PRO_FILE', __FILE__ );

register_activation_hook( __FILE__, 'wp_presenter_pro_plugin_activation' );
/**
 * Set an option for rewrite flush rules.
 */
function wp_presenter_pro_plugin_activation() {
	update_option( 'wp_presenter_pro_permalinks_flushed', 0 );
}

// Setup the plugin auto loader.
require_once 'php/autoloader.php';

/**
 * Admin notice for incompatible versions of PHP.
 */
function wp_presenter_pro_php_version_error() {
	printf( '<div class="error"><p>%s</p></div>', esc_html( wp_presenter_pro_php_version_text() ) );
}


/**
 * String describing the minimum PHP version.
 *
 * "Namespace" is a PHP 5.3 introduced feature. This is a hard requirement
 * for the plugin structure.
 *
 * @return string
 */
function wp_presenter_pro_php_version_text() {
	return __( 'WP Presenter Pro plugin error: Your version of PHP is too old to run this plugin. You must be running PHP 5.4 or higher.', 'wp-presenter-pro' );
}

// If the PHP version is too low, show warning and return.
if ( version_compare( phpversion(), '5.4', '<' ) ) {
	add_action( 'admin_notices', 'wp_presenter_pro_php_version_error' );
	return;
}

/**
 * Get the plugin object.
 *
 * @return \WP_Presenter_Pro\Plugin
 */
function wp_presenter_pro() {
	static $instance;

	if ( null === $instance ) {
		$instance = new \WP_Presenter_Pro\Plugin();
	}

	return $instance;
}

/**
 * Setup the plugin instance.
 */
wp_presenter_pro()
	->set_basename( plugin_basename( __FILE__ ) )
	->set_directory( plugin_dir_path( __FILE__ ) )
	->set_file( __FILE__ )
	->set_slug( 'wp-presenter-pro' )
	->set_url( plugin_dir_url( __FILE__ ) )
	->set_version( __FILE__ );

/**
 * Sometimes we need to do some things after the plugin is loaded, so call the Plugin_Interface::plugin_loaded().
 */
add_action( 'plugins_loaded', array( wp_presenter_pro(), 'plugin_loaded' ), 20 );
add_action( 'init', 'wp_presenter_pro_add_i18n' );

/**
 * Add i18n to User Profile Picture Enhanced.
 */
function wp_presenter_pro_add_i18n() {
	load_plugin_textdomain( 'wp-presenter-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Render a block for a single slide or group of slides.
 *
 * @param array $blocks The blocks for a slide.
 */
function wp_presenter_pro_render_blocks( $blocks ) {

	// Get vertical slides.
	$vertical_slides = array();
	$previous_block  = '';
	foreach ( $blocks as $index => $block_info ) {
		if ( 'wppp/slide' === $block_info['blockName'] ) {
			$block_count = count( $blocks );
			for ( $i = 0; $i < $block_count; $i++ ) {
				if ( isset( $blocks[ $index + $i ] ) && 'wppp/vertical-slide' === $blocks[ $index + $i ]['blockName'] ) {
					$vertical_slides[ $index ][] = $blocks[ $index + $i ];
					continue;
				} elseif ( ! isset( $blocks[ $index + $i ] ) ) {
					break;
				} elseif ( isset( $blocks[ $index + $i ] ) && 'wppp/slide' === $blocks[ $index + $i ]['blockName'] && 0 !== $i ) {
					break;
				}
			}
		}
	}
	// Get regular slide.
	foreach ( $blocks as $index => $block_info ) {
		if ( 'wppp/slide' === $block_info['blockName'] ) {
			$default_font               = 'open-sans';
			$default_text_box_font_size = '32';
			$default_title_font_size    = '64';
			$slide_background           = isset( $block_info['attrs']['backgroundColor'] ) ? $block_info['attrs']['backgroundColor'] : '#f3a75b';
			$slide_video                = false;
			$slide_iframe               = false;


			if ( isset( $block_info['attrs']['backgroundType'] ) ) {
				$slide_background = '#f3a75b';
				if ( 'image' === $block_info['attrs']['backgroundType'] ) {
					$slide_background = $block_info['attrs']['backgroundImg'];
				}
				if ( 'video' === $block_info['attrs']['backgroundType'] ) {
					$slide_video = $block_info['attrs']['backgroundVideo'];
				}
				if ( 'iframe' === $block_info['attrs']['backgroundType'] ) {
					$slide_iframe = $block_info['attrs']['iframeUrl'];
				}
			}
			?>
			<section>
			<section <?php echo false !== $slide_video ? 'data-background-video="' . esc_url( $slide_video ) . '"' : ''; ?> <?php echo false !== $slide_iframe ? 'data-background-iframe="' . esc_url( $slide_iframe ) . '"' : ''; ?> data-background="<?php echo esc_html( $slide_background ); ?>" data-background-transition="<?php echo esc_attr( isset( $block_info['attrs']['backgroundTransition'] ) ? $block_info['attrs']['backgroundTransition'] : 'none' ); ?>" data-background-video-loop data-background-video-muted>
				<?php
				foreach ( $block_info['innerBlocks'] as $inner_data ) {
					if ( is_array( $inner_data ) ) {
						$attributes = $inner_data['attrs'];
						switch ( $inner_data['blockName'] ) {
							case 'wppp/transition':
								?>
								<div class="wp-presenter-pro-slide-transition-block
								<?php
								if ( isset( $attributes['transition'] ) && '' !== $attributes['transition'] && 'none' !== $attributes['transition'] ) {
									echo esc_html( $attributes['transition'] );
									echo ' ';
									echo 'fragment';
								}
								?>
								">
								<?php
								if ( isset( $inner_data['innerBlocks'] ) ) {
									foreach ( $inner_data['innerBlocks'] as $block ) {
										echo render_block( $block ); // phpcs:ignore
									}
								}
								?>
								</div>
								<?php
								break;
							default:
								echo render_block( $inner_data ); // phpcs:ignore
								break;
						}
					}
				}
				echo '</section>';
				if ( ! empty( $vertical_slides ) ) {
					foreach ( $vertical_slides[ $index ] as $block ) {
						wp_presenter_pro_render_vertical_slide_blocks( $block );
					}
				}
				?>
				</section>
				<?php
		}
	}
}

/**
 * Render a Vertical Slide.
 *
 * @param array $blocks The blocks for a slide.
 */
function wp_presenter_pro_render_vertical_slide_blocks( $blocks ) {
	$default_font               = 'open-sans';
	$default_text_box_font_size = '32';
	$default_title_font_size    = '64';
	$slide_background           = isset( $blocks['attrs']['backgroundColor'] ) ? $blocks['attrs']['backgroundColor'] : '#f3a75b';
	$slide_video                = false;
	$slide_iframe               = false;

	if ( isset( $blocks['attrs']['backgroundType'] ) ) {
		$slide_background = '#f3a75b';
		if ( 'image' === $blocks['attrs']['backgroundType'] ) {
			$slide_background = $blocks['attrs']['backgroundImg'];
		}
		if ( 'video' === $blocks['attrs']['backgroundType'] ) {
			$slide_video = $blocks['attrs']['backgroundVideo'];
		}
		if ( 'iframe' === $blocks['attrs']['backgroundType'] ) {
			$slide_iframe = $blocks['attrs']['iframeUrl'];
		}
	}
	?>
	<section <?php echo false !== $slide_video ? 'data-background-video="' . esc_url( $slide_video ) . '"' : ''; ?> <?php echo false !== $slide_iframe ? 'data-background-iframe="' . esc_url( $slide_iframe ) . '"' : ''; ?> data-background="<?php echo esc_html( $slide_background ); ?>" data-background-transition="<?php echo esc_attr( isset( $blocks['attrs']['backgroundTransition'] ) ? $blocks['attrs']['backgroundTransition'] : 'none' ); ?>" data-background-video-loop data-background-video-muted>
		<?php
		foreach ( $blocks['innerBlocks'] as $index => $inner_data ) {
			if ( is_array( $inner_data ) ) {
				$attributes = $inner_data['attrs'];
				switch ( $inner_data['blockName'] ) {
					default:
						echo render_block( $inner_data ); // phpcs:ignore
						break;
				}
			}
		}
		?>
	</section>
	<?php
}
