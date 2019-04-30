<?php
if (! defined ('ABSPATH') ) exit;

function woordle_sync_category_course_moodle( $category_id ) {

	if ( !isset( $_POST['taxonomy'] ) || $_POST['taxonomy'] != 'category_course' ) {
		return;
	}

	$term_id = str_replace( 'term_', '', $category_id );
	$sync_category_moodle = get_field( 'woordle_migrate_category_moodle', 'category_course_' . $term_id );

	if ( $sync_category_moodle == null || $sync_category_moodle == false) {
		return;
	}

	$category = get_term_by( 'term_id', $term_id, 'category_course' );
	$moodle_category_id = get_field( '_woordle_moodle_category_id', 'category_course_' . $term_id );

	if ( is_null( $moodle_category_id ) ) {
		try {
			$moodle_category = (new Moodle_Category())->create_moodle_category(
				$category->name,
				$category->term_id,
				($category->parent == 0) ? null : $category->parent,
				$category->description
			);
			update_field( '_woordle_moodle_category_id', $moodle_category->id, 'category_course_' . $term_id );
		} catch (Exception $exception) {
			wp_die(__( 'Error on Sync Moodle: ', 'woordle' ) . $exception->getMessage() );
		}
	} else {
		try {
			(new Moodle_Category())->update_moodle_category(
				$moodle_category_id,
				$category->name,
				$category->term_id,
				($category->parent == 0) ? null : $category->parent,
				$category->description
			);
		} catch (Exception $exception) {
			wp_die(__( 'Error on Sync Moodle: ', 'woordle' ) . $exception->getMessage() );
		}
	}
}
add_action( 'acf/save_post', 'woordle_sync_category_course_moodle', 20 );