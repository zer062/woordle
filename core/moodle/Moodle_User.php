<?php
if (! defined ('ABSPATH') ) exit;

class Moodle_User extends Woordle_Moodle {

	public function __construct() {
		parent::__construct();
	}

	public function get_moodle_user( $id ) {
		$criteria = [
			'criteria' => [
				[
					'key' => 'idnumber',
					'value' => trim( $id )
				]
			]
		];

		$response = $this->request( 'core_user_get_users' )
		                 ->params( $criteria )
		                 ->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		if ( count( $response->body->users ) == 0 ) {
			return null;
		}

		return $response->body->users[0];
	}

	public function create_moodle_user( $login, $firstname, $lastname, $email, $id ) {
		$object = [
			'users' => [
				[
					'username' => trim( $login ),
					'firstname' => $firstname,
					'lastname' => $lastname,
					'email' => $email,
					'idnumber' => $id,
					'createpassword' => 1
				]
			]
		];
		$response = $this->request( 'core_user_create_users' )
		                 ->params( $object )
		                 ->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		if ( count( $response->body ) == 0 ) {
			return null;
		}

		return $response->body[0];
	}
}