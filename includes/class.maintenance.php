<?php
defined('ABSPATH') || exit;


class Maintenance 
{

    private $options;

    public function __construct()
    {
        $this->options = get_option('framework_settings_option_name');
        if ( class_exists('View') & array_key_exists('maintenance_mode_0', $this->options ) )
            $this->check_status();
    }

    public function check_status()
    {
        if (array_key_exists('maintenance_mode_0', $this->options) === true)
            add_action('get_header', array($this, 'maintenance'));
    }

    public function maintenance()
    {
        if (!is_user_logged_in()) {
            include(PLUGIN_DIR . 'views/maintenance.php');
            wp_die('', 'Stránka mimo prevádzky', [
                'link_url' =>   '#',
                'link_text' =>  'Kontaktovať Administrátora'
            ]);
        }
    }

}