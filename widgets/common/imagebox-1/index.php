<?php
namespace Themexriver_Addon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
 
class tx_imagebox_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tx-imagebox-1';
    }

    public function get_title()
    {
        return __('Imagebox 1', 'themexriver-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-format-chat';
    }

    public function get_custom_help_url()
    {
        return '';
    }

    public function get_categories()
    {
        return ['tx-addon'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_team',
            [
                'label' => __('Content', 'themexriver-addon'),
            ]
        );


        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'pre',
            [
                'label' => esc_html__('Pre title', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('20+ Lessons','themexriver-addon')
            ]
        );

        $repeater1->add_control(
            'ttl',
            [
                'label' => esc_html__('Title', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Consulting','themexriver-addon'),
            ]
        );

        $repeater1->add_control(    
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'label' => esc_html__('Image', 'themexriver-addon'),
            ]
        );

        $repeater1->add_control(
            'url',
            [
                'label' => esc_html__('Link', 'themexriver-addon'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => 'https://themexriver.com/',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater1->add_control(
            'clr',
            [
                'label' => esc_html__('Theme color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{ttl}}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => __('General', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );   

        $this->add_responsive_control(
            'gwd',
            [
                'label' => esc_html__('Width', 'themexriver-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '33.33',
                'selectors' => [
                    '{{WRAPPER}} .service-block' => 'width: {{VALUE}}%;float:left;',
                ],
            ]
        );

        $this->add_responsive_control(
            'itpady',
            [
                'label' => esc_html__('Item Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .service-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tx-image-box-1' => 'margin-left: -{{LEFT}}{{UNIT}};margin-right:-{{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'zigzag',
            [
                'label' => esc_html__('Zigzag layout', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'zigzag',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'cntr',
            [
                'label' => esc_html__('Center content', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .lower-content' => 'margin-left:auto;margin-right:auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'cwid',
            [
                'label' => esc_html__('Content width', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .lower-content' => 'max-width: {{SIZE}}%;',
                ]

            ]
        );

        $this->add_responsive_control(
            'tsp',
            [
                'label' => esc_html__('Top negative spacing', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .lower-content' => 'margin-top: -{{SIZE}}px;',
                ]

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label' => esc_html__('Image', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'iht',
            [
                'label' => esc_html__('Height', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .image img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],

            ]
        );

        $this->add_control(
            'ibg',
            [
                'label' => esc_html__('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pre',
            [
                'label' => esc_html__('Pre title', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'prclr',
            [
                'label' => esc_html__('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lessons' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'prpad',
            [
                'label' => esc_html__('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .lessons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prtyp',
                'selector' => '{{WRAPPER}} .lessons',
                'label' => esc_html__('Typography', 'themexriver-addon'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tclr',
            [
                'label' => esc_html__('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tbg',
            [
                'label' => esc_html__('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lower-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tpad',
            [
                'label' => esc_html__('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['em', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .lower-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttyp',
                'selector' => '{{WRAPPER}} .title',
                'label' => esc_html__('Typography', 'themexriver-addon'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tbxd',
                'selector' => '{{WRAPPER}} .lower-box',
            ]
        );

        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings();
        $this->add_render_attribute(
            'wrapper',
            [
                'class' => [ 'tx-image-box-1', $settings['zigzag'] ],
            ]
        );        
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \Themexriver_Addon\Widgets\tx_imagebox_1());
