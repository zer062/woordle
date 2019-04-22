<?php
function woo_courses_columns( $columns ) {
	unset( $columns['date'] );
	unset( $columns['comments'] );
	$columns['woordle_course_woocommerce_product'] = __( 'Woocommerce Product', 'woordle' );
	$columns['woordle_course_moodle_id'] = __( 'Moodle Course ID', 'woordle' );
	$columns['date'] = __( 'Date' );
	return $columns;
}

add_filter( 'manage_courses_posts_columns', 'woo_courses_columns' );

function manage_courses_column( $column, $post_id ) {
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

add_action( 'manage_courses_posts_custom_column' , 'manage_courses_column', 10, 2 );

function woo_save_course( $course_id ) {
	if( isset( $_POST['post_type'] ) && $_POST['post_type'] != 'courses' ) {
		return;
	}

	$sync_woocommerce_product = get_field(
		'woordle_woocommerce_settings_woordle_sale_course_woocommerce',
		$course_id
	);

	if ( woo_has_woocommerce() && $sync_woocommerce_product ) {
		$course = get_post( $course_id );
		woo_sync_course_product( $course );
	}
}

add_action( 'acf/save_post', 'woo_save_course', 20 );

function woo_sync_course_product( $course ) {
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