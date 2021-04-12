<?php

class View 
{

    public function __construct()
    {
        add_action( 'admin_menu', 'jsdizajner-framework_add_admin_menu' );
        add_action( 'admin_init', 'jsdizajner-framework_settings_init' );


        function jsdizajner-framework_add_admin_menu(  ) { 
            add_menu_page( 'Framework', 'Framework', 'manage_options', 'framework', 'jsdizajner-framework_options_page' );
        }

        function jsdizajner-framework_settings_init(  ) { 
            register_setting( 'pluginPage', 'jsdizajner-framework_settings' );
            add_settings_section(
                'jsdizajner-framework_pluginPage_section', 
                __( 'Your section description', 'jsdizajner' ), 
                'jsdizajner-framework_settings_section_callback', 
                'pluginPage'
            );
            add_settings_field( 
                'jsdizajner-framework_text_field_0', 
                __( 'Settings field description', 'jsdizajner' ), 
                'jsdizajner-framework_text_field_0_render', 
                'pluginPage', 
                'jsdizajner-framework_pluginPage_section' 
            );
            add_settings_field( 
                'jsdizajner-framework_select_field_1', 
                __( 'Settings field description', 'jsdizajner' ), 
                'jsdizajner-framework_select_field_1_render', 
                'pluginPage', 
                'jsdizajner-framework_pluginPage_section' 
            );
        }


        function jsdizajner-framework_text_field_0_render(  ) { 

            $options = get_option( 'jsdizajner-framework_settings' );
            ?>
            <input type='text' name='jsdizajner-framework_settings[jsdizajner-framework_text_field_0]' value='<?php echo $options['jsdizajner-framework_text_field_0']; ?>'>
            <?php

        }


        function jsdizajner-framework_select_field_1_render(  ) { 

            $options = get_option( 'jsdizajner-framework_settings' );
            ?>
            <select name='jsdizajner-framework_settings[jsdizajner-framework_select_field_1]'>
                <option value='1' <?php selected( $options['jsdizajner-framework_select_field_1'], 1 ); ?>>Option 1</option>
                <option value='2' <?php selected( $options['jsdizajner-framework_select_field_1'], 2 ); ?>>Option 2</option>
            </select>

        <?php
        }


        function jsdizajner-framework_settings_section_callback(  ) { 
            echo __( 'This section description', 'jsdizajner' );
        }


        function jsdizajner-framework_options_page(  ) { 
                ?>
                <form action='options.php' method='post'>

                    <h2>Framework</h2>

                    <?php
                    settings_fields( 'pluginPage' );
                    do_settings_sections( 'pluginPage' );
                    submit_button();
                    ?>

                </form>
        }

    }

}