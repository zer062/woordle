<?php
/**
 * @package Woordle/Core
 */

class Woordle_Loader {

	public function load_models() {
		$post_types = $this->scan_models();
		var_dump($post_types); die;
	}

	public function scan_models() {
		$files = scandir( WOORDLE_MODELS_PATH );
		unset( $files[0] );
		unset( $files[1] );
		return $files;
	}
}