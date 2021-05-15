 <div class="wrap">
     <div class="debug__container">
         <p class="info">
             <code>
                 JSD_Debug::dump($var);
             </code>
         </p>
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


            $ga = [
                'ga_key'        => carbon_get_theme_option('ga_key'),
                'ga_checker'    => carbon_get_theme_option('ga_checker'),
                'fb_key'        => carbon_get_theme_option('fb_key'),
                'fb_checker'    => carbon_get_theme_option('fb_checker'),
            ];
            JSD_Debug::dump($ga);

            // Gather all Analytics Data
            $data = [
                'ga_key'        => carbon_get_theme_option('ga_key'),
                'ga_checker'    => carbon_get_theme_option('ga_checker'),
                'fb_key'        => carbon_get_theme_option('fb_key'),
                'fb_checker'    => carbon_get_theme_option('fb_checker'),
            ];

            $keys = array_filter($data, function ($checker) {
                return is_bool($checker);
            });
            // Check what types of analytics are turned on

            JSD_Debug::dump($keys);

            $shit = 'choj do pi4e';
            JSD_Debug::dump($shit);

            JSD_Debug::dump(get_home_path());

            // Path to Maintenance Template
            $string = ABSPATH . 'maintenance/index.php';
            $maintenance_url = JSD_Config::$info['maintenance_path'];

            if (!file_exists($string)) {
                $createIndex = fopen($maintenance_url, 'w');
                fwrite($createIndex, 'SHITY TEST');
                fclose($createIndex);

            } else {
                echo $string;
            }

            JSD_Debug::dump(file_exists($string));
            JSD_Debug::dump($maintenance_url);
            ?>
     </div>
 </div>