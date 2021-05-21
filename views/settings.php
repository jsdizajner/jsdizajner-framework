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

            echo 'WOOOO';
            $fees = carbon_get_theme_option('crb_custom_fee');
            JSD_Debug::dump($fees);
            echo '//WOOOO';


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

            JSD_Debug::dump(JSD_PLUGIN_DATA);

            $currentData = JSD_PLUGIN_DATA;
            echo JSD_PLUGIN_DATA['Version'];

            $dynamicData = [
                'version'   =>    JSD_PLUGIN_DATA['Version'],
                'author'    =>     JSD_PLUGIN_DATA['Author'],
                'name'      =>     JSD_PLUGIN_DATA['Name'],
            ];

            $updateData = array_merge($dynamicData, JSD_Config::$info);

            JSD_Debug::dump($dynamicData);
            JSD_Debug::dump(JSD_Config::$info);

            // Scan all Files in /includes/ folder
            $classes = scandir(JSD_PLUGIN_DIR . '/includes/');
            $filter = array_filter($classes, function ($file) {
                if (strpos($file, 'class.') !== false) {
                    return $file;
                }
            });

            JSD_Debug::dump($filter);

            ?>
     </div>
 </div>