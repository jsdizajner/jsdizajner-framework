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
        
    }

}

new CustomFields;