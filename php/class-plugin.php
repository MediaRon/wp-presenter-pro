<?php
/**
 * Primary plugin file.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro;

/**
 * Class Plugin
 */
class Plugin extends Plugin_Abstract {
	/**
	 * Execute this once plugins are loaded.
	 */
	public function plugin_loaded() {

		// Enqueue scripts.
		$this->block_enqueue = new Blocks\Enqueue();
		$this->block_enqueue->register_hooks();

		// Block for main slide.
		$this->block_slide = new Blocks\Slide();
		$this->block_slide->register_hooks();

		// Register post type actions and filters.
		$this->post_type = new Admin\Post_Type();
		$this->post_type->register_hooks();

		// Register license and settings.
		$this->license_admin = new Admin\EDD_License_Settings();
		$this->license_admin->register_hooks();
	}
}
