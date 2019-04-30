<?php
if (! defined ('ABSPATH') ) exit;
class Woordle_CTP {

	public function init_woordle_ctp() {
		add_action( 'init', [ $this, 'register_posts' ] );
		add_action( 'init', [ $this, 'register_taxonomies' ] );

		new Woordle_Category_Course();
	}

	public function scan_ctp() {
		$files = scandir( WOORDLE_MODELS_PATH );
		unset( $files[0] );
		unset( $files[1] );
		return $files;
	}

	public function register_posts() {

		$post_types = $this->scan_ctp();

		foreach ( $post_types as $post ) {
			$post_type_name = str_replace('.php', '', $post );
			$post_type_file = WOORDLE_MODELS_PATH . "/{$post}";
			$post_type_args = require_once ( $post_type_file );
			register_post_type( $post_type_name, $post_type_args );
		}
		flush_rewrite_rules();
	}

	public function scan_taxomonies() {
		$files = scandir( WOORDLE_TAXONOMIES_PATH );
		unset( $files[0] );
		unset( $files[1] );
		return $files;
	}

	public function register_taxonomies() {

		$taxonomies = $this->scan_taxomonies();

		foreach ( $taxonomies as $tax ) {
			$tax_name = str_replace('.php', '', $tax );
			$tax_data = explode( '-', $tax_name );
			$tax_file = WOORDLE_TAXONOMIES_PATH . "/{$tax}";
			$tax_args = require_once ( $tax_file );
			register_taxonomy( $tax_data[1], $tax_data[0], $tax_args );;
		}
	}
}