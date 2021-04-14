<?php
/*
Plugin Name: Theme Engine
Plugin URI: https://jsdizajner.com
Description: Core Theme Framework
Version: 1.0.0
Author: Július Sipos
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('PLUGIN_DIR',plugin_dir_path(__FILE__));

include(PLUGIN_DIR . 'includes/class.config.php');

//Add a link to your settings page in your plugin
function add_settings_plugin_page($links)
{
    $settings_link = '<a href="admin.php?page=theme_framework">' . 'Settings' . '</a>';
    array_push($links, $settings_link);
    return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'add_settings_plugin_page');