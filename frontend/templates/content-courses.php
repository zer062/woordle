<section id="woo-course-<?php echo get_the_ID();?>" class="container">

    <section class="woo-course-header" <?php echo (has_post_thumbnail()) ? 'style="background: url(' . get_the_post_thumbnail_url() . ') center center no-repeat; background-size: cover;"' : ''; ?> >
        <div class="<?php echo ( has_post_thumbnail() ) ? 'woo-course-title overlay' : 'woo-course-title';?>">
            <?php the_title('<h1>', '</h1>'); ?>
        </div>
	</section>

    <section class="woo-course-content">
        <div class="woo-course-main-content">

            <div class="woo-course-the-content">
                <?php do_action( 'woo_alerts' );?>
                <?php if ( woordle_has_course_will_learn() ) : ?>
                    <div class="woo-course-will-learn">
                        <h3><?php _e( 'You will learn', 'woordle' );?></h3>
			            <?php woordle_course_will_learn(); ?>
                    </div>
	            <?php endif;?>

                <div class="woo-course-grade">
                    <h3 class="woo-course-section-title"><?php _e( 'Course grade', 'woordle' );?></h3>
		            <?php woordle_course_grade(); ?>
                </div>

	            <?php if ( woordle_has_course_requirements() ) : ?>
                    <div class="woo-course-requirements">
                        <h3><?php _e( 'Requirements', 'woordle' );?></h3>
			            <?php woordle_course_requirements(); ?>
                    </div>
	            <?php endif;?>

                <div class="woo-course-description">
                    <h3 class="woo-course-section-title"><?php _e( 'Course description', 'woordle' );?></h3>
		            <?php woordle_course_description(); ?>
                </div>

            </div>

        </div>

        <div class="woo-course-sidebar">
            <div class="woo-course-sidebar-content">
                <?php do_action ( 'woordle_enrol_course_html');?>
	            <?php if( woordle_has_promotional_video() ): ?>
		            <?php woordle_promotional_video(); ?>
	            <?php endif; ?>
            </div>
        </div>
    </section>
</section>

