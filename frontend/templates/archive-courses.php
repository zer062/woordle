<?php get_header();?>

<div class="woo-courses-archive">

<?php
	$courses_loop = new WP_Query(['post_type' => 'courses', 'posts_per_page' => 10 ]);
	while ( $courses_loop->have_posts() ) : $courses_loop->the_post();
?>
	<div class="woo-courses-course">
		<div class="woo-course-image" <?php if ( has_post_thumbnail()):?> style="background: url('<?php echo the_post_thumbnail_url();?>');"<?php endif;?> ></div>
		<div class="woo-course-name">
			<a href="<?php echo get_permalink();?>" alt="<?php the_title();?>"><?php the_title();?></a>
		</div>
		<div class="woo-course-price">
			<?php if ( woordle_has_woocommerce() && get_field( 'woordle_woocommerce_settings_woordle_sale_course_woocommerce' ) ) : ?>
			<?php
				$product_id = new WP_Query([
					'post_type' => 'product',
					'post_parent' => $post->ID
				]);

				if ( !is_null( $product_id->post ) ) {
					$product = new WC_Product( $product_id->post->ID );
				}
				echo $product->get_price_html();
			?>
			<?php endif;?>
		</div>
		<?php echo '<a href="' . get_permalink() . '" class="woo-btn">' . __('See more', 'woordle') . '</a>';?>
	</div>
	<?php //woo_load_template_part( 'content', 'courses' ); ?>
<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer();?>
