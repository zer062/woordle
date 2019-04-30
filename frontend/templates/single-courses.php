<?php get_header();?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php woordle_load_template_part( 'content', 'courses' ); ?>
<?php endwhile; // end of the loop. ?>
<?php get_footer();?>
