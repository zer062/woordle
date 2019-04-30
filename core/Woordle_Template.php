<?php
if (! defined ('ABSPATH') ) exit;

class Woordle_Template {

	public function init_templates() {
		add_filter( 'template_include', [ $this, 'load_templates' ] );
	}

	public function load_templates( $template ) {
		global $post;

		if ( is_single( 'courses' ) || ( !is_null( $post ) && $post->post_type == 'courses' ) ) {

			$template = WOORDLE_FRONTEND_PATH . '/templates/single-courses.php';

			if ( file_exists( get_stylesheet_directory() . '/single-courses.php' ) ) {
				$template = get_stylesheet_directory() . '/single-courses.php';
			}
		}

		if ( is_post_type_archive( 'courses') ) {
			$template = WOORDLE_FRONTEND_PATH . '/templates/archive-courses.php';

			if ( file_exists( get_stylesheet_directory() . '/archive-courses.php' ) ) {
				$template = get_stylesheet_directory() . '/archive-courses.php';
			}
		}

		return $template;
	}
}