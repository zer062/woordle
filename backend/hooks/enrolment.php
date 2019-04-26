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
					wp_redirect( $url ); die;
				});
			} else {
				woo_enrol_course( $course_product[0] );
			}
		} else {
			woo_enrol_course( $course_id );
		}
	}
}

function woo_enrol_course ( $course_id ) {
	$woordle_auto_publish_enrol = get_option( 'woordle_auto_publish_enrol' );
	$user = wp_get_current_user();
	$enrol_id = wp_insert_post([
		'post_type' => 'enrolment',
		'post_title' => '#' . $course_id . $user->ID,
		'post_status' => ( $woordle_auto_publish_enrol != null && $woordle_auto_publish_enrol == '1' ) ? 'publish' : 'draft',
		'post_parent' => $course_id,
        'post_author' => $user->ID,
	]);
	update_field( 'enrol_woordle_enrolment_role', 'student', $enrol_id );
	return true;
}
add_action( 'init', 'woo_enrol_user_course' );

function woo_create_enrol_after_new_order( $order_id ) {

    $order = wc_get_order( $order_id );
    foreach ( $order->get_items() as $order_product ) {
        $product = wc_get_product( $order_product->get_data()['product_id'] );

        if ( $product->get_type() === 'course' ) {
            woo_enrol_course( $product->parent_id );
        }
    }
}

add_action( 'woocommerce_checkout_order_processed', 'woo_create_enrol_after_new_order',  1, 1  );

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

function woo_add_enrolment_metaboxes() {
	add_meta_box(
		'woordle_enrol_details',
		__( 'Enrolment details', 'woordle' ),
		'woo_load_enroment_settings',
		'enrolment',
		'normal',
		'high'
	);
}

add_action( 'add_meta_boxes', 'woo_add_enrolment_metaboxes' );

function woo_load_enroment_settings () {
	include ( WOORDLE_BACKEND_PATH . '/templates/enrolment/enrolment-details.php');
}
function woo_auto_publish_enrolment( $order_id, $old_status, $new_status, $order ) {

    if ( $new_status === 'completed' ) {
	    foreach ( $order->get_items() as $order_product ) {
		    $product = wc_get_product( $order_product->get_data()['product_id'] );

		    if ( $product->get_type() === 'course' ) {
		        $enrol = new WP_Query([
		            'post_type' => 'enrolment',
                    'post_parent' => $product->get_data()['parent_id'],
                    'post_author' => $order->get_data()['customer_id'],
                    'post_status' => 'draft'
                ]);
		        wp_publish_post( $enrol->post );
		    }
	    }
    }
};

add_action( 'woocommerce_order_status_changed', 'woo_auto_publish_enrolment', 10, 4 );

function woo_enrolment_columns( $columns ) {
	unset( $columns['comments'] );
	unset( $columns['date'] );
	$columns['woordle_enrolment_student'] = __( 'Student', 'woordle' );
	$columns['date'] = __( 'Date' );
	return $columns;
}

add_filter( 'manage_enrolment_posts_columns', 'woo_enrolment_columns' );

function manage_enrolment_column( $column, $post_id ) {
	switch ( $column ) {

		case 'woordle_enrolment_student' :
		    $enrol = get_post ( $post_id );
		    $student = get_user_by( 'ID', $enrol->post_author );

		    echo $student->display_name;
			break;
	}
}

add_action( 'manage_enrolment_posts_custom_column' , 'manage_enrolment_column', 10, 2 );

function post_published_notification( $ID, $post ) {

    $student = get_user_by( 'ID', $post->post_author );
    $moodle_course = (new Moodle_Course())->get_course( $post->post_parent );

    if ( !is_null( $moodle_course ) ) {
        $moodle_user = (new Moodle_User())->get_moodle_user( $student->ID );

        if ( is_null( $moodle_user ) ) {
            (new Moodle_User())->create_moodle_user(
                $student->user_login,
                $student->first_name,
                $student->first_name,
                $student->user_email,
                $student->ID
            );

	        $moodle_user = (new Moodle_User())->get_moodle_user( $student->ID );
        }

	    (new Moodle_Enrolment())->enrol_student( $moodle_course->id, $moodle_user->id );
    }
}

add_action( 'publish_enrolment', 'post_published_notification', 10, 2 );