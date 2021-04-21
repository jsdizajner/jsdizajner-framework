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

class JSD_Config
{

	public static $info = [
		'name'		=> 'JSDIZAJNER Framework',
		'slug' 		=> 'jsdizajner-framework',
		'version'	=> '1.0.0',
		'docs'		=> 'https://documentation.jsdizajner.com/',
		'update'	=> 'https://update.jsdizajner.com/',
		'file'		=> PLUGIN_DIR . 'jsdizajner-framework.php',
		'checker'	=> PLUGIN_DIR . 'includes/plugin-update-checker/plugin-update-checker.php',
	];

	public function __construct()
	{
		$theme = wp_get_theme();
		if (!empty($theme['Template'])) {
			$theme = wp_get_theme($theme['Template']);
		}

		if (!defined('DS')) {
			define('DS', DIRECTORY_SEPARATOR);
		}

		/**
		 * Framework Autoloader
		 */

		// Plugin Settings
		require_once PLUGIN_DIR . 'includes/class.view.php';

		// Theme Functions Initialization
		require_once PLUGIN_DIR . 'includes/class.init.php';

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
	}



}

new JSD_Config;
