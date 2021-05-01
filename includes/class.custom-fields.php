<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class CustomFields
{

    public function __construct()
    {

        // Init Setting Page
        add_action('carbon_fields_register_fields', [$this, 'setting_page']);
        add_action('carbon_fields_register_fields', [$this, 'woocommerce_page']);

    }

    public function setting_page()
    {
        $html = View::create_html('general');
        // Create The Page
        Container::make('theme_options', __('Framework Settings'))
        ->set_icon('dashicons-media-code')
        ->set_page_menu_position(80)

        ->add_fields( array (
            Field::make('separator', 'crb_separator', __('Framework')),
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

    public function woocommerce_page()
    {
        $labels = [
            'plural_name' => __('Fee'),
            'singular_name' => __('Fees'),
        ];

        // Create The Page
        Container::make('theme_options', __('Woo Snippets'))
        ->set_icon('dashicons-media-code')
        ->set_page_menu_position(81)

        ->add_tab(__('Custom Fees'), array(

            /**
             * Create Fields for Custom Cart Fees
             * @snippet Custom Fees
             */

            // Headline
            Field::make('separator', 'crb_separator', __('Settings for Custom fees')),

            // Repeater Field
            Field::make('complex', 'crb_custom_fee', __('List of Custom Fees'))
            ->setup_labels($labels)
            ->add_fields(array(
                Field::make('text', 'fee_title', __('Description')),
                Field::make('text', 'fee_amount', __('Amount - in Euros'))
                    ->set_attribute('type', 'number'),
                Field::make('select', 'fee_taxable', __('Is this fee taxable?'))
                ->add_options(array(
                    'yes' => __('Yes'),
                    'no' => __('No')
                )),
                Field::make('text', 'fee_tax', __('Tax class')),
            )),


        ));
     
    }

}

new CustomFields;