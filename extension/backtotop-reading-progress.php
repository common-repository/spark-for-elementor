<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}

class Tx_Back_Top_Reading_Progress
{
    public static function init()
    {
        add_action('elementor/documents/register_controls', [__CLASS__,'tp_callback_function']);  
        add_action('wp_footer', [ __CLASS__,'render']);
        add_action('wp_enqueue_scripts', [ __CLASS__,'add_script']);
    }

    public static function tp_callback_function( $element)
    {
        $element->start_controls_section(
			'tx_read_tab',
			[
			    'tab' => Controls_Manager::TAB_SETTINGS,
			    'label' => esc_html__(' Reading Progress & Back to Top', 'master-addons' )
			]
		);
        $element->add_control(
			'tx_progress_bar',
			[
			    'type' => Controls_Manager::SWITCHER,
			    'label' => esc_html__('Reading progress bar', 'master-addons' ),
			]
		);
        $element->add_control(
			'tx_backtop',
			[
			    'type' => Controls_Manager::SWITCHER,
			    'label' => esc_html__('Back to top', 'master-addons' ),
			]
		);

        $element->add_control(
            'pb_bg',
            [
                'label' => esc_html__('Progress background', 'thepack'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $element->add_control(
            'pb_ht',
            [
                'label' => esc_html__('Progress height', 'thepack'),
                'type' => Controls_Manager::SLIDER,
            ]
        );
        $element->add_control(
            'pb_pos',
            [
                'label' => esc_html__('Position', 'thepackpro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'thepackpro'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'thepackpro'),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'bottom',
            ]
        );
        $element->end_controls_section();
    }

    public static function add_script(){

        $option = get_option('tx_global_settings');

        if ($option['reading_progress']['enabled']) {
            $pos = $option['reading_progress']['position'] == 'top' ? 'top:0;' : 'bottom:0;';
            $out = '
                .tx-progress-wrap .progress{
                    background:'.$option['reading_progress']['background'].';
                    height:'.$option['reading_progress']['height'].'px;
                }
                .tx-progress-wrap{
                    '.$pos.'
                }                
            ';
        }        
        wp_add_inline_style( 'elementor-frontend', $out );
    }

    public static function render()
    {
        //if (did_action('elementor/loaded')) {
            echo '<div class="tx-progress-wrap"><div class="progress"></div></div>';
            echo '<div class="tx-back-top"><svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102"><path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/></svg></div>';

            //var_dump( get_option('tx_global_settings') );
       // }
    }
}

Tx_Back_Top_Reading_Progress::init();
