<?php
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
	WOORDLE_CORE_PATH . '/Woordle_Vendors.php',
	WOORDLE_BACKEND_PATH . '/Woordle_Category_Course.php',
	WOORDLE_BACKEND_PATH . '/Woordle_Admin_Resources.php',
];

foreach ( $woordle_files as $class_path ) {

	if ( file_exists( $class_path ) ) {
		require $class_path;
	}
}

new Woordle();