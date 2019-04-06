<?php

class Woordle_Template {

	public function init_templates() {
		add_filter( 'template_include', [ $this, 'load_templates' ] );
	}

	public function load_templates( $template ) {
		global $post;

		if ($post->post_type == 'courses' ) {
			woo_load_template( 'single-course' );
		}

		return $template;
	}
}