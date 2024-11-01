<?php
namespace Themexriver_Addon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\utils;
use Themexriver_Addon\Themexriver_Addon_Helper;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class tx_tutor_course_grid extends Widget_Base
{
    public function get_name()
    {
        return 'tx-course-grid';
    }

    public function get_title()
    {
        return __('Course grid', 'themexriver-addon');
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
            'cat',
            [
                'label' => __('Category', 'themexriver-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => Themexriver_Addon_Helper::drop_tax('course-category'),
                'multiple' => true,
                'label_block' => true,
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



        $this->end_controls_section();

        $this->start_controls_section(
            'section_carou',
            [
                'label' => esc_html__('Carousel', 'themexriver-addon'),
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

$widgets_manager->register(new \Themexriver_Addon\Widgets\tx_tutor_course_grid());
