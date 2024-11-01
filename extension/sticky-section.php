<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}
    
class Tx_Sticky_Section  
{
    public static function init()
    {            

		add_action('elementor/element/column/section_advanced/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);

		add_action('elementor/element/section/section_advanced/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);

        add_action( 'elementor/frontend/before_render', array( __CLASS__, 'before_render' ), 10, 1 );

    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tx_stky',
            [
                'label' => __('Sticky section', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$element->add_control(
            'exad_enable_section_sticky',
            [
				'label'        => __( 'Enable', 'exclusive-addons-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
                'return_value' => 'yes',
                'render_type'  => 'template',
				'label_on'     => __( 'Enable', 'exclusive-addons-elementor' ),
                'label_off'    => __( 'Disable', 'exclusive-addons-elementor' ),
                'prefix_class' => 'exad-sticky-section-',
            ]
        );
        
        $element->add_control(
			'exad_sticky_top_spacing',
			[
				'label' => __( 'Top Spacing', 'exclusive-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 500,
				'step' => 1,
                'default' => 20,
                'condition' => [
                    'exad_enable_section_sticky' => 'yes'
                ],
                'render_type' => 'none',
				'frontend_available' => true,
            ]
        );

        $element->end_controls_section();
    }

	public static function before_render( $element ) {
        
        $settings = $element->get_settings();
        $data     = $element->get_data();
        $type     = isset( $data['elType'] ) ? $data['elType'] : 'column';

        if ( 'column' !== $type ) {
            return false;
        }

        if ( isset( $settings['exad_enable_section_sticky'] ) ) {

            if ( filter_var( $settings['exad_enable_section_sticky'], FILTER_VALIDATE_BOOLEAN ) ) {

                $element->add_render_attribute( '_wrapper', array(
                    'class'         => 'exad-column-sticky',
                    'data-type' => $type,
                    'data-top_spacing' => $settings['exad_sticky_top_spacing'],
                ) );

                $element->sticky_columns[] = $data['id'];
            }
        }
	}
                  
}

Tx_Sticky_Section ::init();
