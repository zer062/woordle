<?php
if (! defined ('ABSPATH') ) exit;

function woordle_student_center_shortcode() {
	include_once ( WOORDLE_FRONTEND_PATH . '/templates/student-center.php' );
}

add_shortcode( 'central_student', 'woordle_student_center_shortcode' );;
