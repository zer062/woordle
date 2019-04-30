<?php
if (! defined ('ABSPATH') ) exit;

class Moodle_Enrolment extends Woordle_Moodle {

	public function __construct() {
		parent::__construct();
	}

	public function enrol_student( $course_id, $user_id ) {
		$enrolment = [
			'enrolments' => [
				[
					'roleid' => 5,
					'userid' => $user_id,
					'courseid' => $course_id
				]
			]
		];

		$response = $this->request( 'enrol_manual_enrol_users' )
		                 ->params( $enrolment )
		                 ->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}
		return true;
	}
}