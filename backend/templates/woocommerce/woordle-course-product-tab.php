<?php
    global $post;
    $course = get_post( $post->post_parent );
?>
<div id='course_options' class='panel woocommerce_options_panel'>

    <?php if ( $course ) :?>
    <p class="form-field">
        <label for="">
	        <?php _e( 'Woordle Course', 'woordle' );?>:
        </label>
        <span>
            <a href="<?php echo get_admin_url() . "/post.php?post={$course->ID}&action=edit";?>" target="_blank">
                <?php echo $course->post_title;?>
            </a>
        </span>
    </p>

    <p class="form-field">
        <label for="">
			<?php _e( 'Woordle Course ID', 'woordle' );?>:
        </label>
        <span><?php echo $course->ID;?></span>
    </p>

    <p class="form-field">
        <label for="">
		    <?php _e( 'Migrated to Moodle', 'woordle' );?>:
        </label>
        <span>
            No
        </span>
    </p>
    <?php else: ?>
        <label for="">
            <?php _e( 'Course not found', 'woordle' );?>
        </label>
    <?php endif;?>
</div>