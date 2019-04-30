<?php
    if (! defined ('ABSPATH') ) exit;

	$user = wp_get_current_user();
	$enrolments = get_posts([
		'post_type' => 'enrolment',
		'author' => $user->ID
	]);
?>

<h3><?php _e( 'My Courses', 'woordle' );?></h3>
<table>
	<thead>
		<tr>
			<td><?php _e( 'Number', 'woordle' );?></td>
			<td><?php _e( 'Course', 'woordle' );?></td>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ( $enrolments as $enrol ):
		$course = get_post( $enrol->post_parent );
	?>
		<tr>
			<td><?php echo $enrol->post_title; ?></td>
			<td><?php echo $course->post_title; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
