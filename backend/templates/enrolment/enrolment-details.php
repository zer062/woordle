<?php
    if (! defined ('ABSPATH') ) exit;
	global $post;
	$user = get_user_by( 'ID', $post->post_author );
	$course = get_post( $post->post_parent );
?>
<table>
	<tr valign="top">
		<td width="70">
			<?php echo get_avatar( $user->ID, 64 ); ?>
		</td>
		<td>
			<table cellpadding="5" cellspacing="0">
				<tr>
					<td width="70">ID:</td>
					<td><?php echo $user->ID;?></td>
				</tr>
				<tr>
					<td width="70">Name:</td>
					<td><a href="<?php echo get_admin_url() . "/user-edit.php?user_id={$user->ID}&wp_http_referer=%2Fwp-admin%2Fusers.php";?>"><?php echo $user->display_name ;?></a></td>
				</tr>
				<tr>
					<td width="70">Email:</td>
					<td><a href="mailto:<?php echo $user->user_email ;?>"><?php echo $user->user_email ;?></a></td>
				</tr>
				<tr>
					<td width="70">Course:</td>
					<td><a href="<?php echo get_admin_url() . "/post.php?post={$course->ID}&action=edit";?>"><?php echo $course->post_title ;?></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>