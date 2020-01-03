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
		$slide = WP_PRESENTER_PRO_DIR . '/templates/slides.php';
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
					'icon'  => 'admin-customizer',
				),
				array(
					'slug'  => 'wp-presenter-pro-slides',
					'title' => __( 'WP Presenter Pro Slides', 'metronet-profile-picture' ),
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
			'name'                  => _x( 'Slides', 'Post Type General Name', 'wp-presenter-pro' ),
			'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'wp-presenter-pro' ),
			'menu_name'             => __( 'Slides', 'wp-presenter-pro' ),
			'name_admin_bar'        => __( 'Slide', 'wp-presenter-pro' ),
			'archives'              => __( 'Slide Archives', 'wp-presenter-pro' ),
			'attributes'            => __( 'Slide Attributes', 'wp-presenter-pro' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wp-presenter-pro' ),
			'all_items'             => __( 'All Slides', 'wp-presenter-pro' ),
			'add_new_item'          => __( 'Add New Slide', 'wp-presenter-pro' ),
			'add_new'               => __( 'Add New Slide', 'wp-presenter-pro' ),
			'new_item'              => __( 'New Slide', 'wp-presenter-pro' ),
			'edit_item'             => __( 'Edit Slide', 'wp-presenter-pro' ),
			'update_item'           => __( 'Update Slide', 'wp-presenter-pro' ),
			'view_item'             => __( 'View Slide', 'wp-presenter-pro' ),
			'view_items'            => __( 'View Slides', 'wp-presenter-pro' ),
			'search_items'          => __( 'Search Slides', 'wp-presenter-pro' ),
			'not_found'             => __( 'Not found', 'wp-presenter-pro' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-presenter-pro' ),
			'featured_image'        => __( 'Featured Image', 'wp-presenter-pro' ),
			'set_featured_image'    => __( 'Set featured image', 'wp-presenter-pro' ),
			'remove_featured_image' => __( 'Remove featured image', 'wp-presenter-pro' ),
			'use_featured_image'    => __( 'Use as featured image', 'wp-presenter-pro' ),
			'insert_into_item'      => __( 'Insert into item', 'wp-presenter-pro' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Slide', 'wp-presenter-pro' ),
			'items_list'            => __( 'Slide List', 'wp-presenter-pro' ),
			'items_list_navigation' => __( 'Slide list navigation', 'wp-presenter-pro' ),
			'filter_items_list'     => __( 'Filter Slide list', 'wp-presenter-pro' ),
		);
		$rewrite = array(
			'slug'       => 'slides',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => false,
		);

		$args = array(
			'label'               => __( 'Slide', 'wp-presenter-pro' ),
			'description'         => __( 'Slide', 'wp-presenter-pro' ),
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
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'revisions',
			),
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'query_var'           => 'wppp',
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'show_in_menu'        => true,
		);
		$args = apply_filters( 'wp_presenter_pro_post_type_args', $args );
		register_post_type( 'wppp', $args );

		$meta_boxes_toggle = array(
			'slides-display-controls',
			'slides-keyboard-shortcuts',
			'slides-mouse-wheel-navigation',
			'slides-loop-slides',
			'slides-right-to-left',
			'slides-push-history',
			'slides-progress-bar',
			'slides-slide-number',
			'slides-skip-first-slide',
			'slides-no-link-previews',
		);
		$meta_boxes_text   = array(
			'slides-theme',
			'slides-slide-width',
			'slides-slide-height',
			'slides-slide-margin',
			'slides-min-scale',
			'slides-max-scale',
			'slides-header-left',
			'slides-header-right',
			'slides-footer-left',
			'slides-footer-right',
		);
		foreach ( $meta_boxes_toggle as $meta_box ) {
			register_post_meta(
				'wppp',
				$meta_box,
				array(
					'show_in_rest' => true,
					'type'         => 'string',
					'single'       => true,
				)
			);
		}
		foreach ( $meta_boxes_text as $meta_box ) {
			register_post_meta(
				'wppp',
				$meta_box,
				array(
					'show_in_rest' => true,
					'type'         => 'string',
					'single'       => true,
				)
			);
		}

		$wp_presentation_pro           = get_post_type_object( 'wppp' );
		$wp_presentation_pro->template = array(
			array(
				'wppp/slide',
			),
		);

		// Flush rewrite rules.
		$maybe_flush_rewrite_rules = get_option( 'wp_presenter_pro_permalinks_flushed', 0 );
		if ( ! $maybe_flush_rewrite_rules ) {
			flush_rewrite_rules( true );
			update_option( 'wp_presenter_pro_permalinks_flushed', 1 );
		}
	}
}
