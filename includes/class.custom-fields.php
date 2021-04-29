<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class CustomFields
{

    public function __construct()
    {
        // Require Carbon Fields
        require_once PLUGIN_DIR . 'vendor/autoload.php';
        \Carbon_Fields\Carbon_Fields::boot();

        // Init Setting Page
        add_action('carbon_fields_register_fields', [$this, 'setting_page']);

    }

    public function setting_page()
    {
        $html = View::create_html('test');
        // Create The Page
        Container::make('theme_options', __('Framework Settings'))
        ->set_icon('dashicons-media-code')
        ->set_page_menu_position(80)
        // ->set_page_parent('admin.php?page=jsdizajner-framework')

        ->add_fields( array (
            Field::make('html', 'crb_information_text')
            ->set_html($html)
        ))

        ->add_tab(__('Settings'), array(
            Field::make('text', 'api_key', __('API Key'))
            ->set_attribute('placeholder', 'Enter API Key here'),
        ))

        ->add_tab(__('Debug'), array(
            Field::make('checkbox', 'crb_maintenance', __('Maintenance Mode'))
            ->set_option_value('yes'),
        ));
        
    }

}

new CustomFields;