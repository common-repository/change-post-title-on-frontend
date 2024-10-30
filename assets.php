<?php

defined( 'ABSPATH' ) or die( 'No, go away!' );

function cptl_assets() {

	if( current_user_can('manage_options') ) {
	// CSS
		wp_enqueue_style( 'cptl-assets-css', CPTL_PLUGIN_URL . 'assets/css/style.css', array(), '1.0.0' );
	// JS
		wp_enqueue_script( 'cptl-assets-js', CPTL_PLUGIN_URL . 'assets/js/main.js', array('jquery'), '1.0.0' );
	// Localize JS so we can do AJAX calls :D
		wp_localize_script( 'cptl-assets-js', 'cptlajax', array( 'ajaxurl' => admin_url('admin-ajax.php'), 'security' => wp_create_nonce('cptl-security-noncey') ) );
	}
	
}
add_action('wp_enqueue_scripts', 'cptl_assets');