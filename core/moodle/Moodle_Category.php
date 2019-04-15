<?php

class Moodle_Category extends Woordle_Moodle {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get Moodle category
	 * @param $id
	 *
	 * @return stdClass|null
	 * @throws Exception
	 */
	public function get_category( $id ) {

		$criteria = [
			'criteria' => [
				[
					'key' => 'id',
					'value' => "{$id}"
				]
			]
		];
		$response = $this->request( 'core_course_get_categories' )
			->params($criteria)
			->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		if ( count( $response->body ) == 0 ) {
			return null;
		}

		return $response->body[0];
	}

	public function create_moodle_category( $name, $course_category_id, $parent = null, $description = null ) {

		$category = [
			'categories' => [
				'name' => $name,
				'idnumber' => $course_category_id,
				'description' => $description
			]
		];

		if ( !is_null( $parent ) ) {

			if ( is_null( $this->get_category( $parent ) ) ) {
				wp_die(
					__(
						'Error on sync Moodle: Parent category has not sync yet. Please sync parent category first.',
						'woordle'
					)
				);
			}
			
			$category['categories'][0]['parent'] = $parent;
		}

		$response = $this->request( 'core_course_create_categories' )
			->params( $category )
			->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		return $response->body[0];
	}

	public function update_moodle_category( $category_id, $name, $course_category_id, $parent = null, $description = null ) {
		$_moodle_category = $this->get_category( $category_id );

		if ( is_null( $_moodle_category ) ) {
			return $this->create_moodle_category(
				$name,
				$course_category_id,
				$parent,
				$description
			);
		}

		$category = [
			'categories' => [
				'id' => $_moodle_category,
				'name' => $name,
				'idnumber' => $course_category_id,
				'description' => $description
			]
		];

		if ( !is_null( $parent ) ) {

			if ( is_null( $this->get_category( $parent ) ) ) {
				wp_die(
					__(
						'Error on sync Moodle: Parent category has not sync yet. Please sync parent category first.',
						'woordle'
					)
				);
			}

			$category['categories'][0]['parent'] = $parent;
		}

		$response = $this->request( 'core_course_update_categories' )
			->params( $category )
			->get();

		if ( isset( $response->body->exception ) ) {
			throw new Exception( $response->body->exception, $response->body->exception );
		}

		return $response->body[0];
	}
}