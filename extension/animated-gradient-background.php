<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}

class Tx_Gradient_Back_Animation 
{
    public static function init()
    {
        add_action('elementor/element/section/section_background_overlay/after_section_end', [
            __CLASS__,
            'tp_callback_function' 
        ], 10, 2);
        add_action( 'elementor/frontend/section/before_render', array( __CLASS__, 'before_render' ), 10, 1 );
		add_action( 'elementor/frontend/container/before_render', array( __CLASS__, 'before_render' ), 10, 1 );

		add_action( 'elementor/section/print_template', array( __CLASS__, 'print_template' ), 10, 2 );
		add_action( 'elementor/container/print_template', array( __CLASS__, 'print_template' ), 10, 2 );

    }

    public static function tp_callback_function($element, $args)
    {
        $element->start_controls_section(
            'tpbtnsx',
            [
                'label' => __('Gradient background', 'thepack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
			'tr_anim_grad_bg',
			[
				'type'         => Controls_Manager::SWITCHER,
				'label'        => __( 'Animated Gradient Background', 'powerpack' ),
				'return_value' => 'yes',
				'prefix_class' => 'tx-gradient-bg-',
				'render_type'  => 'template',    
			]
		);

        $element->add_control(     
			'tr_anim_grad_angle',
			[     
				'label'      => __( 'Angle', 'powerpack' ),   
				'type'       => Controls_Manager::SLIDER,   
				'size_units' => [ 'deg' ],   
				'range'      => [   
					'deg' => [
						'min'  => -45,
						'max'  => 180,
						'step' => 2,
					],
				],
				'default'    => [
					'unit' => 'deg',
					'size' => -45,
				],
				'selectors'  => [
					'{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'tr_anim_grad_bg' => 'yes',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'bg_color',  
			[
				'label' => __( 'Add Color', 'powerpack' ),
				'type'  => Controls_Manager::COLOR,
			]
		);    

		$element->add_control(
			'bg_color_list',
			[
				'label'       => __( 'Color', 'powerpack' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => 'Color {{{bg_color}}}',
				'show_label'  => true,

				'default'     => [
					[
						'bg_color' => '#F6AD1F',
					],
					[
						'bg_color' => '#F7496A',
					],
					[
						'bg_color' => '#565AD8',
					],
				],

				'condition'   => [
					'tr_anim_grad_bg' => 'yes',   
				],
			]   
		);

        $element->end_controls_section();
    }

	public static function before_render( $element ) {
        
		$settings  = $element->get_settings();

		if ( 'yes' === $settings['tr_anim_grad_bg'] ) {
			$angle = $settings['tr_anim_grad_angle']['size'];
			$element->add_render_attribute( '_wrapper', 'data-angle', $angle . 'deg' );
			$gradient_color_list = $settings['bg_color_list'];
			foreach ( $gradient_color_list as $gradient_color ) {
				$color[] = $gradient_color['bg_color'];
			};
			$colors = implode( ',', $color );
			$colors = rtrim($colors,',');

			$element->add_render_attribute( '_wrapper', 'data-color', $colors );
		}
	}

	public static function print_template( $template, $widget ) {
		if ( ! $template ) {
			return;
		}
		ob_start();   
		$old_template = $template;
		?>
		<# if ( 'yes' === settings.tr_anim_grad_bg ) {
			color_list = settings.bg_color_list;
			angle = settings.tr_anim_grad_angle.size + 'deg';
			var color = [];
			var i = 0;
			_.each(color_list , function(color_list){
					color[i] = color_list.bg_color;
					i = i+1;
			});
			view.addRenderAttribute('_wrapper', 'data-color', color);
			var gradientColorEditor = 'linear-gradient( ' + angle + ',' + color + ' )';
			#>
			<div class="tx-gradient-bg-yes" style="background-image : {{{ gradientColorEditor }}};position:absolute;left:0;width:100%;height:100%;top:0;"></div>
		<# } #>
		<?php
		$animated_gradient_content = ob_get_contents();
		ob_end_clean();
		$template = $animated_gradient_content . $old_template;
		return $template;
	}

}

Tx_Gradient_Back_Animation::init();
