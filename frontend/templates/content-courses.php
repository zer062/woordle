<section id="woo-course-<?php echo get_the_ID();?>">

    <section class="woo-course-header">
        <?php the_title('<h1>', '</h1>'); ?>
	</section>

    <section class="woo-course-content">
        <div class="woo-course-main-content">

            <div class="woo-course-the-content">

                <?php if ( has_course_will_learn() ) : ?>
                    <div class="woo-course-will-learn">
                        <h3><?php _e( 'You will learn', 'woordle' );?></h3>
			            <?php course_will_learn(); ?>
                    </div>
	            <?php endif;?>

	            <?php if ( has_course_requirements() ) : ?>
                    <div class="woo-course-requirements">
                        <h3><?php _e( 'Requirements', 'woordle' );?></h3>
			            <?php course_requirements(); ?>
                    </div>
	            <?php endif;?>

                <div class="woo-course-description">
                    <h3 class="woo-course-section-title"><?php _e( 'Course description', 'woordle' );?></h3>
		            <?php course_description(); ?>
                </div>

            </div>

        </div>

        <div class="woo-course-sidebar">
            <div class="woo-course-sidebar-content">
                <a href="#" class="btn btn-enrolment">
		            <?php _e( 'Enrol this course');?>
                </a>
	            <?php if( has_promotional_video() ): ?>
		            <?php promotional_video(); ?>
	            <?php endif; ?>
            </div>
        </div>
    </section>
</section>

