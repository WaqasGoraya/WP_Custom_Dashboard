<?php
/*
Plugin Name: Custom Dashboard Multi
Description: Custom dashboard functionality for WordPress Multisite.
Version: 1.0
Author: Waqas Arif
*/

define('DASHBOARD_PLUGIN', plugin_dir_path(__FILE__));
$plugin_url =  plugin_dir_url(__FILE__);
$plugin_path = plugin_dir_path(__FILE__);


// Hide admin bar
add_filter('show_admin_bar', '__return_false');

// Include files
include_once(DASHBOARD_PLUGIN . 'includes/create-pages.php');
include_once(DASHBOARD_PLUGIN . 'includes/assets.php');
include_once(DASHBOARD_PLUGIN . 'includes/templates.php');
include_once(DASHBOARD_PLUGIN . 'includes/pages-hide.php');

