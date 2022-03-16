<?php
namespace ETC\App\Controllers\Elementor\General;

use ETC\App\Traits\Elementor;
use ETC\App\Controllers\Shortcodes\Products as Products_Shortcode;
use ETC\Views\Elementor as View;

/**
 * Advanced tabs widget.
 *
 * @since      2.3.3
 * @package    ETC
 * @subpackage ETC/Controllers/Elementor
 */
class Advanced_Tabs extends \Elementor\Widget_Base {

	use Elementor;

    /**
    * Get widget name.
    *
    * @since 2.3.3
    * @access public
    *
    * @return string Widget name.
    */
    public function get_name() {
    	return 'et-advanced-tabs';
    }

    /**
     * Get widget title.
     *
     * @since 2.3.3
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
    	return __( 'Ajax Product Tabs', 'xstore-core' );
    }

    /**
     * Get widget icon.
     *
     * @since 2.3.3
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
    	return 'eight_theme-elementor-icon et-elementor-product-tabs';
    }

    /**
     * Get widget keywords.
     *
     * @since 2.3.3
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords(){
    	return [ 'product', 'tabs', 'product-tabs'];
    }

    /**
     * Get widget categories.
     *
     * @since 2.3.3
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
    	return ['eight_theme_general'];
    }

	/**
	* Register general tabs widget controls.
	*
	* @since 2.3.3
	* @access protected
	*/
	protected function _register_controls() {
		$this->start_controls_section(
			'et_section_tabs_settings',
			[
				'label' => esc_html__( 'General', 'xstore-core' ),
			]
		);

		$this->add_control(
			'et_tab_horizontal_style',
			[
				'label' => esc_html__( 'Style', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'horizontal-style-1' => esc_html__( 'Style 1', 'xstore-core' ),
					'horizontal-style-2' => esc_html__( 'Style 2', 'xstore-core' ),
					'horizontal-style-3' => esc_html__( 'Style 3', 'xstore-core' ),
					'horizontal-style-4' => esc_html__( 'Style 4', 'xstore-core' ),
					'horizontal-style-5' => esc_html__( 'Style 5', 'xstore-core' ),
					'horizontal-style-6' => esc_html__( 'Style 6', 'xstore-core' ),
					'horizontal-style-7' => esc_html__( 'Style 7', 'xstore-core' ),
				],
				'default'   => 'horizontal-style-1',
			]
		);

		$this->add_control(
			'et_tabs_position',
			[
				'label' => esc_html__( 'Position', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'center' 	=> esc_html__( 'Center', 'xstore-core' ),
					'end' 	 	=> esc_html__( 'Left', 'xstore-core' ),
					'flex-end'  => esc_html__( 'Right', 'xstore-core' ),
				],
				'default'   => 'center',
				'conditions' => [
					'terms'  => [
						[
							'name'      => 'et_tab_horizontal_style',
							'operator'  => '!in',
							'value'     => ['horizontal-style-6','horizontal-style-7'],
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'et_tabs_spacer_margin',
			[
				'label' => __('Tab Spacer', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(:last-child):not(.skip)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms'  => [
						[
							'name'      => 'et_tab_horizontal_style',
							'operator'  => '!in',
							'value'     => ['horizontal-style-3'],
						]
					]
				]
			]
		);

		$this->add_responsive_control(
			'et_tabs_spacer_padding',
			[
				'label' => __('Tab Spacer', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs.horizontal-style-3 .et-tabs-nav > ul li:not(.skip)' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'et_tab_horizontal_style',
							'operator' => 'in',
							'value'    => ['horizontal-style-3']
						]
					]
				]
			]
		);

		$this->add_control(
			'Settings_header',
			[
				'label' => __( 'Slider Settings', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'style',
			[
				'label'         =>  __( 'Product Layout For Slider', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'options'       =>  [
					'default'   =>  esc_html__('Grid', 'xstore-core'), 
					'advanced'  =>  esc_html__('List', 'xstore-core')
				],
				'default'       => 'default'
			]
		);

		$this->add_control(
			'no_spacing',
			[
				'label'         =>  __( 'Remove Space Between Products', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>  'yes',
				'default'       =>  '',
			]
		);

		$this->add_control(
			'per_iteration',
			[
				'label'         =>  __( 'Products Per View', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::TEXT,
				'description'   =>  __( 'Number of products to show per view and after every loading', 'xstore-core' ),
				'condition'     =>  ['navigation' => array( 'btn', 'lazy' )]
			]
		);

		$this->add_control(
			'ajax',
			[
				'label'         =>  __( 'Lazy Loading For This Element', 'xstore-core' ),
				'description'   =>  __( 'Works for live mode, not for the preview', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>  'true',
				'default'       =>  '',
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label' 		=> __( 'Autoplay', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'return_value' 	=> 'true',
				'default' 		=> '',
			]
		);

		$this->add_control(
			'slider_stop_on_hover',
			[
				'label' 		=> __( 'Pause On Hover', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'return_value' 	=> 'true',
				'default' 		=> '',
				'condition' 	=> ['slider_autoplay' => 'true'],
			]
		);

		$this->add_control(
			'slider_interval',
			[
				'label' 		=> __( 'Autoplay Speed', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
				'description' 	=> __( 'Interval between slides. In milliseconds.', 'xstore-core' ),
				'return_value' 	=> 'true',
				'default' 		=> 3000,
				'condition' 	=> ['slider_autoplay' => 'true'],
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label' 		=> __( 'Infinite Loop', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'return_value' 	=> 'true',
				'default' 		=> 'true',
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' 		=> __( 'Transition Speed', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
				'description' 	=> __( 'Duration of transition between slides. In milliseconds.', 'xstore-core' ),
				'default' 		=> '300',
			]
		);

		$this->add_responsive_control(
			'slides',
			[
				'label' 	=>	__( 'Slider Items', 'xstore-core' ),
				'type' 		=>	\Elementor\Controls_Manager::NUMBER,
				'default' 	=>	4,
				'default_tablet' => 3,
				'default_mobile' => 2,
				'min' => 0,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'et_section_tabs_content_settings',
			[
				'label' => esc_html__('Content', 'xstore-core'),
			]
		);

		$this->add_control(
			'et_tabs_icon_show_horizontal',
			[
				'label' => esc_html__( 'Enable Icon', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'et_tab_icon_position_horizontal',
			[
				'label' => esc_html__( 'Icon Position', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'et-tab-inline-icon',
				'label_block' => false,
				'options' => [
					'et-tab-top-icon' 	 => esc_html__('Stacked', 'xstore-core'),
					'et-tab-inline-icon' => esc_html__('Inline', 'xstore-core'),
				],
				'condition' => ['et_tabs_icon_show_horizontal' => 'yes'],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs(
			'settings'
		);

		$repeater->start_controls_tab(
			'settings_tab',
			[
				'label' => __( 'Settings', 'xstore-core' ),
			]
		);

		$repeater->add_control(
			'tabs_settings_header',
			[
				'label' => __( 'Tab Settings', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'et_tabs_tab_show_as_default', [
				'label' => __('Set as Default', 'xstore-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'inactive',
				'return_value' => 'active-default',
			]
		);

		$repeater->add_control(
			'et_tabs_icon_type', [
				'label' => esc_html__('Icon Type', 'xstore-core'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => esc_html__('None', 'xstore-core'),
						'icon' => 'fa fa-ban',
					],
					'icon' => [
						'title' => esc_html__('Icon', 'xstore-core'),
						'icon' => 'fa fa-gear',
					],
					'image' => [
						'title' => esc_html__('Image', 'xstore-core'),
						'icon' => 'fa fa-picture-o',
					],
				],
				'default' => 'icon',
			]
		);

		$repeater->add_control(
			'et_tabs_tab_title_icon', [
				'label' => esc_html__('Icon', 'xstore-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
				'condition'	=> ['et_tabs_icon_type' => 'icon']
			]
		);		

		$repeater->add_control(
			'et_tabs_tab_title_image', [
				'label' => esc_html__('Image', 'xstore-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'	=> ['et_tabs_icon_type' => 'image']
			]
		);

		$repeater->add_control(
			'et_tabs_tab_title', [
				'label' => esc_html__('Tab Title', 'xstore-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Tab Title', 'xstore-core'),
			]
		);

		$repeater->add_control(
			'content_settings_header',
			[
				'label' => __( 'Content Settings', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'et_tabs_content_title', [
				'label' => esc_html__('Content Title', 'xstore-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$repeater->add_responsive_control(
			'et_tab_content_title_position',
			[

				'label' => esc_html__( 'Content Title Position', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min'  => -40,
						'max'  => 40,
						'step' => 1
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav ul .et-content-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);		

		$repeater->add_control(
			'show_counter',
			[
				'label'         =>  __( 'Show Sale Counter', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>  'yes',
				'default'       =>  'yes',
			]
		);

		$repeater->add_control(
			'show_stock',
			[
				'label'         =>  __( 'Show Stock Count Bar', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>  'yes',
				'default'       =>  'yes',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'settings_product_data_section_tab',
			[
				'label' => __( 'Data', 'xstore-core' ),
			]
		);

		$repeater->add_control(
			'products',
			[
				'label'         =>  __( 'Products Type', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'options'       =>  [
					''                  =>  esc_html__('All', 'xstore-core'),
					'featured'          =>  esc_html__('Featured', 'xstore-core'),
					'sale'              =>  esc_html__('Sale', 'xstore-core'),
					'recently_viewed'   =>  esc_html__('Recently viewed', 'xstore-core'),
					'bestsellings'      =>  esc_html__('Bestsellings', 'xstore-core'),
				],
			]
		);      

		$repeater->add_control(
			'orderby',
			[
				'label'         =>  __( 'Order By', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'description'  => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s. Default by Date', 'xstore-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'options'       =>  [
					'date'          =>  esc_html__( 'Date', 'xstore-core' ),
					'ID'            =>  esc_html__( 'ID', 'xstore-core' ),
					'post__in'      =>  esc_html__( 'As IDs provided order', 'xstore-core' ),
					'author'        =>  esc_html__( 'Author', 'xstore-core' ),
					'title'         =>  esc_html__( 'Title', 'xstore-core' ),
					'modified'      =>  esc_html__( 'Modified', 'xstore-core' ),
					'rand'          =>  esc_html__( 'Random', 'xstore-core' ),
					'comment_count' =>  esc_html__( 'Comment count', 'xstore-core' ),
					'menu_order'    =>  esc_html__( 'Menu order', 'xstore-core' ),
					'price'         =>  esc_html__( 'Price', 'xstore-core' ),
				],
				'default'       => 'date'
			]
		);

		$repeater->add_control(
			'order',
			[
				'label'         =>  __( 'Order Way', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'description'   => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s. Default by ASC', 'xstore-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'options'       =>  [
					'ASC'       =>  esc_html__( 'Ascending', 'xstore-core' ),
					'DESC'      =>  esc_html__( 'Descending', 'xstore-core' ),
				],
				'default'       => 'ASC'
			]
		);

		$repeater->add_control(
			'hide_out_stock',
			[
				'label'         =>  __( 'Hide Out Of Stock Products', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SWITCHER,
				'return_value'  =>  'yes',
				'default'       =>  '',
			]
		);

		// $repeater->add_control(
		// 	'ids',
		// 	[
		// 		'label'         =>  __( 'Products', 'xstore-core' ),
		// 		'type'          =>  \Elementor\Controls_Manager::SELECT2,
		// 		'description'   =>  esc_html__( 'Enter List of Products.', 'xstore-core' ),
		// 		'label_block'   => 'true',
		// 		'multiple'  =>  true,
		// 		'options'   =>  Elementor::get_products(),
		// 	]
		// );
		$repeater->add_control(
			'ids',
			[
				'label' 		=> __( 'Products', 'xstore-core' ),
				'label_block' 	=> true,
				'type' 			=> 'etheme-ajax-product',
				'multiple' 		=> true,
				'placeholder' 	=> 'Search ',
				'data_options' 	=> [
					'post_type' => array( 'product_variation', 'product' ),
				],
			]
		);

		$repeater->add_control(
			'taxonomies',
			[
				'label'         =>  __( 'Categories', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT2,
				'description'   =>  esc_html__( 'Enter categories.', 'xstore-core' ),
				'label_block'   => 'true',
				'multiple'  =>  true,
				'options'       => Elementor::get_terms('product_cat'),
			]
		);

		$repeater->add_control(
			'limit',
			[
				'label'         =>  __( 'Limit', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::TEXT,
				'description'   =>  esc_html__( 'Use "-1" to show all products.', 'xstore-core' ),
				'limit'         =>  '20',
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'et_tabs_tab',
			[
				'label' => __( 'Tab Title', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					['et_tabs_tab_title' => esc_html__('Tab Title 1', 'xstore-core')],
					['et_tabs_tab_title' => esc_html__('Tab Title 2', 'xstore-core')],
					['et_tabs_tab_title' => esc_html__('Tab Title 3', 'xstore-core')],
				],
				'title_field' => '{{et_tabs_tab_title}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'et_section_tabs_tab_style_settings',
			[
				'label' => esc_html__('Tab Style', 'xstore-core'),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'et_tabs_tab_title_typography',
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip)',
			]
		);

		$this->add_responsive_control(
			'et_tabs_tab_icon_size_horizontal',
			[
				'label' => __('Icon Size', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['et_tabs_icon_show_horizontal' => 'yes'],
			]
		);

		$this->add_responsive_control(
			'et_tabs_tab_icon_gap_horizontal',
			[
				'label' => __('Icon Gap', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .et-tab-inline-icon li i, {{WRAPPER}} .et-tab-inline-icon li img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .et-tab-top-icon li i, {{WRAPPER}} .et-tab-top-icon li img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['et_tabs_icon_show_horizontal' => 'yes'],
			]
		);

		$this->add_responsive_control(
			'et_tabs_tab_padding',
			[
				'label' 				=> esc_html__('Padding', 'xstore-core'),
				'type' 					=>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 			=> ['px', 'em', '%'],
				'selectors'				=> [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'et_tabs_tab_margin',
			[
				'label' => esc_html__('Margin', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('et_tabs_header_tabs');
		$this->start_controls_tab( 'et_tabs_header_normal',
			[
				'label' => esc_html__('Normal', 'xstore-core')
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'et_tabs_tab_bgtype',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip)'
			]
		);

		$this->add_control(
			'et_tabs_tab_text_color',
			[
				'label' => esc_html__('Text Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'et_tabs_tab_icon_color_horizontal',
			[
				'label' => esc_html__('Icon Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li i' => 'color: {{VALUE}};',
				],
				'condition' => ['et_tabs_icon_show_horizontal' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'et_tabs_header_hover', 
			[
				'label' => esc_html__('Hover', 'xstore-core')
			]
		);

		$this->add_control(
			'et_tabs_tab_color_hover',
			[
				'label' => esc_html__('Tab Background Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'et_tabs_tab_bgtype_hover',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip):hover'
			]
		);

		$this->add_control(
			'et_tabs_tab_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'et_tabs_tab_icon_color_hover_horizontal',
			[
				'label' => esc_html__('Icon Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:not(.skip):hover > i' => 'color: {{VALUE}};'
				],
				'condition' => ['et_tabs_icon_show_horizontal' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'et_tabs_header_active', 
			[
				'label' => esc_html__('Active', 'xstore-core')
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'et_tabs_tab_bgtype_active',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active:not(.skip),{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active-default:not(.skip)'
			]
		);

		$this->add_control(
			'et_tabs_tab_text_color_active',
			[
				'label' => esc_html__('Text Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active:not(.skip)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul .active-default .et-tab-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'et_tabs_tab_icon_color_active_horizontal',
			[
				'label' => esc_html__('Icon Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active-default > i' => 'color: {{VALUE}};',
				],
				'condition' => ['et_tabs_icon_show_horizontal' => 'yes'],
			]
		);

		$this->add_control(
			'et_tabs_tab_divider_show',
			[
				'label' => esc_html__( 'Hide Divider', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'return_value' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active .et-tab-title:after' => 'opacity: 0 !important',
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:after' => 'opacity: 0 !important',
				],
			]
		);

		$this->add_control(
			'et_tabs_tab_divider_color',
			[
				'label' => esc_html__( 'Divider Color', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.active .et-tab-title:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li:after' => 'background-color: {{VALUE}};',
				],
				'condition' => ['et_tabs_tab_divider_show' => ''],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'content_title_control_heading',
			[
				'label' => __( 'Content Title', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'et_content_title_bg_tab_bgtype',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.et-content-title'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'et_content_title_typography',
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.et-content-title',
			]
		);

		$this->add_control(
			'et_content_title_text_color',
			[
				'label' => esc_html__('Content Title Color', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-nav > ul li.et-content-title span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'et_section_tabs_tab_content_style_settings',
			[
				'label' => esc_html__('Content Style', 'xstore-core'),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'adv_tabs_content_bgtype',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-content > div'
			]
		);

		$this->add_responsive_control(
			'et_tabs_content_padding',
			[
				'label' => esc_html__('Padding', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'et_tabs_content_margin',
			[
				'label' => esc_html__('Margin', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'et_tabs_content_border',
				'label' => esc_html__('Border', 'xstore-core'),
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-content > div',
			]
		);
		$this->add_responsive_control(
			'et_tabs_content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'xstore-core'),
				'type' =>  \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .et-advance-tabs .et-tabs-content > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'et_tabs_content_shadow',
				'selector' => '{{WRAPPER}} .et-advance-tabs .et-tabs-content > div',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_content_section',
			[
				'label' => __( 'Navigation & Pagination', 'xstore-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'navigation_header',
			[
				'label' => __( 'Navigation', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hide_buttons',
			[
				'label' 		=> __( 'Show Navigation', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'hide_buttons_for',
			[
				'label' 		=> __( 'Hide Navigation Only For', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'' 			=>  __( 'Both', 'xstore-core' ),
					'mobile'	=>	__( 'Mobile', 'xstore-core' ),
					'desktop'	=>	__( 'Desktop', 'xstore-core' ),
				],
				'condition' => ['hide_buttons' => '']
			]
		);

		$this->add_control(
			'navigation_style',
			[
				'label' 		=> __( 'Navigation Style', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'arrow-style-1' 	=>	__( 'Arrow Style 1', 'xstore-core' ),
					'arrow-style-2' 	=>	__( 'Arrow Style 2', 'xstore-core' ),
					'arrow-style-3' 	=>	__( 'Arrow Style 3', 'xstore-core' ),
					'arrow-style-4' 	=>	__( 'Arrow Style 4', 'xstore-core' ),
					'arrow-style-5' 	=>	__( 'Arrow Style 5', 'xstore-core' ),
					'arrow-style-6' 	=>	__( 'Arrow Style 6', 'xstore-core' ),
					'archery-style-1' 	=>	__( 'Archery Style 1', 'xstore-core' ),
					'archery-style-2' 	=>	__( 'Archery Style 2', 'xstore-core' ),
					'archery-style-3' 	=>	__( 'Archery Style 3', 'xstore-core' ),
					'archery-style-4' 	=>	__( 'Archery Style 4', 'xstore-core' ),
					'archery-style-5' 	=>	__( 'Archery Style 5', 'xstore-core' ),
					'archery-style-6' 	=>	__( 'Archery Style 6', 'xstore-core' ),
				],
				'default'	=> 'arrow-style-1',
				'condition' => ['hide_buttons' => 'yes']
			]
		);

		$this->add_control(
			'navigation_position',
			[
				'label' 		=> __( 'Navigation Position', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'nav-bar' 			=>	__( 'Nav Bar', 'xstore-core' ),
					'middle' 			=>	__( 'Middle', 'xstore-core' ),
					'middle-inside' 	=>	__( 'Middle Inside', 'xstore-core' ),
				],
				'default'	=> 'middle',
				'condition' => ['hide_buttons' => 'yes']
			]
		);

		$this->add_control(
			'navigation_position_style',
			[
				'label' 		=> __( 'Nav Hover Style', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'hover' 	=>	__( 'Display On Hover', 'xstore-core' ),
					'always' 	=>	__( 'Always Display', 'xstore-core' ),
				],
				'default'		=> 'hover',
				'conditions' 	=> [
					'relation' => 'and',
					'terms' 	=> [
						[
							'name' 		=> 'hide_buttons',
							'operator'  => '=',
							'value' 	=> 'yes'
						],
						[
							'relation' => 'or',
							'terms' 	=> [
								[
									'name' 		=> 'navigation_position',
									'operator'  => '=',
									'value' 	=> 'middle'
								],
								[
									'name' 		=> 'navigation_position',
									'operator'  => '=',
									'value' 	=> 'middle-inside'
								],
							]
						]
					]	
				]
			]
		);

		$this->add_responsive_control(
			'navigation_nav_position',
			[
				'label'		 =>	__( 'Nav Spacer', 'xstore-core' ),
				'type' 		 => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 200,
						'step' 	=> 1
					],
				],
				'conditions' 	=> [
					'relation' 	=> 'and',
					'terms' 	=> [
						[
							'name' 		=> 'hide_buttons',
							'operator'  => '=',
							'value' 	=> 'yes'
						],
						[
							'name' 		=> 'navigation_position',
							'operator'  => '=',
							'value' 	=> 'nav-bar'
						]
					]
				]
			]
		);

		$this->add_control(
			'pagination_header',
			[
				'label' => __( 'Pagination', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label' 		=> __( 'Pagination Type', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'hide' 		=>	__( 'Hide', 'xstore-core' ),
					'bullets' 	=>	__( 'Bullets', 'xstore-core' ),
					'lines' 	=>	__( 'Lines', 'xstore-core' ),
				],
				'default' 		=> 'hide',
			]
		);

		$this->add_control(
			'hide_fo',
			[
				'label' 		=> __( 'Hide Pagination Only For', 'xstore-core' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'' 			=>  __( 'Select option', 'xstore-core' ),
					'mobile'	=>	__( 'Mobile', 'xstore-core' ),
					'desktop'	=>	__( 'Desktop', 'xstore-core' ),
				],
				'condition' => ['pagination_type' => ['bullets', 'lines' ]],
			]
		);

		$this->add_control(
			'default_color',
			[
				'label' 	=> __( 'Pagination Color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type' 	=> \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' 	=> '#e1e1e1',
				'condition' => ['pagination_type' => ['bullets', 'lines' ]],
			]
		);

		$this->add_control(
			'active_color',
			[
				'label' 	=> __( 'Pagination Color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'scheme' 	=> [
					'type'  => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' 	=> '#222',
				'condition' => ['pagination_type' => ['bullets', 'lines' ]],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_view_settings',
			[
				'label' => __( 'Product View', 'xstore-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_view',
			[
				'label'         =>  __( 'Product View', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'options'       =>  [
					''         	=>  esc_html__('Inherit', 'xstore-core'),
					'default'   =>  esc_html__('Default', 'xstore-core'),
					'mask3'     =>  esc_html__('Buttons on hover middle', 'xstore-core'),
					'mask'      =>  esc_html__('Buttons on hover bottom', 'xstore-core'),
					'mask2'     =>  esc_html__('Buttons on hover right', 'xstore-core'),
					'info'      =>  esc_html__('Information mask', 'xstore-core'),
					'booking'   =>  esc_html__('Booking', 'xstore-core'),
					'light'     =>  esc_html__('Light', 'xstore-core'),
					'Disable'   =>  esc_html__('Disable', 'xstore-core'),
				]
			]
		);

		$this->add_control(
			'product_view_color',
			[
				'label'         =>  __( 'Product View Color', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'options'       =>  [
					''          =>  esc_html__('Default', 'xstore-core'),
					'white' 		=>  esc_html__('White', 'xstore-core'),
					'dark'  		=>  esc_html__('Dark', 'xstore-core'),
					'transparent'   =>  esc_html__('Transparent', 'xstore-core'),
				]
			]
		);

		$this->add_control(
			'product_img_hover',
			[
				'label'         =>  __( 'Image Hover Effect', 'xstore-core' ),
				'type'          =>  \Elementor\Controls_Manager::SELECT,
				'options'       =>  [
					''          =>  esc_html__( 'Default', 'xstore-core' ),
					'disable'   =>  esc_html__( 'Disable', 'xstore-core' ),
					'swap'      =>  esc_html__( 'Swap', 'xstore-core' ),
					'slider'    =>  esc_html__( 'Images Slider', 'xstore-core' ),
				],
				'condition'     => ['product_view' => array( '', 'default', 'mask3', 'mask', 'mask2', 'info', 'booking', 'light', 'Disable' ) ]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_style_section',
			[
				'label' => __( 'Slider Style', 'xstore-core' ),
				'tab' =>  \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['hide_buttons' => 'yes']
			]
		);

		$this->add_responsive_control(
			'navigation_arrow_size',
			[

				'label'	=>	__( 'Nav Arrow Size', 'xstore-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 70,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-prev:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' 	=> [
					'relation' => 'or',
					'terms' 	=> [					
						[
							'name' 		=> 'navigation_position',
							'operator'  => '=',
							'value' 	=> 'middle'
						],						
						[
							'name' 		=> 'navigation_position',
							'operator'  => '=',
							'value' 	=> 'middle-inside'
						]
					]
				],
			]
		);

		$this->add_control(
			'advanced_nav_color',
			[
				'label' 	=> __( 'Nav Color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-next.navbar' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-prev.navbar' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-next' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-prev' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-next.bottom' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-prev.bottom' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'advanced_arrows_bg_color',
			[
				'label' 	=> __( 'Nav Background Color', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-next.navbar' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-prev.navbar' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-next' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-prev' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-next.bottom' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-prev.bottom' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'advanced_nav_color_hover',
			[
				'label' 	=> __( 'Nav Color Hover', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-next.navbar:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-prev.navbar:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-next:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-prev:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-next.bottom:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-prev.bottom:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'advanced_arrows_bg_color_hover',
			[
				'label' 	=> __( 'Nav Background Hover', 'xstore-core' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-next.navbar:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .et-tabs-nav .swiper-button-prev.navbar:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-next:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-entry .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-next.bottom:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .et-advance-product-tabs .swiper-button-prev.bottom:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();


	}

    /**
    * Render general tabs widget output on the frontend.
    *
    * @since 2.3.3
    * @access protected
    */
    protected function render() {
    	$settings = $this->get_settings_for_display();

    	$this->add_render_attribute(
    		'et_tab_wrapper',
    		[
    			'id' => "et-advance-tabs-{$this->get_id()}",
    			'class' => ['et-advance-tabs', 'et-advance-product-tabs', 'et-tabs-horizontal', $settings['et_tab_horizontal_style']],
    			'data-tabid' => $this->get_id(),
    		]
    	);

    	if ( 'yes' === $settings['et_tabs_icon_show_horizontal'] ) {
    		$this->add_render_attribute('et_tab_ul', 'class', esc_attr( $settings['et_tab_icon_position_horizontal'] ) );
    	}

    	if ( 'horizontal-style-7' == $settings['et_tab_horizontal_style'] ) {
    		$this->add_render_attribute('et_tab_ul', 'class', 'center' );
    	} else {
    		$this->add_render_attribute('et_tab_ul', 'class', esc_attr( $settings['et_tabs_position'] ) );
    	}

        $view = new View;
        $Products_Shortcode = Products_Shortcode::get_instance();

        $view->advanced_tabs(
            array(
                'settings'  	 		=> $settings,
                'et_tab_wrapper' 		=> $this->get_render_attribute_string('et_tab_wrapper'),
                'et_tab_ul'  			=> $this->get_render_attribute_string('et_tab_ul'),
                'Products_Shortcode'  	=> $Products_Shortcode,
                '_wid'  				=> $this->get_id(),
                'is_preview'  			=> ( \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false ),
            )
        );

    }

}