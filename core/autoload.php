<?php
if (! defined ('ABSPATH') ) exit;
/**
 * @package Woordle/Core
 */

require 'constants.php';

$woordle_files = [
	WOORDLE_CORE_PATH . '/Woordle_Loader.php',
	WOORDLE_CORE_PATH . '/Woordle.php',
	WOORDLE_CORE_PATH . '/Woordle_Model.php',
	WOORDLE_BACKEND_PATH . '/Woordle_Menu.php',
	WOORDLE_CORE_PATH . '/Woordle_CTP.php',
	WOORDLE_BACKEND_PATH . '/hooks/courses.php',
	WOORDLE_BACKEND_PATH . '/hooks/category_course.php',
	WOORDLE_BACKEND_PATH . '/hooks/enrolment.php',
	WOORDLE_CORE_PATH . '/Woordle_Vendors.php',
	WOORDLE_BACKEND_PATH . '/Woordle_Category_Course.php',
	WOORDLE_BACKEND_PATH . '/Woordle_Admin_Resources.php',
	WOORDLE_FRONTEND_PATH . '/Woordle_Resources.php',
	WOORDLE_BACKEND_PATH . '/Woordle_Options.php',
	WOORDLE_CORE_PATH . '/Woordle_Template.php',
	WOORDLE_CORE_PATH . '/Woordle_Http.php',
	WOORDLE_CORE_PATH . '/Woordle_Response.php',
	WOORDLE_CORE_PATH . '/Woordle_Moodle.php',
	WOORDLE_CORE_PATH . '/moodle/Moodle_Category.php',
	WOORDLE_CORE_PATH . '/moodle/Moodle_Courses.php',
	WOORDLE_CORE_PATH . '/moodle/Moodle_User.php',
	WOORDLE_CORE_PATH . '/moodle/Moodle_Enrolment.php',
	WOORDLE_CORE_PATH . '/functions.php',
	WOORDLE_FRONTEND_PATH . '/functions/shortcodes.php',
	WOORDLE_FRONTEND_PATH . '/functions/woocommerce.php',
	WOORDLE_BACKEND_PATH . '/woocommerce/functions.php',
];

foreach ( $woordle_files as $class_path ) {

	if ( file_exists( $class_path ) ) {
		require $class_path;
	}
}