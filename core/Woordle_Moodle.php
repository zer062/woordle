<?php
if (! defined ('ABSPATH') ) exit;

class Woordle_Moodle {

	private $url_base;

	private $moodle_token;

	private $endpont;

	private $parameters = [];

	public function __construct() {
		$this->url_base = get_option( 'woordle_moodle_url' );
		$this->moodle_token = get_option( 'woordle_moodle_token' );
	}

	public function request( $action ) {
		$this->endpont  = $this->url_base . "/webservice/rest/server.php?wstoken={$this->moodle_token}&wsfunction={$action}&moodlewsrestformat=json";
		return $this;
	}

	public function params( $parameters ) {
		$this->parameters = $parameters;
		return $this;
	}

	protected function get(){
		$_response = Woordle_Http::request( $this->endpont, $this->parameters );
		$response = new Woordle_Response( $_response->status_code, json_decode( $_response->body ) );
		return $response;
	}
}