<?php
defined('ABSPATH') || exit;

class JSD_Maintenance
{

    public $status;

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

        // Insert Data into property $status
        $this->status = carbon_get_theme_option('crb_maintenance');

    }

    /**
     * Check if the checkbox is set
     */

    public function check_status($data)
    {
        if ($data == true) :
            add_action('init', [$this, 'maintenance'], 9);
        endif;
    }

    /**
     * Check if the current user has access to backend / frontend based on his role
     */

    public function check_user_role()
    {
        // check super admin (when multisite is activated) / check admin (when multisite is not activated)
        if (is_super_admin()) {
            return true;
        }

        $user          = wp_get_current_user();
        $user_roles    = !empty($user->roles) && is_array($user->roles) ? $user->roles : array();
        $allowed_roles = array_push($allowed_roles, 'administrator');

        $is_allowed = (bool) array_intersect($user_roles, $allowed_roles);

        return $is_allowed;
    }

    public function maintenance()
    {

        if (
            (!$this->check_user_role()) &&
            !strstr($_SERVER['PHP_SELF'], 'wp-cron.php') &&
            !strstr($_SERVER['PHP_SELF'], 'wp-login.php') &&
            !( strstr($_SERVER['PHP_SELF'], 'wp-admin/') && !is_user_logged_in() ) &&
            !strstr($_SERVER['PHP_SELF'], 'wp-admin/admin-ajax.php') &&
            !strstr($_SERVER['PHP_SELF'], 'async-upload.php') &&
            !( strstr($_SERVER['PHP_SELF'], 'upgrade.php') && $this->check_user_role() ) &&
            !strstr($_SERVER['PHP_SELF'], '/plugins/') &&
            !strstr($_SERVER['PHP_SELF'], '/xmlrpc.php') &&
            !(defined('WP_CLI') && WP_CLI)
        ) {
            // HEADER STUFF
            $protocol         = !empty($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.1', 'HTTP/1.0'), true) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
            $charset          = get_bloginfo('charset') ? get_bloginfo('charset') : 'UTF-8';
            $status_code      = 503;

            // META STUFF
            $title = get_bloginfo('name') . ' - ' . __('Maintenance Mode');
            $robots = 'index, follow';
            $author = get_bloginfo('name');
            $description = get_bloginfo('name') . ' - ' . get_bloginfo('description');
            $keywords = __('Maintenance Mode');

            ob_start();
            header("Content-type: text/html; charset=$charset");
            header("Service Unavailable", true, $status_code);
            header("Retry-After: 3600");

            // load maintenance mode template
            include_once JSD_PLUGIN_DIR . 'views/maintenance.php';
            ob_flush();
            exit();
        }
    }

}

new JSD_Maintenance;