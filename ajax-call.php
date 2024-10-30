<?php

defined( 'ABSPATH' ) or die( 'No, go away!' );

function cptl_update_title_action() {
	check_ajax_referer('cptl-security-noncey', 'security');

	$post_id = $_POST['post_id'];
	$title = htmlspecialchars($_POST['new_title']);
	if( !is_numeric($post_id) || get_post($post_id) == NULL || $title == '' ) {
		return false;
	}
	
	$update_post_args = array( 'ID' => $post_id, 'post_title' => $title );
	if( wp_update_post($update_post_args) ) 
		echo json_encode(array( 'msg' => 'success' ));

	die();
}
add_action('wp_ajax_cptl_update_title', 'cptl_update_title_action');