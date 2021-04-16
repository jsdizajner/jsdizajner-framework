<?php
/*
Plugin Name: JSDIZAJNER Framework
Plugin URI: https://jsdizajner.com
Description: Core Theme Framework for JSDIZAJNER Themes
Version: 1.0.0
Author: Július Sipos
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('PLUGIN_DIR', plugin_dir_path(__FILE__));

include(PLUGIN_DIR . 'includes/class.config.php');
new JSD_Config;

//Add a link to your settings page in your plugin
function add_settings_plugin_page($links)
{
    $plugin = JSD_Config::$plugin;
    $settings_link = '<a href="admin.php?page='. $plugin['slug'] .'">Settings</a>';
    array_push($links, $settings_link);
    return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'add_settings_plugin_page');


// require PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';
// $MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
//     JSD_Config::$plugin['update'] . '?action=get_metadata&slug=' . JSD_Config::$plugin['slug'], //Metadata URL.
//     __FILE__, //Full path to the main plugin file.
//     JSD_Config::$plugin['slug'] //Plugin slug. Usually it's the same as the name of the directory.
// );