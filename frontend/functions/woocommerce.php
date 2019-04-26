<?php

function iconic_account_menu_items( $items ) {
	$_temp_logout = $items['customer-logout'];
	unset($items['customer-logout']);
	$items['courses'] = __( 'My Courses', 'woordle' );
	$items['customer-logout'] = $_temp_logout;
	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'iconic_account_menu_items', 10, 1 );

function woo_add_my_courses_endpoint() {
	add_rewrite_endpoint( 'courses', EP_PAGES );
}

add_action( 'init', 'woo_add_my_courses_endpoint' );

function woo_my_courses_endpoint_content() {
	include_once ( WOORDLE_FRONTEND_PATH . '/templates/student-center.php' );
}

add_action( 'woocommerce_account_courses_endpoint', 'woo_my_courses_endpoint_content' );