<?php
/**
 * Add Settings page to Plugin and to sub-menu
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Add Settings Page.
 */
class Add_Settings_Page {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'admin_menu', array( $this, 'register_sub_menu' ), 1 );
	}

	/**
	 * Adds a settings sub-menu to the parent menu
	 */
	public function register_sub_menu() {
		global $mt_pp;
		add_submenu_page(
			'edit.php?post_type=wppp',
			__( 'Settings', 'wp-presenter-pro' ),
			__( 'Settings', 'wp-presenter-pro' ),
			'manage_options',
			'wppp-settings',
			array( $this, 'admin_page' )
		);
	}

	/**
	 * Admin page for entering a license.
	 */
	public function admin_page() {
		?>
		<div class="wrap">
		<?php
		if ( isset( $_POST['options'] ) ) { // phpcs:ignore

			// Check for valid license.
			$store_url  = 'https://mediaron.com';
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $_POST['options']['license'], // phpcs:ignore
				'item_name'  => urlencode( 'WP Presenter Pro' ), // phpcs:ignore
				'url'        => home_url(),
			);
			// Call the custom API.
			$response = wp_remote_post(
				$store_url,
				array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params,
				)
			);

			// make sure the response came back okay.
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$license_message = $response->get_error_message();
				} else {
					$license_message = __( 'An error occurred, please try again.', 'wp-presenter-pro' );
				}
			} else {

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( false === $license_data->success ) {
					delete_site_option( 'uppe_license_status' );
					switch ( $license_data->error ) {

						case 'expired':
							$license_message = sprintf(
								__( 'Your license key expired on %s.', 'wp-presenter-pro' ), /* phpcs:ignore */
								date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
							);
							break;

						case 'disabled':
						case 'revoked':
							$license_message = __( 'Your license key has been disabled.', 'wp-presenter-pro' );
							break;

						case 'missing':
							$license_message = __( 'Invalid license.', 'wp-presenter-pro' );
							break;

						case 'invalid':
						case 'site_inactive':
							$license_message = __( 'Your license is not active for this URL.', 'wp-presenter-pro' );
							break;
						case 'item_name_mismatch':
							$license_message = sprintf( __( 'This appears to be an invalid license key for %s.', 'wp-presenter-pro' ), 'User Profile Picture Enhanced' ); // phpcs:ignore
							break;
						case 'no_activations_left':
							$license_message = __( 'Your license key has reached its activation limit.', 'wp-presenter-pro' );
							break;

						default:
							$license_message = __( 'An error occurred, please try again.', 'wp-presenter-pro' );
							break;
					}
				}
				if ( empty( $license_message ) ) {
					update_site_option( 'wppp_license_status', $license_data->license );
					update_site_option( 'wppp_license', sanitize_text_field( $_POST['options']['license'] ) ); // phpcs:ignore
				}
			}
		}
		$license_status = get_site_option( 'uppe_license_status', false );
		$license        = get_site_option( 'uppe_license', '' );
		?>
		<h2><?php esc_html_e( 'Welcome to WP Presenter Pro', 'wp-presenter-pro' ); ?></h2>
		<form method="POST" action="
			<?php
			echo esc_url(
				add_query_arg(
					array(
						'post_type' => 'wppp',
						'page'      => 'wppp-settings',
					),
					admin_url( 'edit.php' )
				)
			);
			?>
		">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="uppe-license"><?php esc_html_e( 'Enter Your License', 'wp-presenter-pro' ); ?></label></th>
				<td>
					<input id="uppe-license" class="regular-text" type="text" value="<?php echo esc_attr( $license ); ?>" name="options[license]" /><br />
					<?php
					if ( false === $license || empty( $license ) ) {
						printf( '<p>%s</p>', esc_html__( 'Please enter your license key.', 'wp-presenter-pro' ) );
					} else {
						printf( '<p>%s</p>', esc_html__( 'Your license is valid and you will now receive update notifications.', 'wp-presenter-pro' ) );
					}
					?>
					<?php
					if ( ! empty( $license_message ) ) {
						printf( '<div class="updated error"><p><strong>%s</p></strong></div>', esc_html( $license_message ) );
					}
					?>
				</td>
			</tr>
		</table>
		<?php submit_button( __( 'Save Options', 'wp-presenter-pro' ) ); ?>
		</div>
		<?php
	}
}
