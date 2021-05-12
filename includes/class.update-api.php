<?php
defined('ABSPATH') || exit;


class JSD_UpdateAPI
{

    public $key;
    
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'create_endpoint'] );
        $this->check_for_updates();
    }

    public function check_for_updates()
    {
        require JSD_Config::$info['checker'];
        $MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
            JSD_Config::$info['update'] . '?action=get_metadata&slug=' . JSD_Config::$info['slug'], //Metadata URL.
            JSD_Config::$info['file'], //Full path to the main plugin file.
            JSD_Config::$info['slug'] //Plugin slug. Usually it's the same as the name of the directory.
        );
    }

    public function create_endpoint()
    {
        register_rest_route('jsd/api', 'update', [
            'method' => 'GET',
            'callback' => [$this, 'data_json'],
        ]);
    }

    public function data_json()
    {
        $options = [
            'Site'     => home_url(),
            'Key'      => carbon_get_theme_option('api_key'),
            'Version'  => JSD_Config::$info['version'],
            'Plugin'   => JSD_Config::$info['name'],
        ];
        return $options;
    }

}

new JSD_UpdateAPI;