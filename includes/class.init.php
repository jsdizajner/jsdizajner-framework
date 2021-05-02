<?php
defined('ABSPATH') || exit;

/**
 * Initial setup for this theme
 */
class Initialize
{

    protected static $instance = null;

    public static function instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init() {

        // Add theme supports.
        add_action('after_setup_theme', array($this, 'setup'));

        // Add backwards compatibility for older versions for title tag feature.
        if (!function_exists('_wp_render_title_tag')) {
            add_action('wp_head', array($this, 'initialize_render_title'));
        }
    }

    function initialize_render_title() { ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
    }
    
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @access public
     */

    public function setup() {

        /**
         * Theme data from style.css
         * Available data:
         *  $theme_data->get( 'Name' )         
         *  $theme_data->get( 'ThemeURI' )    
         *  $theme_data->get( 'Description' ) 
         *  $theme_data->get( 'Author' )      
         *  $theme_data->get( 'AuthorURI' )   
         *  $theme_data->get( 'Version' )     
         *  $theme_data->get( 'Template' )   
         *  $theme_data->get( 'Status' )      
         *  $theme_data->get( 'Tags' )        
         *  $theme_data->get( 'TextDomain' )  
         *  $theme_data->get( 'DomainPath' )  
         */

        $theme_data = wp_get_theme();

        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
        load_theme_textdomain(THEME_TEXT_DOMAIN, THEME_LOCALIZE);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus([
            'primary' => esc_html__('Hlavná Navigácia', THEME_TEXT_DOMAIN),
            'footerMain' => esc_html__('Pätička 1', THEME_TEXT_DOMAIN),
            'footerSecond' => esc_html__('Pätička 2', THEME_TEXT_DOMAIN),
            'footerThird' => esc_html__('Pätička 3', THEME_TEXT_DOMAIN)
        ]);

        /**
         * Scripts and Styles of the Website
         */

        function main_theme_scripts() {
            $theme_data = wp_get_theme();
            wp_enqueue_style( THEME_TEXT_DOMAIN . '-main', get_stylesheet_uri(), array(), $theme_data->get( 'Version' ) );
        }

        add_action('wp_enqueue_scripts', 'main_theme_scripts');

        /*
		 * Add default posts and comments RSS feed links to head.
		 */
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        /*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
        add_theme_support('post-formats', array('aside', 'image', 'gallery', 'video', 'audio', 'quote', 'link'));

    }

}