 <div class="wrap">
     <h2>Example Package</h2>

     <?php
        $test = new JSD_Maintenance;
        echo '<pre>';
        var_dump(get_option('active_plugins'));
        echo '</pre>';

        echo '<br>';
        var_dump(carbon_get_theme_option('crb_maintenance'));
        echo '<br>';

        // $installed_payment_methods = WC()->payment_gateways->payment_gateways();
        // $methods = [];
        // foreach ($installed_payment_methods as $method) {
        //     $methods[$method->title] = $method->id;
        // }
        // echo '<pre>';
        // print_r($methods);
        // echo '</pre>';

        // echo '<br>';

        // echo '<pre>';
        // var_dump( carbon_get_theme_option('crb_custom_fee'));
        // echo '</pre>';

        // echo '<br>';

        // echo '<pre>';
        // $fees = carbon_get_theme_option('crb_custom_fee');
        // $output = [];
        // for ($i = 0; $i < count($fees); $i++) {
        //     $fee[$i] = $fees[$i];
        // };

        // foreach ($fee as $testing) {
        //     $output['title'] = $testing['fee_title'];
        //     $output['rule'] = $testing['fee_rule'];
        //     $output['amount'] = $testing['fee_amount'];
        //     $output['taxable'] = $testing['fee_taxable'];
        //     $output['tax'] = $testing['fee_tax'];
        // }
        // var_dump($output);
        // echo '</pre>';

        echo '<br>';
        echo '<pre>';
        $ga = [
            'ga_key'        => carbon_get_theme_option('ga_key'),
            'ga_checker'    => carbon_get_theme_option('ga_checker'),
            'fb_key'        => carbon_get_theme_option('fb_key'),
            'fb_checker'    => carbon_get_theme_option('fb_checker'),
        ];
        var_dump($ga);

        // Gather all Analytics Data
        $data = [
            'ga_key'        => carbon_get_theme_option('ga_key'),
            'ga_checker'    => carbon_get_theme_option('ga_checker'),
            'fb_key'        => carbon_get_theme_option('fb_key'),
            'fb_checker'    => carbon_get_theme_option('fb_checker'),
        ];

        $keys = array_filter($data, function($checker) {
            return is_bool($checker);
        });
        // Check what types of analytics are turned on

        var_dump($keys);
        echo '</pre>';


     ?>
 </div>