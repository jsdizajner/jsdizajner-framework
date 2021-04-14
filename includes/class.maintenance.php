<?php
defined('ABSPATH') || exit;

class Maintenance 
{

    /**
     * Field of all options from Database
     *
     * @var [array]
     */

    private $options;

    public function __construct()
    {
        // Set $options as array of data from settings
        $this->options = get_option('framework_settings_option_name');
        if ( class_exists('View') & array_key_exists('maintenance_mode_0', $this->options ) )
            $this->check_status();
    }

    /**
     * Check if the checkbox is set
     */

    public function check_status()
    {
        if (array_key_exists('maintenance_mode_0', $this->options) === true)
            add_action('get_header', array($this, 'maintenance'));
    }

    /**
     * Set Wordpress to Maintenance mode
     * Show the HTML from view/maintenance.php
     */

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