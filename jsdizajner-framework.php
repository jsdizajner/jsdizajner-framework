<?php

/**
 * Plugin Name: JSDIZAJNER Framework
 * Plugin URI: https://jsdizajner.com
 * Description: Core Theme Framework for JSDIZAJNER Themes
 * Version: 1.2.0
 * Author: Július Sipos
 */


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!function_exists('get_plugin_data')) {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

define('JSD_PLUGIN_DATA', get_plugin_data(__FILE__));
define('JSD_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Require Carbon Fields
require_once JSD_PLUGIN_DIR . 'vendor/autoload.php';
add_action('after_setup_theme', ['Carbon_Fields\\Carbon_Fields', 'boot']);

/**
 * Framework Autoloader
 * All theme related settings happens in theme Framework Folder and theme functions.php
 */

// Scan all Files in /includes/ folder
$classes = scandir(JSD_PLUGIN_DIR . '/includes/');
$filtered = array_filter($classes, function ($file) {
    if (strpos($file, 'class.') !== false) {
        return $file;
    }
});

foreach ($filtered as $filename)
{
    require_once JSD_PLUGIN_DIR . 'includes/' . $filename;
}

add_action('admin_head', 'jsd_admin_style');

function jsd_admin_style()
{
    $url = get_option('siteurl') . '/wp-content/plugins/' . JSD_Config::$info['slug'] . JSD_Config::$info['style'];
    echo '<!-- JSDIZAJNER ADMIN -->
    <link rel="stylesheet" type="text/css" href="' . $url . '" />
    <!-- /end JSDIZAJNER ADMIN -->';
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('jsd-plugin-frontend', '/wp-content/plugins/jsdizajner-framework/assets/css/page.css', [], time());
});


//Add a link to your settings page in your plugin
function add_settings_plugin_page($links)
{
    $settings_link = '<a href="admin.php?page=crb_carbon_fields_container_framework_settings.php">Settings</a>';
    array_push($links, $settings_link);
    return $links;
}

$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'add_settings_plugin_page');
