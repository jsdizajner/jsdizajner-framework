<?php
defined('ABSPATH') || exit;

/**
 * 
 * Config file for JSDIZAJNER Themes
 * Version: 1.0.0
 * Date created: 9/11/2020
 * All rights reserved (c) 2021 Július Sipos
 * 
 */

$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

// Autoloader

require_once PLUGIN_DIR . 'includes/class.init.php';
require_once PLUGIN_DIR . 'includes/class.view.php';
require_once PLUGIN_DIR . 'includes/class.render.php';
require_once PLUGIN_DIR . 'includes/class.template.php';
require_once PLUGIN_DIR . 'includes/class.WP_Bootstrap_Navwalker.php';

