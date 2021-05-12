<?php
defined('ABSPATH') || exit;

class JSD_Template
{
    protected static $instance = null;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * This functions help to link template parts more easily
     * For better code writing and reading
     *
     * @param [string] $viewDestination
     * @param [string] $viewName
     * @return $renderTemplate / renders whole WP Core function "get_template_part()" where the main folder is 'THEME_DIR/template-parts/'
     */

    public static function get_part($viewDestination, $viewName)
    {
        // Pass the params to get_template_part() function
        $viewDestination = 'template-parts/' . $viewDestination;
        $renderTemplate = get_template_part($viewDestination, $viewName);

        // Render the result
        $render = new JSD_Render();
        $render->handler($renderTemplate, false, [], '001', 'Cannot find template-part');
    }

    /**
     * Creates a Placeholder Image
     * 
     * @param [int] $width
     * @param [int] $height
     * @return HTML img tag with placeholder.com image
     */

    public static function image_placeholder($width, $height)
    {
        // Create Placeholder Link
        $resolution = $width . 'x' . $height;
        $output = 'https://via.placeholder.com/' . $resolution . '?text=' . $resolution;

        // Render the output
        $render = new JSD_Render();
        $render->handler($output, 'params', [$width, $height], '002', 'Image cannot be rendered');
    }

    /**
     * Helper function to create buttons programatically
     *
     * @param [array] $args
     * @return HTML Button output
     */

    public static function render_button($args)
    {
        // Default Settings
        $defaults = [
            'text'          => '',
            'link'          => [
                'url'         => '#',
                'is_external' => false,
                'nofollow'    => false,
            ],
            'style'         => 'flat',
            'size'          => 'nm',
            'icon'          => '',
            'icon_align'    => 'left',
            'extra_class'   => '',
            'class'         => 'tm-button',
            'id'            => '',
            'wrapper_class' => '',
        ];

        // Compare passed $args with $defaults
        $args = wp_parse_args($args, $defaults);

        // Render the button and Error Check
        $render = new JSD_Render();
        $render->handler($args, 'button', [], '003', 'Cannot render button.');
    }

}
