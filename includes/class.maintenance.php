<?php
defined('ABSPATH') || exit;

class Maintenance
{

    /**
     * Field of all options from Database
     *
     * @var [array]
     */

    private $option;

    public function __construct()
    {
        // Set $options as array of data from settings
        $this->option = CustomFields::get_field('crb_maintenance');
        $this->check_status();
    }

    /**
     * Check if the checkbox is set
     */

    public function check_status()
    {
        if ($this->option === true)
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

new Maintenance;