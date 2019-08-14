<?php // phpcs:ignorefile
/**
 * Term Options for WP Presenter Pro
 *
 * @package   WP_Presenter_Pro
 */

namespace WP_Presenter_Pro\Admin;

/**
 * Class Admin
 */
class ACF {

	/**
	 * Initialize the Admin component.
	 */
	public function init() {

	}

	/**
	 * Register any hooks that this component needs.
	 */
	public function register_hooks() {
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5d53a3a474cbe',
				'title' => 'Navigation',
				'fields' => array(
					array(
						'key' => 'field_5d53a3aedaff2',
						'label' => 'Display Controls?',
						'name' => 'display_controls',
						'type' => 'radio',
						'instructions' => 'Disable or enable slideshow controls.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'true',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d53a3eedaff3',
						'label' => 'Keyboard Shortcuts',
						'name' => 'keyboard_shortcuts',
						'type' => 'radio',
						'instructions' => 'Disable or enable slideshow controls.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'true',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d53a413daff4',
						'label' => 'Mouse Wheel Navigation',
						'name' => 'mouse_wheel_navigation',
						'type' => 'radio',
						'instructions' => 'Allow the mousewheel / scroll-down effect to transition slides.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'false',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'presentations',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'left',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'acfe_display_title' => '',
				'acfe_autosync' => '',
				'acfe_permissions' => '',
				'acfe_note' => '',
				'acfe_meta' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5d53958a18b75',
				'title' => 'Presentation Settings',
				'fields' => array(
					array(
						'key' => 'field_5d5421adee750',
						'label' => 'Theme',
						'name' => 'theme',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'beige' => 'Beige',
							'black' => 'Black',
							'blood' => 'Blood',
							'league' => 'League',
							'moon' => 'Moon',
							'night' => 'Night',
							'serif' => 'Serif',
							'solarized' => 'Solarized',
							'white' => 'White',
						),
						'default_value' => array(
							0 => 'black',
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5d5395e6a3c67',
						'label' => 'Loop Slides',
						'name' => 'loop',
						'type' => 'radio',
						'instructions' => 'The slides loop if you have this enabled.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'false',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d5396294d1df',
						'label' => 'Right to Left',
						'name' => 'right_to_left',
						'type' => 'radio',
						'instructions' => 'The slides to right to left instead of left to right.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'false',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d53969a4d1e0',
						'label' => 'Push History',
						'name' => 'push_history',
						'type' => 'radio',
						'instructions' => 'Allow browser history for your slides.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'true',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'presentations',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5d53a11c10fca',
				'title' => 'Slide Size',
				'fields' => array(
					array(
						'key' => 'field_5d53a125f2859',
						'label' => 'Width',
						'name' => 'width',
						'type' => 'number',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'default_value' => 960,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
						'acfe_validate' => '',
						'acfe_update' => '',
					),
					array(
						'key' => 'field_5d53a161f285a',
						'label' => 'Height',
						'name' => 'height',
						'type' => 'number',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'default_value' => 700,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
						'acfe_validate' => '',
						'acfe_update' => '',
					),
					array(
						'key' => 'field_5d53a1aaf285b',
						'label' => 'Margin',
						'name' => 'margin',
						'type' => 'text',
						'instructions' => 'Factor of the displayed size that should be empty around the content.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'default_value' => '0.1',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'acfe_validate' => '',
						'acfe_update' => '',
					),
					array(
						'key' => 'field_5d53a1fcf285c',
						'label' => 'Min Scale',
						'name' => 'min_scale',
						'type' => 'text',
						'instructions' => 'Bounds for minimum scale for content.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'default_value' => '0.2',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'acfe_validate' => '',
						'acfe_update' => '',
					),
					array(
						'key' => 'field_5d53a248f285d',
						'label' => 'Max Scale',
						'name' => 'max_scale',
						'type' => 'text',
						'instructions' => 'Bounds for maximum scale for content.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'default_value' => '1.5',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'acfe_validate' => '',
						'acfe_update' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'presentations',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'left',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'acfe_display_title' => '',
				'acfe_autosync' => '',
				'acfe_permissions' => '',
				'acfe_note' => '',
				'acfe_meta' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5d53a2e5c5210',
				'title' => 'Visual Settings',
				'fields' => array(
					array(
						'key' => 'field_5d53a2ec6343c',
						'label' => 'Progress Bar',
						'name' => 'progress_bar',
						'type' => 'radio',
						'instructions' => 'Display a progress bar at the bottom of your slides.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'true',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5d53a3396343d',
						'label' => 'Slide Number',
						'name' => 'slide_number',
						'type' => 'radio',
						'instructions' => 'Display a slide number bar at the bottom of your slides.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_permissions' => '',
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 'true',
						'layout' => 'horizontal',
						'return_format' => 'value',
						'acfe_validate' => '',
						'acfe_update' => '',
						'save_other_choice' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'presentations',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'left',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'acfe_display_title' => '',
				'acfe_autosync' => '',
				'acfe_permissions' => '',
				'acfe_note' => '',
				'acfe_meta' => '',
			));

			endif;
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
			if ( is_tax( 'presentations' ) ) {
				$slide = WP_PRESENTER_PRO_DIR . '/templates/slides.php';
				return $slide;
			} else {
				return $template;
			}
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
