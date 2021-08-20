<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Uomo_Elementor_Woo_Category_Banner extends Widget_Base {

	public function get_name() {
        return 'apus_element_woo_category_banner';
    }

	public function get_title() {
        return esc_html__( 'Apus Product Category Banner', 'uomo' );
    }

    public function get_icon() {
        return 'fa fa-shopping-bag';
    }

	public function get_categories() {
        return [ 'uomo-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'uomo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'uomo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-category-banner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'uomo' ),
                'placeholder' => esc_html__( 'Enter your title', 'uomo' ),
            ]
        );

        $this->add_control(
            'slug', [
                'label' => esc_html__( 'Category Slug', 'uomo' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link_url',
            [
                'label' => esc_html__( 'Link', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://your-link.com', 'uomo' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'uomo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text', 'uomo' ),
                'default' => 'SHOP NOW',
            ]
        );

        $this->add_control(
            'show_nb_products',
            [
                'label' => esc_html__( 'Show Number Products', 'uomo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'uomo' ),
                'label_off' => esc_html__( 'Show', 'uomo' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'uomo'),
                    'style2' => esc_html__('Style 2', 'uomo'),
                    'style3' => esc_html__('Style 3', 'uomo'),
                ),
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'show_subcategories',
            [
                'label' => esc_html__( 'Show SubCategories', 'uomo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'uomo' ),
                'label_off' => esc_html__( 'Show', 'uomo' ),
                'condition' => [
                    'style' => ['style1', 'style3'],
                ],
            ]
        );

        $this->add_control(
            'number_subcategories',
            [
                'label' => esc_html__( 'Number SubCategories', 'uomo' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__( 'Enter number subcategories', 'uomo' ),
                'default' => 5,
                'condition' => [
                    'style' => ['style1', 'style3'],
                ],
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'uomo' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'uomo' ),
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Style', 'uomo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'uomo' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .widget-category-banner',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .item-inner-categories:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'uomo' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'nb_color',
            [
                'label' => esc_html__( 'Number item Color', 'uomo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-nb' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Number item Typography', 'uomo' ),
                'name' => 'nb_typography',
                'selector' => '{{WRAPPER}} .product-nb',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <?php if($style == 'style3') { ?>
            <div class="widget-category-banner <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>"></div>
            <div class="widget-category-v3">
                <?php
                $html = $link = '';
                $title_html = $title;
                $term = get_term_by('slug', $slug, 'product_cat');
                
                if ( ! empty( $link_url ) ) {
                    $link = $link_url;
                }

                if ( $term ) {
                    $link = get_term_link($term);
                    if ( empty($title_html) ) {
                        $title_html = $term->name;
                    }
                }
                $html .= '<div class="category-box-content">';

                if ( ! empty( $link ) ) {
                    $html .= '<a href="'.esc_url($link).'"><h3 class="title">'.$title_html.'</h3></a>';
                } else {
                    $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                }

                if ( $term ) {
                    if ( $show_subcategories ) {
                        $terms_children = get_terms( 'product_cat',
                            array(
                                'parent'        => $term->term_id,
                                'hierarchical'  => true,
                                'hide_empty'    => false,
                                'number'    => $number_subcategories,
                            )
                        );
                        if ( ! empty( $terms_children ) && ! is_wp_error( $terms_children ) ) {
                            $html .= '<ul class="subcategories">';
                                foreach ($terms_children as $term_children) {
                                    $html .= '<li><a href="'.get_term_link($term_children).'">'.$term_children->name.'</li>';
                                }
                            $html .= '</ul>';
                        }
                    }
                }

                if ( $show_nb_products && $term ) {
                    $html .= '<div class="product-nb">'.sprintf(_n('%d Product', '%d Products', $term->count, 'uomo'), $term->count).'</div>';
                }

                if( !empty( $link )){
                    $html .= '<a class="text-theme link-v3" href="'.esc_url($link).'">'. $btn_text .'</a>';
                }
                $html .= '</div>';

                echo trim($html);
                ?>

            </div>
        <?php }else{ ?>
            <div class="widget-category-banner <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
                
                <div class="item-inner">
                    <?php
                    $html = $link = '';
                    $title_html = $title;
                    $term = get_term_by('slug', $slug, 'product_cat');
                    
                    if ( ! empty( $link_url ) ) {
                        $link = $link_url;
                    }

                    $html .= '<div class="category-box-content">';

                    if ( $term ) {
                        $link = get_term_link($term);
                        if ( empty($title_html) ) {
                            $title_html = $term->name;
                        }
                        if (  ($style == 'style3' || $style == 'style1') && $show_subcategories ) {
                            $terms_children = get_terms( 'product_cat',
                                array(
                                    'parent'        => $term->term_id,
                                    'hierarchical'  => true,
                                    'hide_empty'    => false,
                                    'number'    => $number_subcategories,
                                )
                            );
                            if ( ! empty( $terms_children ) && ! is_wp_error( $terms_children ) ) {
                                $html .= '<ul class="subcategories">';
                                    foreach ($terms_children as $term_children) {
                                        $html .= '<li><a href="'.get_term_link($term_children).'">'.$term_children->name.'</li>';
                                    }
                                $html .= '</ul>';
                            }
                        }
                    }

                    if ( ! empty( $link ) ) {
                        $html .= '<a href="'.esc_url($link).'"><h3 class="title">'.$title_html.'</h3></a>';
                    } else {
                        $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                    }

                    if ( $show_nb_products && $term ) {
                        $html .= '<div class="product-nb">'.sprintf(_n('%d Product', '%d Products', $term->count, 'uomo'), $term->count).'</div>';
                    }

                    if( !empty( $link )){
                        $html .= '<a class="btn-banner" href="'.esc_url($link).'">'. $btn_text .'</a>';
                    }
                    $html .= '</div>';

                    echo trim($html);
                    ?>

                </div>
                    
            </div>
        <?php } ?>

        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Uomo_Elementor_Woo_Category_Banner );