<?php
if (! defined ('ABSPATH') ) exit;
/**
 * @package Woordle/Core
 */

class Woordle_Loader {

	public function load_models() {
		(new Woordle_CTP())->init_woordle_ctp();
	}

	public function setup_woordle_admin_menu() {
		(new Woordle_Menu())->setup_woordle_menu();
	}

	public function load_admin_resources() {
		$woordle_admin_resources = new Woordle_Admin_Resources();
		$woordle_admin_resources->load_resources();
	}

	public function load_resources() {
		$woordle_resources = new Woordle_Resources();
		$woordle_resources->load_resources();
	}

	public function load_woordle_options() {
		$options = new Woordle_Options();
		return $options;
	}

	public function flush_rules() {
		flush_rewrite_rules();
	}
}