 <div class="wrap">
     <h2>Framework Settings</h2>
     <p></p>
     <?php settings_errors(); ?>

     <form method="post" action="options.php">
         <?php
            settings_fields('framework_settings_option_group');
            do_settings_sections('framework-settings-admin');
            submit_button();
            ?>
     </form>

     <?php
        $framework_settings_options = get_option('framework_settings_option_name');
        $test = new Maintenance;
        var_dump($framework_settings_options); 
        var_dump(get_option('active_plugins'));
        var_dump(View::create_html('test')); 
        var_dump(carbon_get_theme_option('crb_maintenance')); 
     ?>
 </div>