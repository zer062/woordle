<?php
return [
	'labels' => [
		'name'               => _x( 'Classrooms', 'post type general name', 'woordle' ),
		'singular_name'      => _x( 'Classroom', 'post type singular name', 'woordle' ),
		'menu_name'          => _x( 'Classrooms', 'admin menu', 'woordle' ),
		'name_admin_bar'     => _x( 'Classroom', 'add new on admin bar', 'woordle' ),
		'add_new'            => _x( 'Add New', 'classroom', 'woordle' ),
		'add_new_item'       => __( 'Add New Classroom', 'woordle' ),
		'new_item'           => __( 'New Classroom', 'woordle' ),
		'edit_item'          => __( 'Edit Classroom', 'woordle' ),
		'view_item'          => __( 'View Classroom', 'woordle' ),
		'all_items'          => __( 'All Classrooms', 'woordle' ),
		'search_items'       => __( 'Search Classrooms', 'woordle' ),
		'parent_item_colon'  => __( 'Parent Course:', 'woordle' ),
		'not_found'          => __( 'No classroom found.', 'woordle' ),
		'not_found_in_trash' => __( 'No classroom found in Trash.', 'woordle' )
	],
	'description'        => __( 'Description.', 'woordle' ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => 'woordle',
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'classroom' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => true,
	'menu_position'      => null,
	'supports'           => [ 'title', 'comments' ]
];