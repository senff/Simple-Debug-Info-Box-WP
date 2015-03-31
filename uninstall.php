<?php
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;
	if ( get_option( 'simple_debug_options' ) != false ) {
		delete_option( 'simple_debug_options' );
	}
?>
