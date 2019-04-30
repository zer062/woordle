<?php
if (! defined ('ABSPATH') ) exit;
/**
 * @package Woordle/Core
 */

class Woordle
{
	private $loader;

	static $instance;

	private $woordle_options;

	public function __construct() {
		$this->loader = new Woordle_Loader();
		$this->woordle_options = new Woordle_Options();
		$this->init_ctp();
		$this->load_vendors();
		$this->load_resources();
		$this->load_templates();
	}

	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new Woordle();
		}

		return self::$instance;
	}

	private function init_ctp() {
		$this->loader->load_models();
		$this->loader->setup_woordle_admin_menu();
	}

	private function load_vendors() {
		$vendors = new Woordle_Vendors();
		$vendors->load_acf();
		$vendors->load_request();
	}

	private function load_resources() {
		$this->loader->load_admin_resources();
		$this->loader->load_resources();
	}

	private function load_templates() {
		$woordle_templates = new Woordle_Template();
		$woordle_templates->init_templates();
	}

	public function woordle_options() {
		return $this->woordle_options;
	}

	public function get_option_tabs() {
		return $this->woordle_options->get_tabs();
	}
}