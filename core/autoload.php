<?php
/**
 * @package Woordle/Core
 */

require 'constants.php';

$woordle_files = [
	WOORDLE_CORE_PATH . '/Woordle.php',
	WOORDLE_CORE_PATH . '/Woordle_Model.php'
];

foreach ( $woordle_files as $class_path ) {

	if ( file_exists( $class_path ) ) {
		require $class_path;
	}
}

new Woordle();