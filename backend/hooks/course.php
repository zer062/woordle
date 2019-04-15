<?php

function woo_save_course( $course_id ) {
	
	if( isset( $_POST['post_type'] ) && $_POST['post_type'] != 'courses' ) {
		return;
	}
	$sync_woocommerce_product = get_field(
		'woordle_course_information_woordle_sale_course_woocommerce',
		$course_id
	);
	if ( woo_has_woocommerce() && woo_use_woocommerce() && $sync_woocommerce_product == 1) {
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