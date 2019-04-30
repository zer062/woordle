<?php
if (! defined ('ABSPATH') ) exit;
class Woordle_Response {

	public $status_code;

	public $body;

	public function __construct($status_code, $body) {
		$this->status_code = $status_code;
		$this->body = $body;
	}
}