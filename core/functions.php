<?php
if (! defined ('ABSPATH') ) exit;

function woordle_load_template_part( $slug, $name = '' ) {
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

function woordle_has_course_background_image() {
	global $post;
	$background_image = get_field( 'woordle_course_promotional_woordle_course_background_image', $post->ID );
	return $background_image != false;
}

function woordle_course_times() {
	global $post;
	$time = get_field( 'woordle_course_information_woordle_course_time', $post->ID );
	echo $time . ' ' . __( 'hours', 'woordle');
}

function woordle_course_description() {
	global $post;
	echo get_field( 'woordle_course_information_woordle_course_description', $post->ID );
}

function woordle_course_grade() {
	global $post;
	echo get_field( 'woordle_course_information_woordle_course_content', $post->ID );
}

function woordle_has_course_will_learn() {
	global $post;
	$learn = get_field( 'woordle_course_information_woorlde_to_learn', $post->ID );
	return $learn != false;
}

function woordle_has_course_requirements() {
	global $post;
	$requirements = get_field( 'woordle_course_information_woordle_course_requirements', $post->ID );
	return $requirements != false;
}

function woordle_course_requirements() {
	global $post;
	echo get_field( 'woordle_course_information_woordle_course_requirements', $post->ID );
}

function woordle_course_will_learn() {
	global $post;
	echo get_field( 'woordle_course_information_woorlde_to_learn', $post->ID );
}

function woordle_has_promotional_video() {
	global $post;
	$video = get_field( 'woordle_course_promotional_woordle_course_promotional_video', $post->ID );
	return $video != '';
}

function woordle_promotional_video() {
	global $post;
	echo get_field( 'woordle_course_promotional_woordle_course_promotional_video', $post->ID );
}