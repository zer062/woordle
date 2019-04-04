<?php
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
}