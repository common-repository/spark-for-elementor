<?php
/*
Plugin Name: Themexriver Addon
Plugin URI: http://themexriver.com/plugins/elementspark
Description: Elementor addon
Version: 0.1
Author: Themexriver
Author URI: https://www.themexriver.com
*/ 
use \Elementor\Core\Settings\Manager as Settings_Manager;
// Create Class
class Themexriver_Addon_Init
{
    // Constructor
    public function __construct()
    {
        add_action('init', [$this, 'setup_constant']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'enqueue_scripts']);
        add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), [$this, 'plugin_action_links'], 10 );
        add_filter('plugin_row_meta', [$this, 'plugin_action_meta'], 10, 4 );
        add_action('admin_init', [$this, 'installed_active_elementor'], 10);
        add_action('init', [$this, 'include_admin_files']);
        add_action('elementor/init', [$this, 'add_elementor_category']);
        add_action('elementor/widgets/register', [$this, 'include_widgets']);
        add_filter('elementor/icons_manager/additional_tabs', [$this, 'icons_tabs']);
        add_action('elementor/editor/after_save', array($this, 'save_global_values'), 10, 2);
    }

    public function save_global_values( $post_id, $editor_data ){

        if (wp_doing_cron()) {
            return;
        }
        $manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
        $settings = $manager->get_model($post_id);
        $global_settings = get_option('tx_global_settings');

        if ( $settings->get_settings('tx_progress_bar') == 'yes') {
            $global_settings['reading_progress'] = [
                'post_id' => $post_id,
                'enabled' => true,  
                'background'=> $settings->get_settings('pb_bg'),
                'height'=> $settings->get_settings('pb_ht')['size'],
                'position'=> $settings->get_settings('pb_pos'),              
            ];
        } else {
            $global_settings['reading_progress'] = [
                'post_id' => null,
                'enabled' => false,
            ];
        }

        update_option('tx_global_settings', $global_settings);

        //error_log( var_dump($global_settings) );
    }

    public function icons_tabs($tabs = [])
    {
        $tabs['themify-icons'] = [
            'name' => 'themify-icons',
            'label' => esc_html__('Themify', 'themexriver-addon'),
            'labelIcon' => 'ti-wand',
            'prefix' => 'ti-',
            'displayPrefix' => 'tivo',
            'url' => TX_URL . 'asset/iconfont/themify-icons/themify-icons.css',
            'fetchJson' => TX_URL . 'asset/iconfont/themify-icons/fonts/themify-icons.json',
            'ver' => '3.0.1',
        ];

        return $tabs;
    }

    public function setup_constant()
    {
        if (!defined('TX_DIR')) {
            define('TX_DIR', plugin_dir_path(__FILE__));
        }

        if (!defined('TX_URL')) {
            define('TX_URL', plugin_dir_url(__FILE__));
        }

        if (!defined('TX_ROOT')) {
            define('TX_ROOT', __FILE__);
        }
        //include required files 
        include_once TX_DIR . 'extension/animated-gradient-background.php';
        include_once TX_DIR . 'extension/wrapper-link.php';
        include_once TX_DIR . 'extension/sticky-section.php';
        include_once TX_DIR . 'extension/post-duplicator.php';
        include_once TX_DIR . 'extension/backtotop-reading-progress.php';
    }
                     
    public function include_admin_files()
    {
        include_once TX_DIR . 'admin/index.php';
        include_once TX_DIR . 'inc/helper.php';
    }

    public function add_elementor_category()
    {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'tx-addon',
            [
                'title' => esc_html__('Common Element', 'themexriver-addon'),
                'icon' => 'fa fa-plug',
            ],
            999
        );
    }

    public function installed_active_elementor()
    {
        if (is_admin() && current_user_can('activate_plugins') && !did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'elementor_inactive_not_present'], 10);

            deactivate_plugins('elementor-addon/index.php');

            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }
        }
    }            

    public function elementor_inactive_not_present()
    {
        $class = 'notice notice-error';
        $plugin = 'elementor/elementor.php';
        $message = sprintf(__('The %1$sElementor addon%2$s plugin requires %1$sElementor%2$s plugin installed & activated.', 'themexriver-addon'), '<strong>', '</strong>');

        if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {
            $action_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
            $button_label = __('Activate Elementor', 'themexriver-addon');
        } else {
            $action_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
            $button_label = __('Install Elementor', 'themexriver-addon');
        }

        $button = '<p><a href="' . esc_url($action_url) . '" class="button-primary">' . esc_html($button_label) . '</a></p><p></p>';

        printf('<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr($class), wp_kses_post($message), wp_kses_post($button));
    }

    function plugin_action_meta( $links_array, $plugin_file_name, $plugin_data, $status )
    {
        if ( strpos( $plugin_file_name, basename(__FILE__) ) ) {
            $links_array[] = '<a target="_blank" href="http://themexriver.com">'.__('FAQ','themexriver-addon').'</a>';
            $links_array[] = '<a target="_blank" href="http://themexriver.com">'.__('Support','themexriver-addon').'</a>';
        }

        return $links_array;
    }       

    public function include_widgets($widgets_manager)
    {
        require_once TX_DIR . 'widgets/common/iconbox-1/index.php';
        require_once TX_DIR . 'widgets/common/accordion/index.php';
        require_once TX_DIR . 'widgets/common/testimonial-1/index.php';
        require_once TX_DIR . 'widgets/common/scroll-feedback/index.php';
        require_once TX_DIR . 'widgets/common/imagebox-1/index.php';
        require_once TX_DIR . 'widgets/common/client/index.php';
        require_once TX_DIR . 'widgets/common/team/index.php';

        require_once TX_DIR . 'widgets/tutor/course-grid/index.php';

    }

    public function plugin_action_links( $actions )
    {
        $actions[] = '<a href="' . esc_url( admin_url( 'admin.php?page=Themexriver_Addon' ) ) . '">' . __( 'Settings', 'themexriver-addon' ) . '</a>';
        $actions[] = '<a class="elementor-plugins-gopro" href="http://themexriver.com" target="_blank">' . __('Get Pro','themexriver-addon') . '</a>';

        return $actions;
    }

    // Styles and Scripts
    public function enqueue_scripts()
    {
        // Styles
        wp_enqueue_style('er-custom', TX_URL . 'asset/css/tx-custom.css');
        // Scripts
        wp_enqueue_script('er-custom', TX_URL . 'asset/js/tx-custom.js', ['jquery'], '', true);
        wp_enqueue_script('jquery.sticky-sidebar', TX_URL . 'asset/js/jquery.sticky-sidebar.js', ['jquery'], '', true);
    }
}

// Add a Global variable if you need to use outside of instantiated scope
global $Themexriver_Addon_Init;

// Instantiate
$Themexriver_Addon_Init = new Themexriver_Addon_Init();

?>