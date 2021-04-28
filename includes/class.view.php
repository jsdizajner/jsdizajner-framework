<?php
defined('ABSPATH') || exit;
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */
class View
{
    private $framework_settings_options;
    public $maintenance;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'framework_settings_add_plugin_page'));
        add_action('admin_init', array($this, 'framework_settings_page_init'));
    }

    public function framework_settings_add_plugin_page()
    {
        $plugin = JSD_Config::$info;
        add_menu_page(
            'Framework Settings', // page_title
            'Framework Settings', // menu_title
            'manage_options', // capability
            $plugin['slug'], // menu_slug
            array($this, 'framework_settings_create_admin_page'), // function
            'dashicons-media-code', // icon_url
            99 // position
        );
    }

    public function framework_settings_create_admin_page()
    {
        $this->framework_settings_options = get_option('framework_settings_option_name');

        include(PLUGIN_DIR . 'views/settings.php');
       
    }

    public function framework_settings_page_init()
    {
        register_setting(
            'framework_settings_option_group', // option_group
            'framework_settings_option_name', // option_name
            array($this, 'framework_settings_sanitize') // sanitize_callback
        );

        add_settings_section(
            'framework_settings_setting_section', // id
            'Settings', // title
            array($this, 'framework_settings_section_info'), // callback
            'framework-settings-admin' // page
        );

        add_settings_field(
            'maintenance_mode_0', // id
            'Maintenance Mode', // title
            array($this, 'maintenance_mode_0_callback'), // callback
            'framework-settings-admin', // page
            'framework_settings_setting_section' // section
        );

        add_settings_field(
            'api_key_1', // id
            'API Key', // title
            array($this, 'api_key_1_callback'), // callback
            'framework-settings-admin', // page
            'framework_settings_setting_section' // section
        );
    }

    public function framework_settings_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['maintenance_mode_0'])) {
            $sanitary_values['maintenance_mode_0'] = $input['maintenance_mode_0'];
        }

        if (isset($input['api_key_1'])) {
            $sanitary_values['api_key_1'] = sanitize_text_field($input['api_key_1']);
        }

        return $sanitary_values;
    }

    public function framework_settings_section_info()
    {
    }

    public function maintenance_mode_0_callback()
    {
        printf(
            '<input type="checkbox" name="framework_settings_option_name[maintenance_mode_0]" id="maintenance_mode_0" value="maintenance_mode_0" %s> <label for="maintenance_mode_0">Enabling this options creates a redirect to maintanance page.</label>',
            (isset($this->framework_settings_options['maintenance_mode_0']) && $this->framework_settings_options['maintenance_mode_0'] === 'maintenance_mode_0') ? 'checked' : ''
        );
    }

    public function api_key_1_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="framework_settings_option_name[api_key_1]" id="api_key_1" value="%s">',
            isset($this->framework_settings_options['api_key_1']) ? esc_attr($this->framework_settings_options['api_key_1']) : ''
        );
    }

}
if (is_admin())
    $framework_settings = new View();


//  * Retrieve this value with:
//  *  // Array of All Options
//  * $maintenance_mode_0 = $framework_settings_options['maintenance_mode_0']; // Maintenance Mode
//  * $api_key_1 = $framework_settings_options['api_key_1']; // API Key

