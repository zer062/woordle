<?php
if (! defined ('ABSPATH') ) exit;

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
	// activitytype
	// numsections
	// numdiscussions
	public function create_moodle_course($category_id, $name, $shortname, $idnumber, $type, $num_sections ) {

		$course = [
			'courses' => [
				[
					'fullname' => $name,
					'shortname' => $shortname,
					'categoryid' => $category_id,
					'idnumber' => $idnumber,
					'format' => $type
				]
			]
		];

		if ( $type === 'social' ) {
			$course['courses'][0]['courseformatoptions'][0]['name'] = 'numdiscussions';
			$course['courses'][0]['courseformatoptions'][0]['value'] = $num_sections;
		}

		if ( $type === 'singleactivity' ) {
			$course['courses'][0]['courseformatoptions'][0]['name'] = 'activitytype';
			$course['courses'][0]['courseformatoptions'][0]['value'] = $num_sections;
		}

		if ( $type === 'topics' ||  $type === 'weeks' ) {
			$course['courses'][0]['courseformatoptions'][0]['name'] = 'numsections';
			$course['courses'][0]['courseformatoptions'][0]['value'] = $num_sections;
		}

		$response = $this->request( 'core_course_create_courses' )
		                 ->params($course)
		                 ->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->message );
		}

		if ( count( $response->body ) == 0 ) {
			return null;
		}

		return $response->body[0];
	}
	public function update_moodle_course($moodle_course_id, $category_id, $name, $shortname, $idnumber, $type, $num_sections ) {
		$course = [
			'courses' => [
				[
					'id' => $moodle_course_id,
					'fullname' => $name,
					'shortname' => $shortname,
					'categoryid' => $category_id,
					'idnumber' => $idnumber,
					'format' => $type
				]
			]
		];

		if ( $type === 'social' ) {
			$course['courses'][0]['courseformatoptions'][0]['name'] = 'numdiscussions';
			$course['courses'][0]['courseformatoptions'][0]['value'] = $num_sections;
		}

		if ( $type === 'singleactivity' ) {
			$course['courses'][0]['courseformatoptions'][0]['name'] = 'activitytype';
			$course['courses'][0]['courseformatoptions'][0]['value'] = $num_sections;
		}

		if ( $type === 'topics' ||  $type === 'weeks' ) {
			$course['courses'][0]['courseformatoptions'][0]['name'] = 'numsections';
			$course['courses'][0]['courseformatoptions'][0]['value'] = $num_sections;
		}

		$response = $this->request( 'core_course_update_courses' )
		                 ->params($course)
		                 ->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->message );
		}

		if ( count( $response->body ) == 0 ) {
			return null;
		}

		return true;
	}
}
