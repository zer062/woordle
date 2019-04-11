<?php

/**
 * Check if Woordle will use Woocommerce
 * @return bool
 */
function woo_use_woocommerce() {
	$use_woocommerce = get_option( 'woordle_sale_course_woocommerce' );

	if ( !is_null( $use_woocommerce ) && $use_woocommerce == 1) {
		return true;
	}
	return false;
}

/**
 * Check if Woocommerce is actived
 * @return bool
 */
function woo_has_woocommerce() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	} else {
		return false;
	}
}

function woo_register_course_product_type() {

	class WC_Product_Course extends WC_Product {
		public function __construct( $product = 0 ) {
			$this->product_type = 'course';
			parent::__construct( $product );
		}
	}
}

function woo_course_product_class( $classname, $product_type ) {

	if ( $product_type == 'course' ) { // notice the checking here.
		$classname = 'WC_Product_Course';
	}

	return $classname;
}

add_filter( 'woocommerce_product_class', 'woo_course_product_class', 10, 2 );

if ( woo_has_woocommerce() && woo_use_woocommerce() ) {
	add_action( 'init', 'woo_register_course_product_type' );
}

function woo_add_course_product( $types ){
	// Key should be exactly the same as in the class
	$types[ 'course' ] = __( 'Woordle Course', 'woordle' );
	return $types;
}

if ( woo_has_woocommerce() && woo_use_woocommerce() ) {
	add_filter( 'product_type_selector', 'woo_add_course_product' );
}

function woo_course_custom_js() {
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

if ( woo_has_woocommerce() && woo_use_woocommerce() ) {
	add_action( 'admin_footer', 'woo_course_custom_js' );
}

function woo_course_product_tabs( $tabs) {
	$tabs['course'] = array(
		'label'		=> __( 'Woordle Course', 'woordle' ),
		'target'	=> 'course_options',
		'class'		=> array( 'show_if_course', 'show_if_variable_course'  ),
	);
	return $tabs;
}

if ( woo_has_woocommerce() && woo_use_woocommerce() ) {
	add_filter( 'woocommerce_product_data_tabs', 'woo_course_product_tabs' );
}
/**
 * Contents of the rental options product tab.
 */
function woo_course_options_product_tab_content() {

	include WOORDLE_BACKEND_PATH . '/templates/woocommerce/woordle-course-product-tab.php';
}

if ( woo_has_woocommerce() && woo_use_woocommerce() ) {
	add_action( 'woocommerce_product_data_panels', 'woo_course_options_product_tab_content' );
}
      /**
       * Save the custom fields.
       */
//      function save_rental_option_field( $post_id ) {
//	      $rental_option = isset( $_POST['_enable_course_option'] ) ? 'yes' : 'no';
//	      update_post_meta( $post_id, '_enable_course_option', $rental_option );
//	      if ( isset( $_POST['_text_input_y'] ) ) :
//		      update_post_meta( $post_id, '_text_input_y', sanitize_text_field( $_POST['_text_input_y'] ) );
//	      endif;
//      }
//      add_action( 'woocommerce_process_product_meta_course', 'save_rental_option_field'  );
//      add_action( 'woocommerce_process_product_meta_variable_course', 'save_rental_option_field'  );
      /**
       * Hide Attributes data panel.
       */
function woo_hide_course_attributes_data_panel( $tabs ) {
	$tabs['attribute']['class'][] = 'hide_if_course hide_if_variable_course';
	return $tabs;
}

if ( woo_has_woocommerce() && woo_use_woocommerce() ) {
	add_filter( 'woocommerce_product_data_tabs', 'woo_hide_course_attributes_data_panel' );
}