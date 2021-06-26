<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class JSD_CustomFields
{

    public function __construct()
    {
        // Init Setting Page
        add_action('carbon_fields_register_fields', [$this, 'setting_page']);

        // Load WooCommerce Features
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) 
        {
            add_action('carbon_fields_register_fields', [$this, 'woocommerce_page']);
        }
    }

    public function setting_page()
    {
        $html = JSD_Debug::create_html('general');
        // Create The Page
        Container::make('theme_options', __('Framework Settings'))
        ->set_icon('dashicons-media-code')
        ->set_page_menu_position(80)

        ->add_tab(__('Settings'), array(
            Field::make('text', 'api_key', __('API Key'))
            ->set_attribute('placeholder', 'Enter API Key here'),
        ))

        ->add_tab(__('Analytics'), array(

            Field::make('separator', 'ga_separator', __('Google Analytics')),
            Field::make('text', 'ga_key', __('Google Analytics'))
            ->set_attribute('placeholder', 'Insert your Google Analytics ID'),
            Field::make('checkbox', 'ga_checker', __('Do you want to enable Google Analytisc?'))
            ->set_option_value('yes'),
            
        )) 

        ->add_tab(__('Debug'), array(
            Field::make('separator', 'maintenance_separator', __('Maintenance')),
            Field::make('checkbox', 'crb_maintenance', __('Maintenance Mode'))
            ->set_option_value('yes'),
            Field::make('separator', 'debug_mode_separator', __('Debug mode')),
            Field::make('checkbox', 'jsd_debug_mode', __('Enable Debug Mode'))
            ->set_option_value('yes'),
        ));

        /**
         * Extend Nav Menu Custiomization
         */

        Container::make('nav_menu_item', 'Custom Class')
        ->add_fields(array(
            Field::make('text', 'custom_nav_css', __('Custom Class')),
        ));
        
    }

    
    public function woocommerce_page()
    {

        // Create The Page
        Container::make('theme_options', __('WooCommerce Snippets'))
        ->set_icon('dashicons-feedback')
        ->set_page_menu_position(999)

        ->add_tab(__('General Settings'), array(

            /**
             * Create Fields for Custom Cart Fees
             * @snippet Custom Fees
             */

            // Headline
            Field::make('separator', 'crb_separator_general', __('Enable Snippets')),

            Field::make('checkbox', 'enable_custom_fees', __('Custom Fees'))
            ->set_option_value('yes'),

        ));
     
    }

}

new JSD_CustomFields;