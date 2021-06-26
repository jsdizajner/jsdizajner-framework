<?php
defined('ABSPATH') || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class JSD_CustomFees
{
    public function __construct()
    {
        // Custom Fee Assigner
        add_action('woocommerce_cart_calculate_fees', [$this, 'assign_fee']);

        // Refresh Page after Gateaway change
        add_action('woocommerce_review_order_before_payment', [$this, 'calculate_fee']);

        // Create Admin Page
        add_action('carbon_fields_register_fields', [$this, 'setting_page']);
    }

    /**
     * Get all options from the plugin
     * Loop through option and check if there is a match with current payment option
     */

    public function assign_fee()
    {
        // Get All fees from the Plugin
        $fees = carbon_get_theme_option('crb_custom_fee');

        // Loop through all of them
        foreach ($fees as $fee) {
            // Get Current Payment Method
            $chosen_gateway = WC()->session->get('chosen_payment_method');

            // Check if there is a match in Payment Method and a Rule set in the Plugin
            if ($chosen_gateway == $fee['fee_rule']) {
                // Assign Fee in Checkout Process
                WC()->cart->add_fee($fee['fee_title'], str_replace(',', '.', $fee['fee_amount']), $fee['fee_taxable'], $fee['fee_tax']);
            }
        }
    }

    /**
     * When there is a Custom Fee Assigned restart Checkout
     */

    public function calculate_fee()
    {
    ?>
        <script type="text/javascript">
            (function($) {
                $('form.checkout').on('change', 'input[name^="payment_method"]', function() {
                    $('body').trigger('update_checkout');
                });
            })(jQuery);
        </script>
    <?php
    }

    public function setting_page()
    {

        // Create list of available Payment Methods
        $installed_payment_methods = WC()->payment_gateways->payment_gateways();
        $methods = [];
        foreach ($installed_payment_methods as $method) {
            $methods[$method->id] = $method->title;
        }

        $labels = [
            'plural_name' => __('Fee'),
            'singular_name' => __('Fees'),
        ];
    

        // Create The Page
        Container::make('theme_options', __('Custom Fees'))
        ->set_page_parent('woocommerce')
        ->set_page_menu_position(81)
        ->add_tab(__('Custom Fees'), array(

            /**
             * Create Fields for Custom Cart Fees
             * @snippet Custom Fees
             */

            // Headline
            Field::make('separator', 'crb_separator', __('Settings for Custom fees')),

            // Repeater Field
            Field::make('complex', 'crb_custom_fee', __('List of Custom Fees'))
            ->setup_labels($labels)
            ->set_collapsed(true)
            ->add_fields(array(
                Field::make('text', 'fee_title', __('Description')),
                Field::make('text', 'fee_amount', __('Amount - in Euros'))
                ->set_attribute('type', 'number'),
                Field::make('checkbox', 'fee_taxable', __('Is this fee taxable?'))
                ->set_option_value('yes'),
                Field::make('text', 'fee_tax', __('Tax class')),
                Field::make('select', 'fee_rule', __('For which Payment Method should this fee aply?'))
                ->add_options($methods),
            ))
            ->set_header_template('
                <% if (fee_title) { %>
                    <%- fee_title %> (<%- fee_amount %>) 
                <% } %>
            '),


        ));
    }
}
