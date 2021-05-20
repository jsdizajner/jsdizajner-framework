<?php
defined('ABSPATH') || exit;


class JSD_Woo
{

    public function __construct()
    {
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
        {
            // Custom Fee Assigner
            add_action('woocommerce_cart_calculate_fees', [$this, 'assign_fee']);

            // Refresh Page after Gateaway change
            add_action('woocommerce_review_order_before_payment', [$this, 'calculate_fee']);

            // Register Order Status
            add_action('init', [$this, 'register_custom_order_status']);
            add_filter('wc_order_statuses', [$this, 'add_custom_to_order_statuses']);

            // Send notification when Order Status is payed-online
            add_action('woocommerce_order_status_payed-online', [$this, 'custom_notification'], 20, 2);

            // Automatically assing Order Status for certian online payment methods
            add_action('woocommerce_thankyou', [$this, 'change_order_status']);
        }
    }

    /**
     * Get all options from the plugin
     * Loop through option and check if there is a match with current payment option
     *
     * @return void
     */

    public function assign_fee()
    {
        // Get All fees from the Plugin
        $fees = carbon_get_theme_option('crb_custom_fee');

        // Loop through all of them
        foreach ($fees as $fee)
        {
            // Get Current Payment Method
            $chosen_gateway = WC()->session->get('chosen_payment_method');

            // Check if there is a match in Payment Method and a Rule set in the Plugin
            if ($chosen_gateway == $fee['fee_rule'])
            {
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

    // Register new status
    public function register_custom_order_status()
    {
        register_post_status('wc-payed-online', array(
            'label'                     => 'Platba Online',
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop('Platba Online (%s)', 'Platba Online (%s)')
        ));
    }

    // Add to list of WC Order statuses
    public function add_custom_to_order_statuses($order_statuses)
    {

        $new_order_statuses = array();

        // add new order status after processing
        foreach ($order_statuses as $key => $status) {

            $new_order_statuses[$key] = $status;

            if ('wc-processing' === $key) {
                $new_order_statuses['wc-payed-online'] = 'Platba Online';
            }
        }

        return $new_order_statuses;
    }

    public function custom_notification($order_id, $order)
    {

        $heading = 'Ďakujeme za Vašu objednávku #' . $order->get_order_number();
        $subject = 'Ďakujeme za Vašu objednávku #' . $order->get_order_number();

        // Get WooCommerce email objects
        $mailer = WC()->mailer()->get_emails();

        // Assign heading & subject to chosen object
        $mailer['WC_Email_Customer_On_Hold_Order']->heading = $heading;
        $mailer['WC_Email_Customer_On_Hold_Order']->settings['heading'] = $heading;
        $mailer['WC_Email_Customer_On_Hold_Order']->subject = $subject;
        $mailer['WC_Email_Customer_On_Hold_Order']->settings['subject'] = $subject;

        // Send the email with custom heading & subject
        $mailer['WC_Email_Customer_On_Hold_Order']->trigger($order_id);


    }

    public function change_order_status($order_id)
    {
        if (!$order_id) return;
        $order = wc_get_order($order_id);

        // Status without the "wc-" prefix
        if ($order->payment_method == 'tb_tatrapay' || $order->payment_method == 'tb_cardpay') {
            $order->update_status('payed-online');
        }
    }

}


new JSD_Woo;

add_action('woocommerce_email_before_order_table', 'bbloomer_add_content_specific_email', 20, 4);

function bbloomer_add_content_specific_email($order, $sent_to_admin, $plain_text, $email)
{
        var_dump($order->get_status());
        echo '<br>';
        var_dump($email->id);
}


