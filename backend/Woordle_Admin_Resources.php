<?php
if (! defined ('ABSPATH') ) exit;

class Woordle_Admin_Resources {

	public function load_resources() {
		add_action( 'admin_enqueue_scripts', [ $this, 'add_woordle_styles' ] );
	}

	public function add_woordle_styles( $hook ) {
		wp_enqueue_style( 'woordle-admin', WOORDLE_BACKEND_RESOURCES_URL . '/css/woordle-admin.css' );
	}
}