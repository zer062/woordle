<?php
if (! defined ('ABSPATH') ) exit;
$woordle = Woordle::get_instance();
$tabs = $woordle->get_option_tabs();
$active_tab = 'woordle_general_settings';

if( isset( $_GET[ 'tab' ] ) ) {
	$active_tab = $_GET[ 'tab' ];
}
?>
<div class="wrap">

    <h2><span class="dashicons dashicons-welcome-learn-more"></span> <?php _e( 'Woordle Settings', 'woordle' );?></h2>

	<?php settings_errors(); ?>

    <h2 class="nav-tab-wrapper">
        <?php foreach ( $tabs as $tab ) :?>
            <a href="?page=woordle-settings&tab=<?php echo $tab['name'];?>" class="nav-tab <?php echo $active_tab == $tab['name'] ? 'nav-tab-active' : ''; ?>">
		        <?php echo $tab['title'];?>
            </a>
        <?php endforeach; ?>
    </h2>

    <form method="post" action="options.php">

	    <?php settings_fields( 'woordle-settings-group' ); ?>
	    <?php do_settings_sections( 'woordle-settings-group' ); ?>

        <?php

            foreach ( $tabs as $tab ) {
	            if ( $active_tab == $tab['name'] ) {
	                include $tab['template'];
                }
            }
        ?>
	    <?php submit_button(); ?>
    </form>
</div>