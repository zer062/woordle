<?php
if (! defined ('ABSPATH') ) exit;
$woordle_moodle_url = get_option( 'woordle_moodle_url' );
$woordle_moodle_token = get_option( 'woordle_moodle_token' );
$woordle_use_woocommerce_account_page = get_option( 'woordle_use_woocommerce_account_page' );
$woordle_auto_publish_enrol = get_option( 'woordle_auto_publish_enrol' );
?>

<h2>Woordle General settings</h2>

<table class="form-table">
    <tr valign="top">
        <th scope="row"><?php _e( 'Moodle URL', 'woordle' );?></th>
        <td>
            <input type="text" name="woordle_moodle_url" size="60" value="<?php echo esc_attr( $woordle_moodle_url ); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e( 'Moodle Webservice token', 'woordle' );?></th>
        <td>
            <input type="text" name="woordle_moodle_token" size="60" value="<?php echo esc_attr( $woordle_moodle_token ); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e( 'Use Woocommerce Account page like Student Account?', 'woordle' );?></th>
        <td>
            <input type="checkbox" name="woordle_use_woocommerce_account_page" value="1" <?php echo ( !is_null( $woordle_use_woocommerce_account_page ) && $woordle_use_woocommerce_account_page == '1' ) ? 'checked' : '';?> />
            <span>But you can use <b>[central_student]</b> shortcode in some page.</span>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e( 'Auto publish enrolment', 'woordle' );?></th>
        <td>
            <input type="checkbox" name="woordle_auto_publish_enrol" value="1" <?php echo ( !is_null( $woordle_auto_publish_enrol ) && $woordle_auto_publish_enrol == '1' ) ? 'checked' : '';?> />
            <span>For default, when one user enrol in any course, the enrolment is created with <b>'Draft'</b> status. Defining this like true, all enrolments will created like published status </span>
        </td>
    </tr>
</table>