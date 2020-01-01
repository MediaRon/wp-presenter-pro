<?php
/**
 * Register meta boxes for WP Presenter Pro.
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Meta_Boxes
 */
class Meta_Boxes {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'init', array( $this, 'register_meta_boxes' ), 20 );
	}

	/**
	 * Register the meta boxes for WP Presenter Pro.
	 */
	public function register_meta_boxes() {
		
	}
}
