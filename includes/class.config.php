<?php
defined('ABSPATH') || exit;

/**
 * Config file for JSDIZAJNER Themes
 */

define('THEME_DIR', get_template_directory()); /* Usage: JSD_FRAMEWORK_DIR . '/xx/xx.php'; */
define('THEME_URI', get_template_directory_uri()); /* Usage: <?php echo JSD_THEME_URI ?> */
define('ASSETS_URI', get_template_directory_uri() . '/assets');
define('IMAGES_URI', ASSETS_URI . '/images');
define('FRAMEWORK_DIR', THEME_DIR . "/framework");
define('THEME_LOCALIZE', THEME_DIR . "/languages");
define('THEME_PROTOCOL', is_ssl() ? 'https' : 'http');
define('THEME_IS_RTL', is_rtl() ? true : false);
define('THEME_TEXT_DOMAIN', 'jsdizajner');
define('PLUGIN_TEXT_DOMAIN', 'jsdizajner_framework');

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
class JSD_Config
{

	public static $info = [
		'name'				=> 'JSDIZAJNER Framework',
		'slug' 				=> 'jsdizajner-framework',
		'version'			=> '1.0.0',
		'docs'				=> 'https://documentation.jsdizajner.com/',
		'update'			=> 'https://update.jsdizajner.com/',
		'file'				=> JSD_PLUGIN_DIR . 'jsdizajner-framework.php',
		'checker'			=> JSD_PLUGIN_DIR . 'includes/plugin-update-checker/plugin-update-checker.php',
		'style'				=> '/assets/css/admin.css',
		'maintenance_path'	=> ABSPATH . 'maintenance/index.php',
	];

}

new JSD_Config;
