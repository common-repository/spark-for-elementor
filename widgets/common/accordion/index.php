<?php
namespace Themexriver_Addon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class tx_accordion extends Widget_Base
{
    public function get_name()
    {
        return 'tx-accordion';
    }

    public function get_title()
    {
        return __('Accordion', 'themexriver-addon');
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

        $this->add_control(
            'actikn',
            [
                'label' => __('Active icon', 'themexriver-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'iactikn',
            [
                'label' => __('Inactive icon', 'themexriver-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Label', 'themexriver-addon'),
                'label_block' => true,
                'default' => __('Car Insurance','themexriver-addon'),
            ]
        );

        $repeater->add_control(
            'content',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => __('Content', 'themexriver-addon'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Finance', 'themexriver-addon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
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
                    '{{WRAPPER}} li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Title', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tbg',
            [
                'label' => __('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accortitle' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tclr',
            [
                'label' => __('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttyp',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_responsive_control(
            'tpad',
            [
                'label' => __('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accortitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Icon', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'iclr',
            [
                'label' => __('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ibg',
            [
                'label' => __('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ifs',
            [
                'label' => __('Font size', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'iwh',
            [
                'label' => __('Width & height', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ibrad',
            [
                'label' => __('Border radius', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .tbxicon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_desc',
            [
                'label' => __('Description', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dtyp',
                'selector' => '{{WRAPPER}} .accorbody',
            ]
        );

        $this->add_control(
            'dclr',
            [
                'label' => __('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dbg',
            [
                'label' => __('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dpad',
            [
                'label' => __('Padding', 'themexriver-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .accorbody' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
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
                'class' => ['accordion txul', substr($this->get_id_int(), 0, 3)],
            ]
        );
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \Themexriver_Addon\Widgets\tx_accordion());
