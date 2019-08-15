<?php
/**
 * Display admin notices for third-party plugins that are needed.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Admin
 */
class Admin_Prerequisites {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		if ( ! class_exists( 'ACF' ) ) {
			add_action( 'admin_notices', array( $this, 'show_acf_dependency' ) );
		}
		if ( ! class_exists( 'MN_Reorder' ) ) {
			add_action( 'admin_notices', array( $this, 'show_reorder_posts_dependency' ) );
		}
		if ( ! class_exists( 'Reorder_By_Term' ) ) {
			add_action( 'admin_notices', array( $this, 'show_reorder_by_term_posts_dependency' ) );
		}
	}

	/**
	 * ACF Admin Notice.
	 */
	public function show_acf_dependency() {
		$text = __( 'WP Presenter Pro Requires Advanced Custom Fields.', 'wp-presenter-pro' );
		if ( is_multisite() ) {
			$acf_search = network_admin_url( 'plugin-install.php?s=advanced+custom+fields&tab=search&type=term' );
		} else {
			$acf_search = admin_url( 'plugin-install.php?s=advanced+custom+fields&tab=search&type=term' );
		}
		$text .= sprintf( ' <a href="%s">%s</a>', esc_url( $acf_search ), esc_html__( 'Install it now.', 'wp-presenter-pro' ) );
		printf( '<div class="error"><p>%s</p></div>', wp_kses_post( $text ) );
	}

	/**
	 * Reorder Posts Admin Notice.
	 */
	public function show_reorder_posts_dependency() {
		$text = __( 'WP Presenter Pro Requires Reorder Posts.', 'wp-presenter-pro' );
		if ( is_multisite() ) {
			$reorder_search = network_admin_url( 'plugin-install.php?s=reorder+posts&tab=search&type=term' );
		} else {
			$reorder_search = admin_url( 'plugin-install.php?s=reorder+posts&tab=search&type=term' );
		}
		$text .= sprintf( ' <a href="%s">%s</a>', esc_url( $reorder_search ), esc_html__( 'Install it now.', 'wp-presenter-pro' ) );
		printf( '<div class="error"><p>%s</p></div>', wp_kses_post( $text ) );
	}

	/**
	 * Reorder Posts Admin Notice.
	 */
	public function show_reorder_by_term_posts_dependency() {
		$text = __( 'WP Presenter Pro Requires Reorder by Term for Displaying and Reordering Slides.', 'wp-presenter-pro' );
		if ( is_multisite() ) {
			$reorder_search = network_admin_url( 'plugin-install.php?s=reorder+by+term&tab=search&type=term' );
		} else {
			$reorder_search = admin_url( 'plugin-install.php?s=reorder+by+term&tab=search&type=term' );
		}
		$text .= sprintf( ' <a href="%s">%s</a>', esc_url( $reorder_search ), esc_html__( 'Install it now.', 'wp-presenter-pro' ) );
		printf( '<div class="error"><p>%s</p></div>', wp_kses_post( $text ) );
	}
}
