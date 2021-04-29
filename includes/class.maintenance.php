<?php
defined('ABSPATH') || exit;

class Maintenance
{

    public function __construct()
    {
        // After Initial Load of Carbon Fields, do the Maintenance Check
        add_action('carbon_fields_fields_registered', [$this, 'maintenance_data']);
    }

    /**
     * Construct the Maintenance Data from Setting page
     */

    public function maintenance_data()
    {
        // Put the state into $data and run check_status() function
        $data = carbon_get_theme_option('crb_maintenance');
        $this->check_status($data);

    }

    /**
     * Check if the checkbox is set
     */

    public function check_status($data)
    {
        if ($data == true) :
            add_action('get_header', array($this, 'maintenance'));
        endif;
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