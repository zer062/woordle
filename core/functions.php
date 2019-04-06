<?php

function woo_load_template_part( $slug, $name = '' ) {
	$template = '';

	if ( $name != '' ) {
		$template = locate_template( [ "{$slug}-{$name}.php", "woordle/{$slug}-{$name}.php" ] );
	}

	if ( $name == ''  ) {
		$template = locate_template( [ "{$slug}.php", "woordle/{$slug}.php" ] );
	}

	if ( $template == '' ) {

		if ( file_exists( WOORDLE_FRONTEND_PATH . "/templates/{$slug}-{$name}.php" ) ) {
			$template = WOORDLE_FRONTEND_PATH . "/templates/{$slug}-{$name}.php";
		}

		if ( file_exists( WOORDLE_FRONTEND_PATH . "/templates/{$slug}.php" ) ) {
			$template = WOORDLE_FRONTEND_PATH . "/templates/{$slug}.php";
		}
	}

	if ( $template != '' ) {
		load_template( $template );
	}
}

function has_course_background_image() {
	global $post;
	$background_image = get_field( 'woordle_course_promotional_woordle_course_background_image', $post->ID );
	return $background_image != false;
}

function course_background() {
	global $post;
	return get_field( 'woordle_course_promotional_woordle_course_background_image', $post->ID );
}

function course_times() {
	global $post;
	$time = get_field( 'woordle_course_information_woordle_course_time', $post->ID );
	echo $time . ' ' . __( 'hours', 'woordle');
}

function course_description() {
	global $post;
	echo get_field( 'woordle_course_information_woordle_course_description', $post->ID );
}

function has_course_will_learn() {
	global $post;
	$learn = get_field( 'woordle_course_information_woorlde_to_learn', $post->ID );
	return $learn != false;
}

function has_course_requirements() {
	global $post;
	$requirements = get_field( 'woordle_course_information_woordle_course_requirements', $post->ID );
	return $requirements != false;
}

function course_requirements() {
	global $post;
	echo get_field( 'woordle_course_information_woordle_course_requirements', $post->ID );
}

function course_will_learn() {
	global $post;
	echo get_field( 'woordle_course_information_woorlde_to_learn', $post->ID );
}

function has_promotional_video() {
	global $post;
	$video = get_field( 'woordle_course_promotional_woordle_course_promotional_video', $post->ID );
	return $video != '';
}

function promotional_video() {
	global $post;
	echo get_field( 'woordle_course_promotional_woordle_course_promotional_video', $post->ID );
}