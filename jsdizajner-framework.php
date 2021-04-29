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

/**
 * Framework Autoloader
 */

// Framework Config
require_once PLUGIN_DIR . 'includes/class.config.php';

// Plugin Settings
require_once PLUGIN_DIR . 'includes/class.view.php';

// Theme Functions Initialization
require_once PLUGIN_DIR . 'includes/class.init.php';

// Custom Fields
require_once PLUGIN_DIR . 'includes/class.custom-fields.php';

// Maintenance Feature
require_once PLUGIN_DIR . 'includes/class.maintenance.php';

// Update API
require_once PLUGIN_DIR . 'includes/class.update-api.php';

// Rendering Handler
require_once PLUGIN_DIR . 'includes/class.render.php';

// Template Helper Class
require_once PLUGIN_DIR . 'includes/class.template.php';

// Bootstrap Navwalker
require_once PLUGIN_DIR . 'includes/class.WP_Bootstrap_Navwalker.php';


//Add a link to your settings page in your plugin
function add_settings_plugin_page($links)
{
    $plugin = JSD_Config::$info;
    $settings_link = '<a href="admin.php?page='. $plugin['slug'] .'">Settings</a>';
    array_push($links, $settings_link);
    return $links;
}
$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'add_settings_plugin_page');
