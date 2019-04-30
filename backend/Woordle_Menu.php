<?php
if (! defined ('ABSPATH') ) exit;

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
			__( 'Course Categories', 'woordle' ),
			__( 'Course Categories', 'woordle' ),
			'edit_posts',
			'edit-tags.php?taxonomy=category_course',
			false
		);

		add_submenu_page(
			'woordle',
			__( 'Settings', 'woordle' ),
			__( 'Settings', 'woordle' ),
			'manage_options',
			'woordle-settings',
			[ $this, 'load_woordle_settings_page' ]
		);
	}

	public function load_woordle_settings_page() {
		include WOORDLE_BACKEND_PATH . '/templates/settings/woordle-settings-main.php';
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