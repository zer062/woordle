<?php
if (! defined ('ABSPATH') ) exit;

function woordle_admin_menu_items( $items ) {

	$add_tab = get_option( 'woordle_use_woocommerce_account_page' );

	if ( $add_tab == '1') {
		$_temp_logout = $items['customer-logout'];
		unset($items['customer-logout']);
		$items['courses'] = __( 'My Courses', 'woordle' );
		$items['customer-logout'] = $_temp_logout;
	}
	return $items;
}
add_filter( 'woocommerce_account_menu_items', 'woordle_admin_menu_items', 10, 1 );

function woordle_add_my_courses_endpoint() {
	add_rewrite_endpoint( 'courses', EP_PAGES );
}

add_action( 'init', 'woordle_add_my_courses_endpoint' );

function woordle_my_courses_endpoint_content() {
	include_once ( WOORDLE_FRONTEND_PATH . '/templates/student-center.php' );
}

add_action( 'woocommerce_account_courses_endpoint', 'woordle_my_courses_endpoint_content' );