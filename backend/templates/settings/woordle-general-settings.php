<?php
$sale_course_woocommerce = get_option( 'woordle_sale_course_woocommerce' );
?>

<h2>Woordle Gerenal settings</h2>

<table class="form-table">
	<tr valign="top">
		<th scope="row"><?php _e( 'Sales courses with Woocommerce?', 'woordle' );?></th>
		<td>

            <?php if ( woo_has_woocommerce() ) : ?>
			<input type="checkbox" name="woordle_sale_course_woocommerce" value="1" <?php echo ( !is_null( $sale_course_woocommerce ) && $sale_course_woocommerce ==  "1" ) ? 'checked' : '' ;?> >
            <p>
                <?php _e( 'When defined true, all courses selected to sale with Woocommerce, will use checkout process to enrol and do login.', 'woordle' )?>
            </p>
            <?php else: ?>
            <?php _e( 'Require Woocommerce installed and actived', 'woordle' );?>
            <?php endif; ?>
		</td>
	</tr>
</table>