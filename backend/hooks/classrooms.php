<?php

function woo_save_classroom( $classroom_id ) {

	if( isset( $_POST['post_type'] ) && $_POST['post_type'] != 'classrooms' ) {
		return;
	}

	$classroom = get_post( $classroom_id );
	woo_define_course_classroom( $classroom );
}

add_action( 'acf/save_post', 'woo_save_classroom', 20 );

function woo_define_course_classroom( $classroom ) {
	$course = get_field( 'woordle_classroom_course', $classroom->ID );
	$course = $course[0];
	$classroom->post_parent = $course->ID;
	wp_update_post( $classroom );
	return;
}