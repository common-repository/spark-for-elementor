<?php
namespace Themexriver_Addon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class tx_team_1 extends Widget_Base
{
    public function get_name()
    {
        return 'tx-team-1';
    }

    public function get_title()
    {
        return __('Team', 'themexriver-addon');
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'img',
            [
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label' => __('Image', 'themexriver-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'pos',
            [
                'label' => esc_html__('Position', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'type' => Controls_Manager::URL,
                'label' => __('Link', 'themexriver-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'fb',
            [
                'label' => esc_html__('Facebook url', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tw',
            [
                'label' => esc_html__('Twitter url', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ig',
            [
                'label' => esc_html__('Instagram url', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'lk',
            [
                'label' => esc_html__('Linkedin url', 'themexriver-addon'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
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
            'ght',
            [
                'label' => esc_html__('Height', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'min' => 1,
                        'step' => 1,
                    ]
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tx-team' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_carou',
            [
                'label' => esc_html__('Carousel', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'swbpd',
            [
                'label' => esc_html__('Bottom padding', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-container' => 'padding-bottom:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'arrow',
            [
                'label' => esc_html__('Hide arrow', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'themexriver-addon'),
                'label_off' => esc_html__('No', 'themexriver-addon'),
                'selectors' => [
                    '{{WRAPPER}} .tx-arrow' => 'display:none;',
                ],
            ]
        );

        $this->add_control(
            'dot',
            [
                'label' => esc_html__('Hide dot', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'themexriver-addon'),
                'label_off' => esc_html__('No', 'themexriver-addon'),
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'display:none !important;',
                ],
            ]
        );

        $this->add_control(
            'auto',
            [
                'label' => esc_html__('Autoplay', 'themexriver-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'themexriver-addon'),
                'label_off' => esc_html__('No', 'themexriver-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Slide speed', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'auto' => 'yes',
                ],
                'default' => [
                    'size' => 2000,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 8000,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'space',
            [
                'label' => esc_html__('Spacing', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px'],
            ]
        );

        $this->add_control(
            'item',
            [
                'label' => esc_html__('Items', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 3,
                ],
            ]
        );

        $this->add_control(
            'itemtab',
            [
                'label' => esc_html__('Items tablet', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 2,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_arow',
            [
                'label' => esc_html__('Arrow', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrow!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'previkn',
            [
                'label' => esc_html__('Previous icon', 'themexriver-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nextikn',
            [
                'label' => esc_html__('Next icon', 'themexriver-addon'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $this->add_responsive_control(
            'ar_wh',
            [
                'label' => esc_html__('Width & height', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .txprnx' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arbg',
            [
                'label' => esc_html__('Background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .txprnx' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arclr',
            [
                'label' => esc_html__('Color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .txprnx' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arhbg',
            [
                'label' => esc_html__('Hover background', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .txprnx:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arhclr',
            [
                'label' => esc_html__('Hover color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .txprnx:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dbclr',
            [
                'label' => esc_html__('Border color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .txprnx' => 'border:1px solid {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrad',
            [
                'label' => esc_html__('Border radius', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .txprnx' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arfx',
            [
                'label' => esc_html__('Font size', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .txprnx' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_caroucs',
            [
                'label' => esc_html__('Dot', 'themexriver-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dot!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dal',
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_sp',
            [
                'label' => esc_html__('Spacing', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin:0px {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dvp',
            [
                'label' => esc_html__('Vertical position', 'themexriver-addon'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],

                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom:{{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'dt-m',
            [
                'label' => esc_html__('Main color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination span' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dt-s',
            [
                'label' => esc_html__('Active color', 'themexriver-addon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
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
                'class' => [ 'swiper-container txswiper tx-team-1', $settings['zoom'] ],
            ]
        );
        require dirname(__FILE__) . '/view.php';
    }
}

$widgets_manager->register(new \Themexriver_Addon\Widgets\tx_team_1());
