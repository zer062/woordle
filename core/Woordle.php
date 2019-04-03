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
	}

	private function init_ctp() {
		$this->loader->load_models();
	}
}