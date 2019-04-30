<?php
if (! defined ('ABSPATH') ) exit;

/**
 * Check if Woocommerce is actived
 * @return bool
 */
function woordle_has_woocommerce() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	} else {
		return false;
	}
}

function woordle_register_course_product_type() {

	class WC_Product_Course extends WC_Product {
		public function __construct( $product = 0 ) {
			$this->product_type = 'course';
			parent::__construct( $product );
		}
	}
}

if ( woordle_has_woocommerce() ) {
	add_action( 'plugins_loaded', 'woordle_register_course_product_type' );
}

function woordle_course_product_class( $classname, $product_type ) {

	if ( $product_type == 'course' ) { // notice the checking here.
		$classname = 'WC_Product_Course';
	}

	return $classname;
}

if ( woordle_has_woocommerce() ) {
	add_filter( 'woocommerce_product_class', 'woordle_course_product_class', 10, 2 );
}

function woordle_add_course_product( $types ){
	$types[ 'course' ] = __( 'Woordle Course', 'woordle' );
	return $types;
}

if ( woordle_has_woocommerce() ) {
	add_filter( 'product_type_selector', 'woordle_add_course_product' );
}

function woordle_course_custom_js() {
	if ( 'product' != get_post_type() ) {
		return;
    }

	?><script type='text/javascript'>
        jQuery( document ).ready( function() {
            jQuery( '.options_group.pricing' ).addClass( 'show_if_course' ).show();
            jQuery( '.shipping_tab' ).addClass( 'hide_if_course' ).hide();
            jQuery( '#shipping_product_data' ).addClass( 'hide_if_course' ).hide();
            jQuery( '#general_product_data' ).show();
            jQuery( '.general_options' ).addClass( 'show_if_course' ).addClass( 'active').show();
        });
	</script><?php
}

if ( woordle_has_woocommerce() ) {
	add_action( 'admin_footer', 'woordle_course_custom_js' );
}

function woordle_course_product_tabs( $tabs) {
	$tabs['course'] = array(
		'label'		=> __( 'Woordle Course', 'woordle' ),
		'target'	=> 'course_options',
		'class'		=> array( 'show_if_course', 'show_if_variable_course'  ),
	);
	return $tabs;
}

if ( woordle_has_woocommerce() ) {
	add_filter( 'woocommerce_product_data_tabs', 'woordle_course_product_tabs' );
}
/**
 * Contents of the rental options product tab.
 */
function woordle_course_options_product_tab_content() {

	include WOORDLE_BACKEND_PATH . '/templates/woocommerce/woordle-course-product-tab.php';
}

if ( woordle_has_woocommerce() ) {
	add_action( 'woocommerce_product_data_panels', 'woordle_course_options_product_tab_content' );
}

function woordle_hide_course_attributes_data_panel( $tabs ) {
	$tabs['attribute']['class'][] = 'hide_if_course hide_if_variable_course';
	return $tabs;
}

if ( woordle_has_woocommerce() ) {
	add_filter( 'woocommerce_product_data_tabs', 'woordle_hide_course_attributes_data_panel' );
}