<?php
if (! defined ('ABSPATH') ) exit;
return [
	'labels'                => [
		'name'                       => _x( 'Category course', 'taxonomy general name', 'woordle' ),
		'singular_name'              => _x( 'Category course', 'taxonomy singular name', 'woordle' ),
		'search_items'               => __( 'Search Category courses', 'woordle' ),
		'popular_items'              => __( 'Popular Category courses', 'woordle' ),
		'all_items'                  => __( 'All Category courses', 'woordle' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category course', 'woordle' ),
		'update_item'                => __( 'Update Category course', 'woordle' ),
		'add_new_item'               => __( 'Add New Category course', 'woordle' ),
		'new_item_name'              => __( 'New Category course Name', 'woordle' ),
		'separate_items_with_commas' => __( 'Separate category coursed with commas', 'woordle' ),
		'add_or_remove_items'        => __( 'Add or remove category courses', 'woordle' ),
		'choose_from_most_used'      => __( 'Choose from the most used category courses', 'woordle' ),
		'not_found'                  => __( 'No category courses found.', 'woordle' ),
		'menu_name'                  => __( 'Category courses', 'woordle' ),
	],
	'hierarchical'          => true,
	'show_ui'               => true,
	'show_admin_column'     => 'course-categories',
	'update_count_callback' => '_update_post_term_count',
	'query_var'             => true,
	'rewrite'               => [ 'slug' => 'category_course' ],
];