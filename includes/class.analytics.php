<?php
defined('ABSPATH') || exit;


class JSD_Analytics
{
    public $data;

    public function __construct()
    {
        // Load Feature after Fields are Registered
        add_action('carbon_fields_fields_registered', [$this, 'init_analytics_settings']);

    }

    public function init_analytics_settings()
    {

        // Gather all Analytics Data
        $this->data = [
            'ga_key'        => carbon_get_theme_option('ga_key'),
            'ga_checker'    => carbon_get_theme_option('ga_checker'),
            'fb_key'        => carbon_get_theme_option('fb_key'),
            'fb_checker'    => carbon_get_theme_option('fb_checker'),
        ];

        // Load analytics tools
        $this->load_analytics_tools($this->data);
    }

    public function load_analytics_tools($keys)
    {
        // Google Analytics
        if ($keys['ga_checker'] == true) {
            if (empty($keys['ga_key'])) {
                add_action('admin_notices', [$this, 'google_analytics_missing_key']);
            } else {
                add_action('wp_head', [$this, 'google_analytics_snippet']);
            }
        }
    }

    public function google_analytics_snippet()
    {
        $keys = $this->data;
    ?>
        <!-- Global site tag - JSD_Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $keys['ga_key']; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '<?php echo $keys['ga_key']; ?>');
        </script>
        <!-- // JSD_Google Analytics -->
    <?php
    }

    public function google_analytics_missing_key()
    {
    ?>
        <div class="error notice">
            <p><?php _e('Missing Google Analytics ID in Framework Settings!', PLUGIN_TEXT_DOMAIN); ?></p>
        </div>
    <?php
    }
}

new JSD_Analytics;
