<?php

class Woordle_Menu {

	/**
	 * Setup woordle admin menu actions
	 */
	public function setup_woordle_menu() {
		add_action( 'admin_menu', [ $this, 'create_woordle_admin_menu' ] );
		add_action('parent_file', [ $this, 'fix_category_course_navigation' ] );
	}

	/**
	 * Create woordle menus
	 */
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
			'edit-tags.php?taxonomy=category_course',
			false
		);
	}

	/**
	 * Fix category course taxonomy navigations. Active woordle main menu
	 * @return string
	 */
	public function fix_category_course_navigation( $parent_file ) {
		global $current_screen;
		$taxonomy = $current_screen->taxonomy;
		if ( $taxonomy == 'category_course' ) {
			$parent_file = 'woordle';
		}
		return $parent_file;
	}
}