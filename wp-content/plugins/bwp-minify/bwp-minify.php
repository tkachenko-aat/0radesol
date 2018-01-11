<?php
/*
Plugin Name: Better WordPress Minify
Plugin URI: #
Description: Allows you to minify your CSS and JS files for faster page loading for visitors.
Version: 1000.3.3
Author: Khangi
Author URI: #
License: GPLv3 or later
*/

// In case someone integrates this plugin in a theme or calling this directly
if (class_exists('BWP_MINIFY') || !defined('ABSPATH'))
	return;

// Init the plugin
require_once dirname(__FILE__) . '/includes/class-bwp-minify.php';
$bwp_minify = new BWP_MINIFY();
