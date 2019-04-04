<?php

class Woordle_Menu {

	public function setup_woordle_menu() {
		add_action( 'admin_menu', [ $this, 'create_woordle_admin_menu' ] );
		add_action('parent_file', [ $this, 'fix_category_course_navigation' ] );
	}

	public function create_woordle_admin_menu() {
		// Add Woordle main page
		add_menu_page(
			__( 'Woordle', 'woordle' ),
			__( 'Woordle', 'woordle' ),
			'edit_posts',
			'woordle',
			[ $this, 'woordle_wellcome_page' ],
			'dashicons-welcome-learn-more',
			'30'
		);

		add_submenu_page(
			'woordle',
			__( 'Course categories', 'woordle' ),
			__( 'Course categories', 'woordle' ),
			'edit_posts',
			'edit-tags.php?taxonomy=category-course',
			false
		);
	}

	public function fix_category_course_navigation() {
		global $current_screen;
		$taxonomy = $current_screen->taxonomy;
		if ( $taxonomy == 'category-course' ) {
			$parent_file = 'woordle';
		}
		return $parent_file;
	}
}