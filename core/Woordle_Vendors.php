<?php

class Woordle_Vendors {

	public function load_acf () {
		include_once( WOORDLE_VENDORS_PATH . '/advanced-custom-fields/acf.php' );
		add_filter( 'acf/settings/path', [ $this, 'acf_woordle_settings_path' ]);
		add_filter( 'acf/settings/dir', [ $this, 'acf_woordle_settings_dir' ] );
//		add_filter('acf/settings/show_admin', '__return_false');
	}

	public function acf_woordle_settings_path ( $path ) {

		$path = WOORDLE_VENDORS_PATH . '/advanced-custom-fields/';
		return $path;
	}

	public function acf_woordle_settings_dir( $dir ) {

		$dir = WOORDLE_URL . '/vendors/advanced-custom-fields/';
		return $dir;
	}
}