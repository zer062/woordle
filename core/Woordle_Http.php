<?php

class Woordle_Http {

	public static function request($url, $data) {
		return Woordle_Requests::post($url, [], $data);
	}
}