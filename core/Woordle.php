<?php
/**
 * @package Woordle/Core
 */

class Woordle
{
	private $loader;

	public function __construct() {
		$this->loader = new Woordle_Loader();
		$this->init_ctp();
		$this->load_vendors();
	}

	private function init_ctp() {
		$this->loader->load_models();
		$this->loader->setup_woordle_admin_menu();
	}

	private function load_vendors() {
		$vendors = new Woordle_Vendors();
		$vendors->load_acf();
	}

}