<?php

function woo_load_template( $template, $woordle_folder = false ) {

	$theme_file = get_stylesheet_directory() . '/' . $template . '.php';

	if ( $woordle_folder ) {
		$theme_file = get_stylesheet_directory() . '/woordle/' . $template . '.php';
	}

	if ( file_exists( $theme_file ) ) {
		return $theme_file;
	}

	return include WOORDLE_FRONTEND_PATH . '/templates/' . $template . '.php';

}