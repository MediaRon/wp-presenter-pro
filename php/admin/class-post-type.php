<?php
/**
 * Post Type options for WP Presenter Pro
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Admin
 */
class Post_Type {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {
		return;
		// Setup Post Type Template.
		$wp_presentation_pro           = get_post_type_object( 'wppp' );
		$wp_presentation_pro->template = array(
			array(
				'wppp/slide',
			),
		);
	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'init', array( $this, 'post_type_args' ) );
	}

	/**
	 * Initialize Post Type for slides.
	 *
	 * @return void.
	 */
	public function post_type_args() {
		$labels  = array(
			'name'                  => _x( 'Slides', 'Post Type General Name', 'user-profile-picture-enhanced' ),
			'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'user-profile-picture-enhanced' ),
			'menu_name'             => __( 'Slides', 'user-profile-picture-enhanced' ),
			'name_admin_bar'        => __( 'Slide', 'user-profile-picture-enhanced' ),
			'archives'              => __( 'Slide Archives', 'user-profile-picture-enhanced' ),
			'attributes'            => __( 'Slide Attributes', 'user-profile-picture-enhanced' ),
			'parent_item_colon'     => __( 'Parent Item:', 'user-profile-picture-enhanced' ),
			'all_items'             => __( 'All Slides', 'user-profile-picture-enhanced' ),
			'add_new_item'          => __( 'Add New Slide', 'user-profile-picture-enhanced' ),
			'add_new'               => __( 'Add New Slide', 'user-profile-picture-enhanced' ),
			'new_item'              => __( 'New Slide', 'user-profile-picture-enhanced' ),
			'edit_item'             => __( 'Edit Slide', 'user-profile-picture-enhanced' ),
			'update_item'           => __( 'Update Slide', 'user-profile-picture-enhanced' ),
			'view_item'             => __( 'View Slide', 'user-profile-picture-enhanced' ),
			'view_items'            => __( 'View Slides', 'user-profile-picture-enhanced' ),
			'search_items'          => __( 'Search Slides', 'user-profile-picture-enhanced' ),
			'not_found'             => __( 'Not found', 'user-profile-picture-enhanced' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'user-profile-picture-enhanced' ),
			'featured_image'        => __( 'Featured Image', 'user-profile-picture-enhanced' ),
			'set_featured_image'    => __( 'Set featured image', 'user-profile-picture-enhanced' ),
			'remove_featured_image' => __( 'Remove featured image', 'user-profile-picture-enhanced' ),
			'use_featured_image'    => __( 'Use as featured image', 'user-profile-picture-enhanced' ),
			'insert_into_item'      => __( 'Insert into item', 'user-profile-picture-enhanced' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Slide', 'user-profile-picture-enhanced' ),
			'items_list'            => __( 'Slide List', 'user-profile-picture-enhanced' ),
			'items_list_navigation' => __( 'Slide list navigation', 'user-profile-picture-enhanced' ),
			'filter_items_list'     => __( 'Filter Slide list', 'user-profile-picture-enhanced' ),
		);
		$rewrite = array(
			'slug'       => 'slides',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);

		$args = array(
			'label'               => __( 'Slide', 'user-profile-picture-enhanced' ),
			'description'         => __( 'Slide', 'user-profile-picture-enhanced' ),
			'labels'              => $labels,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 100,
			'menu_icon'           => 'dashicons-slides',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'supports'            => array(
				'title',
				'editor',
			),
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'query_var'           => 'wppp',
			'capability_type'     => 'page',
			'show_in_rest'        => true,
			'show_in_menu'        => true,
		);
		register_post_type( 'wppp', $args );
	}
}
