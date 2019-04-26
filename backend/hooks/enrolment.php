<?php

function woo_enrol_user_course() {

	if ( $_POST && isset( $_POST['_woo_enrol_token'] ) ) {
		if ( !wp_verify_nonce( $_POST['_woo_enrol_token'], '_woo_action_enrol_' . $_POST['_woo_enrol_course'] ) ) {
			wp_redirect($_POST['_wp_http_referer'] . '?woo_error=invalid_token');
			die;
		}

		$course_id = $_POST['_woo_enrol_course'];
		$sale_woocommerce = get_field( 'woordle_woocommerce_settings_woordle_sale_course_woocommerce', $course_id );
		$course_product = get_posts([
			'post_type' => 'product',
			'post_parent' => $course_id
		]);

		if ( $sale_woocommerce ) {

			if ( !empty( $course_product ) ) {
				$product = new WC_Product( $course_product[0]->ID );
				add_action( 'wp', function() use($product, $course_id) {
					WC()->cart->add_to_cart( $product->get_id(), 1 );
					$url = get_permalink( get_option( 'woocommerce_checkout_page_id' ) );
					woo_enrol_course( $course_id );
					wp_redirect( $url ); die;
				});
			} else {
				woo_enrol_course( $course_product[0] );
			}
		} else {
			woo_enrol_course( $course_product[0] );
		}
	}
}

function woo_enrol_course ( $course_id ) {
	$user = wp_get_current_user();
	$enrol_id = wp_insert_post([
		'post_type' => 'enrolment',
		'post_title' => '#' . $course_id . $user->ID,
		'post_status' => 'draft',
		'post_parent' => $course_id
	]);

	update_field( 'enrol_woordle_enrolment_course', $course_id, $enrol_id );
	update_field( 'enrol_woordle_enrolment_user', $user->ID, $enrol_id );
	update_field( 'enrol_woordle_enrolment_role', 'student', $enrol_id );
	return true;
}


add_action( 'woo_enrol_course_woocommerce', '' );

add_action( 'init', 'woo_enrol_user_course' );

function woo_course_enrol_button() {
	global $post;
?>
	<form method="post">
		<input type="hidden" name="_woo_enrol_course" value="<?php the_ID();?>">
		<?php wp_nonce_field('_woo_action_enrol_' . get_the_ID(), '_woo_enrol_token', true, true); ?>
		<button type="submit"><?php _e( 'Enrol this course');?></button>
	</form>
<?php
}

add_action( 'woo_enrol_course_html', 'woo_course_enrol_button' );

function woo_show_alerts () {
	if ( isset( $_GET['woo_error'] ) ) {

		if ( $_GET['woo_error'] === 'invalid_token' ) {
			echo '<div class="woo-alert">' . __( 'Invalid token. Please, reload and try again', 'woordle' ) . '</div>';
		}
	}
}

add_action( 'woo_alerts', 'woo_show_alerts' );

