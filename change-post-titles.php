<?php

/*
Plugin Name: Change Post Title on Frontend
Plugin URI:  https://wordpress.org/plugins/change-post-titles-on-frontend/
Description: Allows you to change post titles without entering the "Edit post" section. Just double-click on the title to change it.
Version:     1.0.0
Author:      Stefan Malic
Author URI:  http://www.stefanmalic.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /
Text Domain: change-post-titles-frontend
*/

defined( 'ABSPATH' ) or die( 'No, go away!' );

define('CPTL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CPTL_PLUGIN_URL', plugins_url('/change-post-titles/'));

require_once CPTL_PLUGIN_DIR . 'assets.php';
require_once CPTL_PLUGIN_DIR . 'ajax-call.php';

// Create a DIV in footer which contains the post ID, so we can use it later.

function cptl_add_postid_to_body() {
	if( !is_single() ) return false; // do it only for posts
	if( !current_user_can('manage_options') ) return false; // check if user is admin
	global $post;
	$id = $post->ID;
	?>
	<div class="cptl-post-id" data-cptl-post-id="<?php echo $id; ?>"></div>
	<?php
}
add_action('wp_footer', 'cptl_add_postid_to_body');