<?php
    if (! defined ('ABSPATH') ) exit;
    global $post;
    $course = get_post( $post->post_parent );
?>
<div id='course_options' class='panel woocommerce_options_panel'>
    <b><?php _e( 'Course details', 'woordle' );?></b>
    <br>
    <?php if ( $course ) :?>
        <table class="woo-tables">
            <tbody>
                <tr>
                    <td class="td-label"><?php _e( 'Woordle Course ID', 'woordle' );?></td>
                    <td><?php echo $course->ID;?></td>
                </tr>
                <tr>
                    <td class="td-label"><?php _e( 'Woordle Course', 'woordle' );?></td>
                    <td>
                        <a href="<?php echo get_admin_url() . "/post.php?post={$course->ID}&action=edit";?>" target="_blank">
					        <?php echo $course->post_title;?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="td-label"><?php _e( 'Migrated to Moodle', 'woordle' );?></td>
                    <td>No</td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <label for="">
            <?php _e( 'Course not found', 'woordle' );?>
        </label>
    <?php endif;?>
</div>