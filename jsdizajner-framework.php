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

include(plugin_dir_path(__FILE__) . 'includes/class.config.php');

function create_setting_page()
{
    add_menu_page(
        __('Framework Settings', 'jsdizajner_framework'), // Page Title
        __('Framework', 'jsdizajner_framework'), // Menu Item
        'manage_options', // User Capabilities
        'theme_framework', // Plugin Slug
        'render_framework_settings', // Render Page Function
        'dashicons-media-code', // Menu Icon
        100 // Menu position
    );

}
add_action('admin_menu', 'create_setting_page');


function render_framework_settings()
{
    // Double check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    // Get front-end template of the Page / View Template
    include(PLUGIN_DIR . 'views/settings.php');
}

//Add a link to your settings page in your plugin
function add_settings_plugin_page($links)
{
    $settings_link = '<a href="admin.php?page=theme_framework">' . 'Settings' . '</a>';
    array_push($links, $settings_link);
    return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'add_settings_plugin_page');

require PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';
// $MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
//     'https://jsdizajner.local/update/?action=get_metadata&slug=jsdizajner-framework', //Metadata URL.
//     __FILE__, //Full path to the main plugin file.
//     'jsdizajner-framework' //Plugin slug. Usually it's the same as the name of the directory.
// );
