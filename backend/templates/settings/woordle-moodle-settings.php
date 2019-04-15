<?php
$woordle_moodle_url = get_option( 'woordle_moodle_url' );
$woordle_moodle_token = get_option( 'woordle_moodle_token' );
?>
<h2>Woordle Moodle settings</h2>

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
</table>