<?php
defined('ABSPATH') || exit;

/**
 * @return string '/themefolder/'
 * Example: include( THEME_DIR . '/includec/file.php' )
 * 
 * Used in Frontend
 */
define('THEME_DIR', get_template_directory());

/**
 * @return string '/themefolder/'
 * Example: wp_enqueue_script( 'theme-slug-custom-script', THEME_URI . '/assets/js/custom-script.js', array(), '1.0.0', true );
 */
define('THEME_URI', get_template_directory_uri());

/**
 * @return string '/themefolder/assets'
 * Example: wp_enqueue_script( 'theme-slug-custom-script', ASSETS_URI . '/js/custom-script.js', array(), '1.0.0', true );
 */
define('ASSETS_URI', get_template_directory_uri() . '/assets');

/**
 * @return string '/themefolder/assets/images'
 * Example: <img src="<?php echo IMAGES_URI . 'logo.svg'; ?>" />
 */
define('IMAGES_URI', ASSETS_URI . '/images');

/**
 * @return string '/themefolder/framework'
 * Example: require_once( FRAMEWORK_DIR . '/class.init.php' );
 */
define('FRAMEWORK_DIR', THEME_DIR . "/framework");

/**
 * @return string '/jsdizajner-framework/includes/snippets/'
 */
define('JSD_PLUGIN_SNIPPETS_DIR', JSD_PLUGIN_DIR . '/includes/snippets/');

/**
 * @return string '/themefolder/languages'
 * Example: load_theme_textdomain(THEME_TEXT_DOMAIN, THEME_LOCALIZE);
 */
define('THEME_LOCALIZE', THEME_DIR . "/languages");

/**
 * @return bool Based on HTTP protocol
 */
define('THEME_PROTOCOL', is_ssl() ? 'https' : 'http');

/**
 * @return bool
 */
define('THEME_IS_RTL', is_rtl() ? true : false);

/**
 * @return string 'jsdizajner'
 * Define Text Domain for Theme
 */
define('THEME_TEXT_DOMAIN', 'jsdizajner');

/**
 * @return string 'jsdizajner_framework'
 * Define Text Domain for plugin
 */
define('PLUGIN_TEXT_DOMAIN', 'jsdizajner_framework');


if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

/**
 * Load all Plugin Data into JSD_PLUGIN_DATA
 */

if (!function_exists('get_plugin_data')) {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

class JSD_Config
{
	
	public static $info = [
		'name'      		=> JSD_PLUGIN_DATA['Name'],
		'author'    		=> JSD_PLUGIN_DATA['Author'],
		'slug' 				=> 'jsdizajner-framework',
		'version'  		 	=> JSD_PLUGIN_DATA['Version'],
		'docs'				=> 'https://documentation.jsdizajner.com/',
		'update'			=> 'https://update.jsdizajner.com/',
		'file'				=> JSD_PLUGIN_DIR . 'jsdizajner-framework.php',
		'checker'			=> JSD_PLUGIN_DIR . 'includes/plugin-update-checker/plugin-update-checker.php',
		'style'				=> '/assets/css/admin.css',
	];

}

new JSD_Config;
