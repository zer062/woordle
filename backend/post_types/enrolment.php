<?php
if (! defined ('ABSPATH') ) exit;

return [
	'labels' => [
		'name'               => _x( 'Enrolments', 'post type general name', 'woordle' ),
		'singular_name'      => _x( 'Enrolment', 'post type singular name', 'woordle' ),
		'menu_name'          => _x( 'Enrolments', 'admin menu', 'woordle' ),
		'name_admin_bar'     => _x( 'Enrolment', 'add new on admin bar', 'woordle' ),
		'add_new'            => _x( 'Add New', 'course', 'woordle' ),
		'add_new_item'       => __( 'Add New Enrolment', 'woordle' ),
		'new_item'           => __( 'New Enrolment', 'woordle' ),
		'edit_item'          => __( 'Edit Enrolment', 'woordle' ),
		'view_item'          => __( 'View Enrolment', 'woordle' ),
		'all_items'          => __( 'All Enrolments', 'woordle' ),
		'search_items'       => __( 'Search Enrolments', 'woordle' ),
		'parent_item_colon'  => __( 'Course:', 'woordle' ),
		'not_found'          => __( 'No enrolment found.', 'woordle' ),
		'not_found_in_trash' => __( 'No enrolment found in Trash.', 'woordle' )
	],
	'description'        => __( 'Description.', 'woordle' ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => 'woordle',
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'enrollment' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => true,
	'menu_position'      => null,
	'supports'           => [ 'revisions' ]
];