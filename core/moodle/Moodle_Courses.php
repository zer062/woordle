<?php

class Moodle_Course extends Woordle_Moodle {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get Moodle course by Woordle Course ID.
	 * @param $id
	 *
	 * @return stdClass|null
	 * @throws Exception
	 */
	public function get_course( $id ) {

		$response = $this->request( 'core_course_get_courses_by_field' )
		                 ->params( [ 'field' => 'idnumber', 'value' => $id ] )
		                 ->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		if ( count( $response->body->courses ) == 0 ) {
			return null;
		}

		return $response->body->courses[0];
	}
}
