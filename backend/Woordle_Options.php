<?php

class Woordle_Options {

	protected $options;

	protected  $tabs = [];

	public function __construct() {
		$this->options = require WOORDLE_BACKEND_PATH . '/options/settings.php';
		$this->set_default_tabs();
		add_action( 'admin_init', [ $this, 'register_woordle_options' ] );
	}

	public function register_woordle_options() {

		foreach ($this->options as $option) {
			register_setting( 'woordle-settings-group', $option );
		}
	}

	public function setTab( $tab_name, $tab_title, $tab_template, $condition = true ) {

		if ( $condition ) {
			$this->tabs[] = [
				'name' => $tab_name,
				'title' => $tab_title,
				'template' => $tab_template
			];
		}
	}

	public function set_default_tabs() {
		$this->setTab(
			'woordle_general_settings',
			__( 'General Settings', 'woordle' ),
			WOORDLE_BACKEND_PATH . '/templates/settings/woordle-general-settings.php'
		);

//		$this->setTab(
//			'woordle_woocommerce_settings',
//			__( 'Woocommerce Settings', 'woordle' ),
//			WOORDLE_BACKEND_PATH . '/templates/settings/woordle-woocommerce-settings.php',
//			( woo_use_woocommerce() && woo_has_woocommerce() )
//		);

		$this->setTab(
			'woordle_moodle_settings',
			__( 'Moodle Settings', 'woordle' ),
			WOORDLE_BACKEND_PATH . '/templates/settings/woordle-moodle-settings.php'
		);
	}

	public function get_tabs() {
		return $this->tabs;
	}
}