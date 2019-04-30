<?php
if (! defined ('ABSPATH') ) exit;

return [
	'labels' => [
		'name'               => _x( 'Courses', 'post type general name', 'woordle' ),
		'singular_name'      => _x( 'Course', 'post type singular name', 'woordle' ),
		'menu_name'          => _x( 'Courses', 'admin menu', 'woordle' ),
		'name_admin_bar'     => _x( 'Course', 'add new on admin bar', 'woordle' ),
		'add_new'            => _x( 'Add New', 'book', 'woordle' ),
		'add_new_item'       => __( 'Add New Course', 'woordle' ),
		'new_item'           => __( 'New Course', 'woordle' ),
		'edit_item'          => __( 'Edit Course', 'woordle' ),
		'view_item'          => __( 'View Course', 'woordle' ),
		'all_items'          => __( 'All Courses', 'woordle' ),
		'search_items'       => __( 'Search Courses', 'woordle' ),
		'parent_item_colon'  => __( 'Parent Courses:', 'woordle' ),
		'not_found'          => __( 'No courses found.', 'woordle' ),
		'not_found_in_trash' => __( 'No courses found in Trash.', 'woordle' )
	],
	'description'        => __( 'Description.', 'woordle' ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => 'woordle',
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'courses' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => [ 'title', 'thumbnail', 'comments' ]
];