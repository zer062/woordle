<?php
if (! defined ('ABSPATH') ) exit;

class Woordle_Resources {

	public function load_resources() {
		add_action( 'wp_enqueue_scripts', [ $this, 'add_woordle_styles' ] );
	}

	public function add_woordle_styles() {
		wp_enqueue_style( 'woordle', WOORDLE_FRONTEND_RESOURCES_URL . '/css/woordle.css' );
	}
}