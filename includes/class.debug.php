<?php
defined('ABSPATH') || exit;
class JSD_Debug
{

    public function __construct()
    {
        // Load Feature after Fields are Registered
        add_action('carbon_fields_fields_registered', [$this, 'load_debug_mode']);

    }

    public function load_debug_mode() {
        $debug = carbon_get_theme_option('jsd_debug_mode');

        if ($debug == true) {
            add_action('admin_menu', array($this, 'framework_settings_add_plugin_page'));
            add_action('admin_bar_menu', [$this, 'admin_bar_shortcut'], 100);
        }
    }

    public function admin_bar_shortcut($admin_bar)
    {
        $admin_bar->add_menu(array(
            'id'    => 'jsd-debug-page',
            'title'  => '<span class="ab-icon"></span>' . __('Debug Page'),
            'href'  => '/wp-admin/admin.php?page=jsdizajner-framework',
            'meta'  => array(
                'title' => __('Debug Page'),
                'target'   => '_self',
            ),
        ));
    }

    public function framework_settings_add_plugin_page()
    {
        $plugin = JSD_Config::$info;
        add_menu_page(
            'Debug Page', // page_title
            'Debug Page', // menu_title
            'manage_options', // capability
            $plugin['slug'], // menu_slug
            array($this, 'create_example_package_page'), // function
            'dashicons-coffee', // icon_url
            99 // position
        );
    }

    public function create_example_package_page()
    {
        include(JSD_PLUGIN_DIR . 'views/settings.php');
    }

    /**
     * Take all HTML from file into one STRING
     * 
     * @param $filename Filename of Template in "views/" folder
     * @return $output String of the template Contents
     */

    public static function create_html($filename)
    {
        $file = JSD_PLUGIN_DIR . 'views/' . $filename . '.php';
        $output = file_get_contents($file);
        return $output;
    }

    public static function dump($var)
    {
        echo '<br>';
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        echo '<br>';
    }


}

new JSD_Debug;


