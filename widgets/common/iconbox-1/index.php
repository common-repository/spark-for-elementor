<?php
namespace Themexriver_Addon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class tx_iconbox_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tx-iconbox-1';
    }

    public function get_title()
    {
        return esc_html__('Iconbox 1', 'themexriver-addon');
    }

    public function get_icon()
    {
        return 'dashicons dashicons-format-chat';
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
                'label' => esc_html__('Iconbox', 'themexriver-addon'),
            ]
        );

        $this->add_control(
            'type',
            [
                'type' => Controls_Manager::CHOOSE,
                'label' => esc_html__('Icon/Image', 'themexriver-addon'),
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'themexriver-addon'),
                        'icon' => ' eicon-document-file',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'themexriver-addon'),
                        'icon' => 'eicon-image-rollover',
                    ]
                ],
                'default' => 'icon',
            ]
        );

        $this->add_control(
            'ico',
            [
                'type' => Controls_Manager::ICONS,
                'label' => esc_html__('Icon', 'themexriver-addon'),
                'label_block' => true,
                'condition' => [
                    'type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'themexriver-addon'),
                'condition' => [
                    'type' => 'image',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pre',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Pre title', 'themexriver-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'themexriver-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'themexriver-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'type' => Controls_Manager::URL,
                'label' => esc_html__('Link', 'themexriver-addon'),
                'label_block' => true,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => 'https://themexriver.com/',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );   

        $this->add_control(
            'gbg',
            [
                'label' => esc_html__('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gbdrcl',
            [
                'label' => esc_html__('Border color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gbrad',
            [
                'label' => esc_html__('Border radius', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'gthm',
            [
                'label' => esc_html__('Theme color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner-box:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .inner-box:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gpad',
            [
                'label' => esc_html__('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'galgn',
            [
                'label' => esc_html__('Alignment', 'themexriver-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'themexriver-addon'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'themexriver-addon'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'themexriver-addon'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .inner-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_img',
            [
                'label' => esc_html__('Icon/Image', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label' => esc_html__('Rotate on hover', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'themexriver-addon'),
                'label_off' => esc_html__('No', 'themexriver-addon'),
                'return_value' => 'rotate',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'iclr',
            [
                'label' => esc_html__('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'isz',
            [
                'label' => esc_html__('Size', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .img-wrap img' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ibtsp',
            [
                'label' => esc_html__('Bottom spacing', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .img-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .step' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'prbg',
            [
                'label' => esc_html__('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .step' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'prpad',
            [
                'label' => esc_html__('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .step' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'prbrad',
            [
                'label' => esc_html__('Border radius', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .step' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prtyp',
                'selector' => '{{WRAPPER}} .step',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttyp',
                'selector' => '{{WRAPPER}} .title',
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

        $this->add_responsive_control(
            'tmrgn',
            [
                'label' => esc_html__('Margin', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_desc',
            [
                'label' => esc_html__('Description', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dtyp',
                'selector' => '{{WRAPPER}} .desc',
            ]
        );

        $this->add_control(
            'dclr',
            [
                'label' => esc_html__('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc' => 'color: {{VALUE}};',
                ],
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
                'class' => [ 'tx-iconbox-1', $settings['rotate'] ],
            ]
        );
        require dirname(__FILE__) . '/view.php';
        
    }
}

$widgets_manager->register(new \Themexriver_Addon\Widgets\tx_iconbox_1());
