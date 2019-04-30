<?php
if (! defined ('ABSPATH') ) exit;

class Woordle_Vendors {

	public function load_acf() {
		include_once( WOORDLE_VENDORS_PATH . '/advanced-custom-fields/acf.php' );
		add_filter( 'acf/settings/path', [ $this, 'acf_woordle_settings_path' ]);
		add_filter( 'acf/settings/dir', [ $this, 'acf_woordle_settings_dir' ] );
		add_filter( 'acf/settings/save_json', [ $this, 'acf_woordle_forms_save_path' ] );
		add_filter( 'acf/settings/load_json', [ $this, 'acf_woordle_forms_load_path' ] );
		add_filter('acf/settings/show_admin', '__return_false');
	}

	/**
	 * @param $path
	 *
	 * @return string
	 */
	public function acf_woordle_settings_path( $path ) {

		$path = WOORDLE_VENDORS_PATH . '/advanced-custom-fields/';
		return $path;
	}

	/**
	 * @param $dir
	 *
	 * @return string
	 */
	public function acf_woordle_settings_dir( $dir ) {

		$dir = WOORDLE_URL . '/vendors/advanced-custom-fields/';
		return $dir;
	}

	/**
	 * @param $path
	 *
	 * @return string
	 */
	public function acf_woordle_forms_save_path( $path ) {

		$path = WOORDLE_BACKEND_PATH . '/forms';
		return $path;
	}

	/**
	 * @param $paths
	 *
	 * @return array
	 */
	function acf_woordle_forms_load_path( $paths ) {

		unset($paths[0]);
		$paths[] = WOORDLE_BACKEND_PATH . '/forms';
		return $paths;
	}

	/**
	 * Load Request library
	 */
	function load_request() {
		include_once( WOORDLE_VENDORS_PATH . '/requests/library/Requests.php' );
	}
}