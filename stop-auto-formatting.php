<?php
/*
Plugin Name: Stop Auto Formatting
Description: Stops the automatic formatting.
Version: 1.0.0
Author: Blue Art Co., Ltd.
Author URI: http://www.blueart21.co.jp/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

TinyMCE Advanced 4.2.5
*/

add_action('init', 'saf_init', 999);
if(!function_exists('saf_init')) :
	function saf_init() {
		remove_filter('the_title', 'wptexturize');
		remove_filter('the_content', 'wptexturize');
		remove_filter('the_excerpt', 'wptexturize');
		remove_filter('the_title', 'wpautop');
		remove_filter('the_content', 'wpautop');
		remove_filter('the_excerpt', 'wpautop');
		remove_filter('the_editor_content', 'wp_richedit_pre');
	}
endif;

add_action('tiny_mce_before_init', 'saf_tiny_mce_before_init', 999);
if(!function_exists('saf_tiny_mce_before_init')) :
	function saf_tiny_mce_before_init($mceInit) {
		$mceInit['wpautop'] = false;
		$mceInit['tadv_noautop'] = true;
		$mceInit['verify_html'] = false;
		return $mceInit;
	}
endif;

add_filter('mce_external_plugins', 'saf_mce_external_plugins', 999);
if(!function_exists('saf_mce_external_plugins')) :
	function saf_mce_external_plugins($external_plugins) {
		$external_plugins['wptadv'] = plugin_dir_url(__FILE__) . 'wptadv/plugin.min.js';
		return $external_plugins;
	}
endif;
