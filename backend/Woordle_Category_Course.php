<?php
if (! defined ('ABSPATH') ) exit;

class Woordle_Category_Course {

	public function __construct() {
		add_filter( 'manage_edit-category_course_columns', [ $this, 'add_moodle_migrate_status_column' ] );
		add_action( 'manage_category_course_custom_column' , [ $this, 'category_course_moodle_migrated_column' ], 10, 3 );
	}

	/**
	 * @param $columns
	 *
	 * @return mixed
	 */
	public function add_moodle_migrate_status_column( $columns ) {
		$columns['moodle_migrated'] = __( 'Migrated to Moodle', 'woordle' );
		return $columns;
	}

	/**
	 * @param string $empty
	 * @param $column
	 * @param $term_id
	 */
	public function category_course_moodle_migrated_column( $empty = '',  $column, $term_id ) {
		switch ($column) {
			case 'moodle_migrated':
				$category_migrated = get_field( '_woordle_moodle_category_id', 'category_course_' . $term_id );

				if ( is_null( $category_migrated ) ) {
					echo '<span class="dashicons dashicons-dismiss wo-danger wo-column-icon" title="' . __( 'This category has not be migrated to Moodle yet', 'woordle' ) . '"></span>';
				} else {
					echo '<span class="dashicons dashicons-yes wo-success wo-column-icon" title="' . __( 'This category has be migrated to Moodle', 'woordle' ) . '"></span>';
				}
				break;
		}
	}
}