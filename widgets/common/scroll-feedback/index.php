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

class tx_scroll_feedback extends Widget_Base
{
    public function get_name()
    {
        return 'tx-scrollfeedback';
    }

    public function get_title()
    {
        return __('Scroll feedback', 'themexriver-addon');
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
            'rating',
            [
                'label' => esc_html__('Rating', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'default' => [
                    'size' => 50,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
            ]
        );

        $repeater1->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Mr Wick',
            ]
        );

        $repeater1->add_control(
            'pos',
            [
                'label' => esc_html__('Position', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Google,Gamer',
            ]
        );

        $repeater1->add_control(
            'avatar',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true,
                'label' => esc_html__('Avatar', 'themexriver-addon'),
            ]
        );

        $repeater1->add_control(
            'desc',
            [
                'label' => esc_html__('Comment', 'themexriver-addon'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'prevent_empty' => false,
                'title_field' => '{{{name}}}',
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
            'gsp',
            [
                'label' => __('Item spacing', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tx-scroll-feedback' => 'gap: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'gpad',
            [
                'label' => __('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'gbg',
            [
                'label' => __('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gmw',
            [
                'label' => __('Minimum width', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ]
                ],                
                'selectors' => [
                    '{{WRAPPER}} .innerr' => 'min-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'gbsdw',
                'selector' => '{{WRAPPER}} .inner-box',
            ]
        );

        $this->add_responsive_control(
            'gbrd',
            [
                'label' => __('Border radius', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,               
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'invert',
            [
                'label' => esc_html__('Opposite direction', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'themexriver-addon'),
                'label_off' => esc_html__('No', 'themexriver-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_avatar',
            [
                'label' => esc_html__('Avatar', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rating',
            [
                'label' => esc_html__('Rating', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cont',
            [
                'label' => esc_html__('Content', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \Themexriver_Addon\Widgets\tx_scroll_feedback());
