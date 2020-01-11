<?php
/**
 * Admin Options for WP Presenter Pro
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Admin
 */
class Options {

	/**
	 * Get admin options.
	 *
	 * @var array $options Store the options.
	 */
	private $options = array();

	/**
	 * Initialize the Options component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
	}

	/**
	 * Register the admin sub-menu.
	 */
	public function register_menu() {
		add_submenu_page(
			'edit.php?post_type=wppp',
			__( 'Options', 'wp-presenter-pro' ),
			__( 'Options', 'textdomain' ),
			'manage_options',
			'wp-presenter-pro-options',
			array( $this, 'output_options' )
		);
	}

	/**
	 * Output the options necessary for this pliugin.
	 */
	public function output_options() {
		$options = $this->get_options( true );
		if ( isset( $_POST['wppp_options_nonce'] ) ) {
			$post_vars = filter_input_array( INPUT_POST );
			if ( wp_verify_nonce( $post_vars['wppp_options_nonce'], 'save_wppp_options' ) && current_user_can( 'manage_options' ) ) {
				$options['blocks']         = sanitize_text_field( $post_vars['wppp-block-select'] );
				$options['post_type_slug'] = sanitize_title( $post_vars['wppp-post-type-slug'] );
				$options['taxonomy_slug']  = sanitize_title( $post_vars['wppp-taxonomy-slug'] );
				update_option( 'wp-presenter-pro-admin-options', $options );
				$this->options = $options;
				$this->show_admin_message(
					esc_html__( 'Settings Saved!', 'wp-presenter-pro' ),
					esc_html__( 'Your settings have been saved.', 'wp-presenter-pro' ),
					'notice-success'
				);
				update_option( 'wp_presenter_pro_permalinks_flushed', 0 );
			} else {
				$this->show_admin_message(
					esc_html__( 'Settings could not be saved!', 'wp-presenter-pro' ),
					esc_html__( 'Your settings have not been saved because the nonce could not be verified.', 'wp-presenter-pro' )
				);
			}
		}
		?>
		<div class="wrap">
			<h1><img src="<?php echo esc_url( WP_PRESENTER_PRO_URL . '/images/wp-presenter-pro-icon.png' ); ?>" width="25" height="25" alt="WP Presenter Pro Icon" /> <?php esc_html_e( 'WP Presenter Pro Options', 'wp-presenter-pro' ); ?></h1>
			<h2><?php esc_html_e( 'WP Presenter Pro Options', 'wp-presenter-pro' ); ?></h2>
			<hr />
			<form method="POST">
				<?php
				wp_nonce_field( 'save_wppp_options', 'wppp_options_nonce' );
				?>
				<fieldset>
					<legend><h3><?php esc_html_e( 'Toggle Blocks', 'wp-presenter-pro' ); ?></h3></legend>
					<input type="radio" name="wppp-block-select" id="wppp-radio-all-blocks" value="all" <?php checked( 'all', $options['blocks'] ); ?> />&nbsp;<label for="wppp-radio-all-blocks"><?php esc_html_e( 'Enable All Blocks', 'wp-presenter-pro' ); ?></label>
					<br />
					<input type="radio" name="wppp-block-select" id="wppp-radio-curated-blocks" value="curated" <?php checked( 'curated', $options['blocks'] ); ?> />&nbsp;<label for="wppp-radio-curated-blocks"><?php esc_html_e( 'Enable Curated Blocks Only (Recommended)', 'wp-presenter-pro' ); ?></label>
				</fieldset>
				<fieldset>
					<legend><h3><?php esc_html_e( 'Change Slugs', 'wp-presenter-pro' ); ?></h3></legend>
					<p>
						<label for="wppp-post-type-slug"><?php esc_html_e( 'Enter the post type slug for your slides.', 'wp-presenter-pro' ); ?></label><br />
						<input type="text" class="regular-text" name="wppp-post-type-slug" id="wppp-post-type-slug" value="<?php echo esc_attr( $options['post_type_slug'] ); ?>" />
					</p>
					<p>
						<label for="wppp-taxonomy-slug"><?php esc_html_e( 'Enter the taxonomy slug for your slides.', 'wp-presenter-pro' ); ?></label><br />
						<input type="text" class="regular-text" name="wppp-taxonomy-slug" id="wppp-taxonomy-slug" value="<?php echo esc_attr( $options['taxonomy_slug'] ); ?>" />
					</p>
				</fieldset>
				<?php
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Get a list of admin options.
	 *
	 * @param bool $force_reload Whether to clear the cache and retrieve the options.
	 *
	 * @return array Array of option values.
	 */
	public function get_options( $force_reload = false ) {
		// Try to get cached options.
		$options = $this->options;
		if ( empty( $options ) || true === $force_reload ) {
			$options = get_option( 'wp-presenter-pro-admin-options', array() );
		}

		// Store options.
		if ( ! is_array( $options ) ) {
			$options = array();
		}

		$defaults = array(
			'blocks'         => 'curated',
			'post_type_slug' => 'slides',
			'taxonomy_slug'  => 'presentations',
		);
		if ( empty( $options ) || count( $options ) < count( $defaults ) ) {
			$options = wp_parse_args(
				$options,
				$defaults
			);
		}

		$this->options = $options;
		return $options;
	}

	/**
	 * Shows a admin notice.
	 *
	 * @param string $title   Title of the warning message.
	 * @param string $message Warning message in detail.
	 * @param string $class   Style class name for warning.
	 */
	private function show_admin_message( $title = '', $message, $class = 'notice-error' ) {
		?>
		<div class="notice <?php echo esc_attr( $class ); ?>">
			<p>
				<?php if ( ! empty( $title ) ) : ?>
					<strong>
						<?php echo esc_html( $title ); ?>
					</strong>
				<?php endif; ?>
				<span>
					<?php echo wp_kses_post( $message ); ?>
				</span>
			</p>
		</div>
		<?php
	}
}
