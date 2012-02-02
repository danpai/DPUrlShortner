<?php
/**
 * @package dpurlshortner
 * @version 0.2
 */
/*
Plugin Name: DP URL Shortner
Plugin URI: https://github.com/danpai/DPUrlShortner
Description: Create short URLs for your posts and pages using several services (only Google and bit.ly at this time)
Author: Danilo Paissan
Version: 0.2
Author URI: http://danilopaissan.net
License: W3C Software Notice and License 

http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231

By obtaining, using and/or copying this work, you (the licensee) agree that you have read, understood, and will comply with the following terms and conditions.

Permission to copy, modify, and distribute this software and its documentation, with or without modification, for any purpose and without fee or royalty is hereby granted, provided that you include the following on ALL copies of the software and documentation or portions thereof, including modifications:

- The full text of this NOTICE in a location viewable to users of the redistributed or derivative work.
- Any pre-existing intellectual property disclaimers, notices, or terms and conditions. If none exist, the W3C Software Short Notice should be included (hypertext is preferred, text is permitted) within the body of any redistributed or derivative code.
- Notice of any changes or modifications to the files, including the date changes were made. (We recommend you provide URIs to the location from which the code is derived.)
*/

require_once(ABSPATH . 'wp-admin/includes/misc.php');
require_once(ABSPATH . 'wp-admin/includes/admin.php');
require_once(ABSPATH . 'wp-includes/pluggable.php');
require_once(plugin_dir_path( __FILE__ ) . "pagesrender.php");
require_once(plugin_dir_path( __FILE__ ) . "service-google.php");
require_once(plugin_dir_path( __FILE__ ) . "service-bitly.php");

function dpus_install() {}

function dpus_deactivate() {}

function dpus_uninstall() {}

function dpus_add_menu(){
	add_options_page( 'DP URL Shortner', 'URL Shortner','manage_options', __FILE__, 'dpus_manage_option_page' );
}

function dpus_publish_post(){
	dpus_get_short_url_by_service();
}

function dpus_publish_page(){
	global $post;
	dpus_get_short_url_by_service($post->ID);
}

function dpus_get_short_url_by_service($post_id){
	$suffix_function = get_option( 'dpus_shortner_service' );
	$prefix_function = "dpus_get_short_url_from_";
	$function_to_call = $prefix_function . $suffix_function;
	$function_to_call($post_id);
}


function dpus_get_shortlink($post_id){
	global $post;
	if (!$post_id && $post) $post_id = $post->ID;

	if ($post->post_status != 'publish')
		return "";
	$shortlink = get_post_meta($post_id, '_shortlink', true);
	if ($shortlink) {
		return $shortlink;
	}
	else {
		dpus_get_short_url_by_service($post_id);
		$shortlink = get_post_meta($post_id, '_shortlink', true);
		return $shortlink;
	}
}

register_activation_hook( __FILE__, 'dpus_install' );
register_deactivation_hook( __FILE__, 'dpus_deactivate' );
register_uninstall_hook( __FILE__, 'dpus_uninstall');
add_action( 'admin_menu', 'dpus_add_menu' );
add_action( 'publish_post', 'dpus_publish_post' );
add_action( 'publish_page', 'dpus_publish_page' );
add_filter('pre_get_shortlink', 'dpus_get_shortlink',10,1);
?>