<?php
$woordle_auto_create_woocommerce_products = get_option( 'woordle_auto_create_woocommerce_products' );
?>
<table class="form-table">
	<h2>Woordle Woocommerce settings</h2>

    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e( 'Create Woocommerce product to all courses?', 'woordle' );?></th>
            <td>
                <input type="checkbox" name="woordle_auto_create_woocommerce_products" value="1" <?php echo ( !is_null( $woordle_auto_create_woocommerce_products ) && $woordle_auto_create_woocommerce_products ==  "1" ) ? 'checked' : '' ;?> >
            </td>
        </tr>
    </table>
</table>