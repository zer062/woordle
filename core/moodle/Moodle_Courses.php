<?php

class Moodle_Course extends Woordle_Moodle {

	public function __construct() {
		parent::__construct();
	}

	public function get_course_by_id( $id ) {
		$response = $this->request( 'core_course_get_courses_by_field' )
			->params( [ 'field' => 'id', 'value' => $id ] )
			->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		if ( count( $response->body->courses ) == 0 ) {
			return null;
		}

		return $response->body->courses[0];
	}

	public function get_course_by_idnumber( $id ) {
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

	public function get_moodle_course( $moodle_course_id, $moodle_course_idnumber ) {

		$course = $this->get_course_by_id( $moodle_course_id );

		if ( is_null( $course ) ) {
			$course = $this->get_course_by_idnumber( $moodle_course_idnumber );
		}
		return $course;
	}
}
