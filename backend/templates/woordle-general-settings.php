<?php
$notify_user_course_enrol_details = get_option( 'notify_user_course_enrol_details' );
$notify_user_enrolment_actived = get_option( 'notify_user_enrolment_actived' );
$notify_user_course_start = get_option( 'notify_user_course_start' );
?>

<table class="form-table">
	<tr valign="top">
		<th scope="row"><?php _e( 'Notify user with user details', 'woordle' );?></th>
		<td>
			<input type="checkbox" name="notify_user_course_enrol_details" value="1" <?php echo ( !is_null( $notify_user_course_enrol_details ) && $notify_user_course_enrol_details ==  "1" ) ? 'checked' : '' ;?> >
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><?php _e( 'Notify user when enrolment is actived', 'woordle' );?></th>
		<td>
			<input type="checkbox" name="notify_user_enrolment_actived" value="1" <?php echo ( !is_null( $notify_user_enrolment_actived ) && $notify_user_enrolment_actived ==  "1" ) ? 'checked' : '' ;?> >
		</td>
	</tr>

    <tr valign="top">
        <th scope="row"><?php _e( 'Notify user when course will start', 'woordle' );?></th>
        <td>
            <input type="checkbox" name="notify_user_course_start" value="1" <?php echo ( !is_null( $notify_user_course_start ) && $notify_user_course_start ==  "1" ) ? 'checked' : '' ;?> >
        </td>
    </tr>

</table>