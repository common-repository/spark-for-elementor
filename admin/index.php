<?php

class tx_admin_index
{
    public function __construct()
    {
        add_action('admin_footer_text', [$this, 'admin_footer']);
        add_action('admin_enqueue_scripts', [$this,'my_plugin_scripts']);
        add_action('wp_ajax_es_deactivate_plugin', [$this, 'deactivate_plugin']);
    }

    public function admin_footer(){

        $currentScreen = get_current_screen();
        if( $currentScreen->id === "plugins" ) {
            echo '
                <div class="tx-modal dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox" id="elementor-deactivate-feedback-modal">
                    <div class="dialog-widget-content dialog-lightbox-widget-content tx-center">
                        <div class="dialog-header dialog-lightbox-header">
                            <div id="elementor-deactivate-feedback-dialog-header">
                                <i class="eicon-elementor-square" aria-hidden="true"></i>
                                <span id="elementor-deactivate-feedback-dialog-header-title">'.__('Quick Feedback','themexriver-addon').'</span>
                            </div>
                        </div>
                        <div class="dialog-message dialog-lightbox-message">

                            <div class="elementor-deactivate-feedback-dialog-input-wrapper">
                                <input id="elementor-deactivate-feedback-no_longer_needed" class="elementor-deactivate-feedback-dialog-input" type="radio" name="tx_reason" value="no_longer_needed">
                                <label for="elementor-deactivate-feedback-no_longer_needed" class="elementor-deactivate-feedback-dialog-label">'.__('I no longer need the plugin','themexriver-addon').'</label>
                            </div>

                            <div class="elementor-deactivate-feedback-dialog-input-wrapper">
                                <input id="elementor-deactivate-feedback-couldnt_get_the_plugin_to_work" class="elementor-deactivate-feedback-dialog-input" type="radio" name="tx_reason" value="couldnt_get_the_plugin_to_work">
                                <label for="elementor-deactivate-feedback-couldnt_get_the_plugin_to_work" class="elementor-deactivate-feedback-dialog-label">'.__('I couldnt get the plugin to work','themexriver-addon').'</label>
                            </div>

                            <div class="elementor-deactivate-feedback-dialog-input-wrapper">
                                <input id="elementor-deactivate-feedback-found_new_plugin" class="elementor-deactivate-feedback-dialog-input" type="radio" name="tx_reason" value="found_new_plugin">
                                <label for="elementor-deactivate-feedback-found_new_plugin" class="elementor-deactivate-feedback-dialog-label">'.__('I found a new plugin','themexriver-addon').'</label>
                            </div>

                            <div class="elementor-deactivate-feedback-dialog-input-wrapper">
                                <input id="elementor-deactivate-feedback-temporary_deactivate" class="elementor-deactivate-feedback-dialog-input" type="radio" name="tx_reason" value="temporary_deactivate">
                                <label for="elementor-deactivate-feedback-temporary_deactivate" class="elementor-deactivate-feedback-dialog-label">'.__('It is a temporary deactivationan','themexriver-addon').'</label>
                            </div>

                            <div class="elementor-deactivate-feedback-dialog-input-wrapper">
                                <input id="elementor-deactivate-feedback-other" class="elementor-deactivate-feedback-dialog-input" type="radio" name="tx_reason" value="other">
                                <label for="elementor-deactivate-feedback-other" class="elementor-deactivate-feedback-dialog-label">'.__('Other issues','themexriver-addon').'</label>
                            </div>

                        </div>

                        <div class="dialog-buttons-wrapper dialog-lightbox-buttons-wrapper">
                            <button class="dialog-button dialog-submit tx-lightbox-submit">'.__('Submit & Deactivate','themexriver-addon').'</button>
                            <button class="dialog-button dialog-skip tx-lightbox-skip">'.__('Skip & Deactivate','themexriver-addon').'</button>
                        </div>

                    </div>
                </div>            
            ';
        }
    }

    public function deactivate_plugin(){

        deactivate_plugins('elementor-addon/index.php');

        die();
    } 

    public function my_plugin_scripts(){

        wp_enqueue_style('tx-admin', TX_URL . 'admin/assets/css/tx-admin.css' );
        wp_enqueue_script('tx_admin', TX_URL . 'admin/assets/js/tx-admin.js', ['jquery'], '', true);

    }


}


new tx_admin_index();



