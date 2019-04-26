<?php

function woo_student_center_shortcode() {
	include_once ( WOORDLE_FRONTEND_PATH . '/templates/student-center.php' );
}

add_shortcode( 'central_student', 'woo_student_center_shortcode' );

function woo_archive_courses () {
	if ( is_post_type_archive( 'courses' ) ) {

		// Grab the first artist post ID and store it in an array
		$posts = get_posts( array(
			'post_type'      => 'artists',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'orderby'        => array( 'menu_order' => 'ASC', 'post_date' => 'DESC' ),
		) );
	}
}
add_shortcode( 'course_shop', 'woo_archive_courses' );
