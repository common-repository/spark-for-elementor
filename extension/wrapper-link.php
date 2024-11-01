<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}

class Tx_Wrapper_Link
{
    public static function init()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);              

        add_action('elementor/element/column/section_advanced/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);                                                                          

        add_action('elementor/element/section/section_advanced/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);

        add_action( 'elementor/frontend/before_render', [__CLASS__, 'before_render'], 10, 1 );
    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tx_wr_link',
            [
                'label' => __('Wrapper link', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
			'tx_wrapper_link',
			[
			    'label' => __( 'Link', 'thepack' ),
			    'type' => Controls_Manager::URL,
			    'dynamic' => [
			        'active' => true,
			    ],			
			    'placeholder' => 'https://themexriver.com/',
			]
		);

        $element->end_controls_section();
    }

    public static function before_render( $element )
    {
        $settings = $element->get_settings();
        $link = $settings['tx_wrapper_link'];

        if ( $link['url'] ) {
            $link_attributes = [
                'url' => esc_url( $link['url'] ),
                'is_external' => esc_attr( $link['is_external'] ),
                'nofollow' => esc_attr( $link['nofollow'] ),
            ];
            $element->add_render_attribute(
				'_wrapper', [
				    'data-tx-wrapper-link' => wp_json_encode( $link_attributes ),
				    'class' => 'tx-wrapper-link',
				]
			);
        }
    }
}

Tx_Wrapper_Link::init();
