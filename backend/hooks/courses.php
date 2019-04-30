<?php
if (! defined ('ABSPATH') ) exit;

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'woordle_flush_rewrites' );
function woordle_flush_rewrites() {
	flush_rewrite_rules();
}

function woordle_courses_columns( $columns ) {
	unset( $columns['date'] );
	unset( $columns['comments'] );
	$columns['woordle_course_woocommerce_product'] = __( 'Woocommerce Product', 'woordle' );
	$columns['woordle_course_moodle_id'] = __( 'Moodle Course ID', 'woordle' );
	$columns['date'] = __( 'Date' );
	return $columns;
}

add_filter( 'manage_courses_posts_columns', 'woordle_courses_columns' );

function woordle_manage_courses_column( $column, $post_id ) {
	switch ( $column ) {

		case 'woordle_course_woocommerce_product' :
			$product = get_children( [ 'post_parent' => $post_id, 'post_type' => 'product' ] );

			if ( !empty( $product ) ) {
				echo '<a href="' . get_admin_url() . '/post.php?post=' . reset( $product )->ID . '&action=edit">#' . reset( $product )->ID . '</a>';
			} else {
				_e( 'This course is not sold by Woocommerce', 'woordle' );
			}
			break;

		case 'woordle_course_moodle_id' :
			_e( 'Not migrated to Moodle', 'woordle' );
			break;
	}
}

add_action( 'manage_courses_posts_custom_column' , 'woordle_manage_courses_column', 10, 2 );

function woordle_save_course( $course_id ) {
	if( isset( $_POST['post_type'] ) && $_POST['post_type'] != 'courses' ) {
		return;
	}

	$sync_woocommerce_product = get_field(
		'woordle_woocommerce_settings_woordle_sale_course_woocommerce',
		$course_id
	);

	if ( woordle_has_woocommerce() && $sync_woocommerce_product ) {
		$course = get_post( $course_id );
		woordle_sync_course_product( $course );
	}

	$sync_moodle_course = get_field(
		'woordle_moodle_settings_woordle_course_migrate_moodle',
		$course_id
	);

	if ( $sync_moodle_course ) {
		$course = get_post( $course_id );
		woordle_sync_course_moodle( $course );
	}
}

add_action( 'acf/save_post', 'woordle_save_course', 20 );

function woordle_sync_course_product( $course ) {
	$course_product = new WC_Product_Course();
	$course_parent_product = get_posts([
		'post_type' => 'product',
		'post_parent' => $course->ID
	]);

	if ( !empty( $course_parent_product ) ) {
		$course_product = new WC_Product_Course( $course_parent_product[0]->ID );
	}

	$course_attributes = get_field_objects( $course->ID );
	$course_product->set_name( $course->post_title );
	$course_product->set_parent_id( $course->ID );
	$course_product->set_stock_status();
	$course_product->set_description(
		$course_attributes['woordle_course_information']['value']['woordle_course_description']
	);
	$course_product->set_category_ids(
		[$course_attributes['woordle_woocommerce_settings']['value']['woordle_woocommerce_product_category']->term_id]
	);
	$course_product->set_short_description(
		$course_attributes['woordle_course_information']['value']['woorlde_to_learn']
	);
	$course_product->set_regular_price(
		$course_attributes['woordle_woocommerce_settings']['value']['woordle_woocommerce_course_price']
	);
	$course_product->set_sku(
		$course_attributes['woordle_woocommerce_settings']['value']['woordle_woocommerce_sku']
	);

	if ( has_post_thumbnail( $course->ID ) ) {
		$course_image_id = get_post_thumbnail_id( $course->ID );
		$course_product->set_image_id( $course_image_id );
	}

	$course_product->save();
}

function woordle_set_course_categories( $args, $field, $post_id ) {

	if ( $field['key'] == 'field_5cbd301645c4b' ) {
		$args['meta_query'] = [
			[
				'key'       => '_woordle_moodle_category_id',
				'compare'   => 'EXISTS'
			]
		];
	}
	// modify args
	$args['orderby'] = 'count';
	$args['order'] = 'ASC';
	// return
	return $args;

}

add_filter('acf/fields/taxonomy/query', 'woordle_set_course_categories', 10, 3);

function woordle_sync_course_moodle( $course ) {

	$category = get_field( 'woordle_moodle_settings_woordle_moodle_course_category', $course->ID );
	$category_moodle_id = get_field( '_woordle_moodle_category_id', 'category_course_' . $category->term_id );
	$moodle_course_id = get_field( '_woordle_moodle_course_id' , $course->ID );
	$moodle_format = get_field( 'woordle_moodle_settings_woordle_course_format', $course->ID );

	switch ($moodle_format['value']) {

		case 'topics':
			$moodle_format_sections = get_field( 'woordle_moodle_settings_woordle_course_number_of_sections', $course->ID );
			break;

		case 'singleactivity':
			$moodle_format_sections = get_field( 'woordle_moodle_settings_woordle_course_type_of_activity', $course->ID )['value'];
			break;

		case 'social':
			$moodle_format_sections = get_field( 'woordle_moodle_settings_woordle_course_number_of_discussions', $course->ID );
			break;

		case 'weeks':
			$moodle_format_sections = get_field( 'woordle_moodle_settings_woordle_course_number_of_weeks', $course->ID );
			break;
	}

	if ( is_null( $moodle_course_id ) ) {
		try {
			$moodle_course = (new Moodle_Course())->create_moodle_course(
				$category_moodle_id,
				$course->post_title,
				$course->post_name,
				$course->ID,
				$moodle_format['value'],
				$moodle_format_sections
			);
			update_field( '_woordle_moodle_course_id', $moodle_course->id, $course->ID );
		} catch (Exception $exception) {
			wp_die(__( 'Error on Sync Moodle: ', 'woordle' ) . $exception->getMessage() );
		}

	} else {
		try {
			(new Moodle_Course())->update_moodle_course(
				$moodle_course_id,
				$category_moodle_id,
				$course->post_title,
				$course->post_name,
				$course->ID,
				$moodle_format['value'],
				$moodle_format_sections
			);
		} catch (Exception $exception) {
			wp_die(__( 'Error on Sync Moodle: ', 'woordle' ) . $exception->getMessage() );
		}
	}
}