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

	public function setTab( $tab_name, $tab_title, $tab_template ) {
		$this->tabs[] = [
			'name' => $tab_name,
			'title' => $tab_title,
			'template' => $tab_template
		];
	}

	public function set_default_tabs() {
		$this->setTab(
			'general_settings',
			__( 'General Settings', 'woordle' ),
			WOORDLE_BACKEND_PATH . '/templates/woordle-general-settings.php'
		);

		$this->setTab(
			'moodle_settings',
			__( 'Moodle Settings', 'woordle' ),
			WOORDLE_BACKEND_PATH . '/templates/woordle-moodle-settings.php'
		);
	}

	public function get_tabs() {
		return $this->tabs;
	}
}