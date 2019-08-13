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

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		add_action( 'init', array( $this, 'post_type_args' ) );
		add_filter( 'block_categories', array( $this, 'add_block_category' ), 10, 2 );
		add_filter( 'template_include', array( $this, 'slide_single_override' ), 99 );
	}

	/**
	 * Overrides a slide's single.php file.
	 *
	 * @param string $template The template file to override.
	 *
	 * @return string updated template file.
	 */
	public function slide_single_override( $template ) {
		if ( 'wppp' !== get_post_type() ) {
			return $template;
		}
		$slide = WP_PRESENTER_PRO_DIR . '/templates/slide.php';
		if ( file_exists( $slide ) ) {
			return $slide;
		}
		return $template;
	}

	/**
	 * Adds a block category for WP Presenter Pro.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $categories Array of available categories.
	 * @param object $post       Post to attach it to.
	 *
	 * @return array New Categories
	 */
	public function add_block_category( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'wp-presenter-pro',
					'title' => __( 'WP Presenter Pro', 'metronet-profile-picture' ),
					'icon'  => 'slides',
				),
			)
		);
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

		// Register the taxonomy.
		$labels = array(
			'name'                       => _x( 'Presentations', 'Taxonomy General Name', 'wp-presenter-pro' ),
			'singular_name'              => _x( 'Presentation', 'Taxonomy Singular Name', 'wp-presenter-pro' ),
			'menu_name'                  => __( 'Presentations', 'wp-presenter-pro' ),
			'all_items'                  => __( 'All Presentations', 'wp-presenter-pro' ),
			'parent_item'                => __( 'Parent Presentation', 'wp-presenter-pro' ),
			'parent_item_colon'          => __( 'Parent Presentation:', 'wp-presenter-pro' ),
			'new_item_name'              => __( 'New Presentation Name', 'wp-presenter-pro' ),
			'add_new_item'               => __( 'Add New Presentation', 'wp-presenter-pro' ),
			'edit_item'                  => __( 'Edit Presentation', 'wp-presenter-pro' ),
			'update_item'                => __( 'Update Presentation', 'wp-presenter-pro' ),
			'view_item'                  => __( 'View Presentation', 'wp-presenter-pro' ),
			'separate_items_with_commas' => __( 'Separate Presentations with commas', 'wp-presenter-pro' ),
			'add_or_remove_items'        => __( 'Add or remove Presentations', 'wp-presenter-pro' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wp-presenter-pro' ),
			'popular_items'              => __( 'Popular Presentations', 'wp-presenter-pro' ),
			'search_items'               => __( 'Search Presentations', 'wp-presenter-pro' ),
			'not_found'                  => __( 'Not Found', 'wp-presenter-pro' ),
			'no_terms'                   => __( 'No Presentations', 'wp-presenter-pro' ),
			'items_list'                 => __( 'Presentations list', 'wp-presenter-pro' ),
			'items_list_navigation'      => __( 'Presentations list navigation', 'wp-presenter-pro' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => true,
		);
		register_taxonomy( 'presentations', array( 'wppp' ), $args );

		$wp_presentation_pro           = get_post_type_object( 'wppp' );
		$wp_presentation_pro->template = array(
			array(
				'wppp/slide',
			),
		);
	}
}
