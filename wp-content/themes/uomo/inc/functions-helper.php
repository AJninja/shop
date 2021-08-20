<?php

if ( ! function_exists( 'uomo_body_classes' ) ) {
	function uomo_body_classes( $classes ) {
		global $post;
		$show_footer_mobile = uomo_get_config('show_footer_mobile', false);

		if ( is_page() && is_object($post) ) {
			$class = get_post_meta( $post->ID, 'apus_page_extra_class', true );
			if ( !empty($class) ) {
				$classes[] = trim($class);
			}
			if(get_post_meta( $post->ID, 'apus_page_header_transparent',true) && get_post_meta( $post->ID, 'apus_page_header_transparent',true) == 'yes' ){
				$classes[] = 'header_transparent';
			}
		}
		if ( uomo_get_config('preload', true) ) {
			$classes[] = 'apus-body-loading';
		}
		if ( uomo_get_config('image_lazy_loading') ) {
			$classes[] = 'image-lazy-loading';
		}
		if ( $show_footer_mobile ) {
			$classes[] = 'body-footer-mobile';
		}else{
			$classes[] = 'body-nofooter-mobile';
		}

		if ( uomo_get_config('keep_header') ) {
			$classes[] = 'has-header-sticky';
		}
		
		if ( is_singular('product')){
			$layout = uomo_product_get_layout_type();
			$classes[] = 'detail-shop-'.$layout;
		}

		if ( is_singular('product') && uomo_get_config('show_product_sticky_add_to_cart') ) {
			$product = wc_get_product($post->ID);
			if ( $product->get_type() !== 'grouped' ) {
				$classes[] = 'sticky-add-to-cart';
			}
		}
		return $classes;
	}
	add_filter( 'body_class', 'uomo_body_classes' );
}

if ( !function_exists('uomo_get_header_layouts') ) {
	function uomo_get_header_layouts() {
		$headers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_header',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$headers[$post->post_name] = $post->post_title;
		}
		return $headers;
	}
}

if ( !function_exists('uomo_get_header_layout') ) {
	function uomo_get_header_layout() {
		global $post;
		if ( is_page() && is_object($post) && isset($post->ID) ) {
			$header = get_post_meta( $post->ID, 'apus_page_header_type', true );
			if ( empty($header) || $header == 'global' ) {
				$header = uomo_get_config('header_type');
			}
			return $header;
		} elseif ( is_singular('product') ) {
			$header = get_post_meta( $post->ID, 'apus_product_header_type', true );
			if ( empty($header) || $header == 'global' ) {
				$header = uomo_get_config('product_header_type');
				if ( empty($header) || $header == 'global' ) {
					$header = uomo_get_config('header_type');
				}
			}
			return $header;
		}
		return uomo_get_config('header_type');
	}
	add_filter( 'uomo_get_header_layout', 'uomo_get_header_layout' );
}

function uomo_display_header_builder($header_slug) {
	$args = array(
		'name'        => $header_slug,
		'post_type'   => 'apus_header',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$classes = array('apus-header');
		if ( uomo_get_config('separate_header_mobile', true) ) {
			$classes[] = 'hidden-xs hidden-sm';
		}
		$classes[] = $post->post_name.'-'.$post->ID;

		if ( !uomo_get_config('keep_header') ) {
			$classes[] = 'no-sticky';
		}

		echo '<div id="apus-header" class="'.esc_attr(implode(' ', $classes)).'">';
		if ( uomo_get_config('keep_header') ) {
	        echo '<div class="main-sticky-header">';
	    }
			echo apply_filters( 'uomo_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
		if ( uomo_get_config('keep_header') ) {
			echo '</div>';
	    }
		echo '</div>';
	}
}

if ( !function_exists('uomo_get_footer_layouts') ) {
	function uomo_get_footer_layouts() {
		$footers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$footers[$post->post_name] = $post->post_title;
		}
		return $footers;
	}
}

if ( !function_exists('uomo_get_footer_layout') ) {
	function uomo_get_footer_layout() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object($post) && isset($post->ID) ) {
				$footer = get_post_meta( $post->ID, 'apus_page_footer_type', true );
				if ( empty($footer) || $footer == 'global' ) {
					return uomo_get_config('footer_type', '');
				}
			}
			return $footer;
		}
		return uomo_get_config('footer_type', '');
	}
	add_filter('uomo_get_footer_layout', 'uomo_get_footer_layout');
}

function uomo_display_footer_builder($footer_slug) {
	$show_footer_desktop_mobile = uomo_get_config('show_footer_desktop_mobile', false);
	$args = array(
		'name'        => $footer_slug,
		'post_type'   => 'apus_footer',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$classes = array('apus-footer footer-builder-wrapper');
		if ( !$show_footer_desktop_mobile ) {
			$classes[] = 'hidden-xs hidden-sm';
		}
		$classes[] = $post->post_name;


		echo '<div id="apus-footer" class="'.esc_attr(implode(' ', $classes)).'">';
		echo '<div class="apus-footer-inner">';
		echo apply_filters( 'uomo_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
		echo '</div>';
		echo '</div>';
	}
}

if ( !function_exists('uomo_blog_content_class') ) {
	function uomo_blog_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( uomo_get_config('blog_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'uomo_blog_content_class', 'uomo_blog_content_class', 1 , 1  );


if ( !function_exists('uomo_get_blog_layout_configs') ) {
	function uomo_get_blog_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = uomo_get_config('blog_'.$page.'_left_sidebar');
		$right = uomo_get_config('blog_'.$page.'_right_sidebar');

		switch ( uomo_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
			 	if ( is_active_sidebar( $left ) ) {
			 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
			 	}
		 		break;
		 	case 'main-right':
		 		if ( is_active_sidebar( $right ) ) {
			 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
			 	}
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		 	default:
		 		if ( is_active_sidebar( 'sidebar-default' ) ) {
			 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
			 	} else {
			 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
			 	}
		 		break;
		}
		if ( empty($configs) ) {
			if ( is_active_sidebar( 'sidebar-default' ) ) {
		 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
		 	} else {
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 	}
		}
		return $configs; 
	}
}

if ( !function_exists('uomo_page_content_class') ) {
	function uomo_page_content_class( $class ) {
		global $post;
		if (is_object($post)) {
			$fullwidth = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
			if ( !$fullwidth || $fullwidth == 'no' ) {
				return $class;
			}
		}
		return 'container-fluid';
	}
}
add_filter( 'uomo_page_content_class', 'uomo_page_content_class', 1 , 1  );

if ( !function_exists('uomo_get_page_layout_configs') ) {
	function uomo_get_page_layout_configs() {
		global $post;
		if ( is_object($post) ) {
			$left = get_post_meta( $post->ID, 'apus_page_left_sidebar', true );
			$right = get_post_meta( $post->ID, 'apus_page_right_sidebar', true );

			switch ( get_post_meta( $post->ID, 'apus_page_layout', true ) ) {
			 	case 'left-main':
			 		if ( is_active_sidebar( $left ) ) {
				 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
				 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
				 	}
			 		break;
			 	case 'main-right':
			 		if ( is_active_sidebar( $right ) ) {
				 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
				 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
				 	}
			 		break;
		 		case 'main':
		 			$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
		 			break;
			 	default:
			 		if ( is_active_sidebar( 'sidebar-default' ) ) {
				 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => ' col-md-3 col-sm-12 col-xs-12' ); 
				 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
				 	} else {
				 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix full-default' );
				 	}
			 		break;
			}

			if ( empty($configs) ) {
				if ( is_active_sidebar( 'sidebar-default' ) ) {
			 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
			 	} else {
			 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix full-default' );
			 	}
			}
		} else {
			$configs['main'] = array( 'class' => 'col-xs-12' );
		}
		return $configs; 
	}
}

if ( !function_exists( 'uomo_random_key' ) ) {
    function uomo_random_key($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $return;
    }
}

if ( !function_exists('uomo_substring') ) {
    function uomo_substring($string, $limit, $afterlimit = '[...]') {
        if ( empty($string) ) {
        	return $string;
        }
       	$string = explode(' ', strip_tags( $string ), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`','',$string);
        return strip_shortcodes( $string );
    }
}


function uomo_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'r' => $r, 'g' => $g, 'b' => $b );
}

function uomo_generate_rgba( $rgb, $opacity ) {
	$output = 'rgba('.$rgb['r'].', '.$rgb['g'].', '.$rgb['b'].', '.$opacity.');';

	return $output;
}

function uomo_is_apus_framework_activated() {
	return defined('APUS_FRAMEWORK_VERSION') ? true : false;
}

function uomo_is_cmb2_activated() {
	return defined('CMB2_LOADED') ? true : false;
}

function uomo_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

function uomo_is_yith_wcwl_activated() {
	return class_exists( 'YITH_WCWL' ) ? true : false;
}

function uomo_is_yith_woocompare_activated() {
	return class_exists( 'YITH_Woocompare' ) ? true : false;
}

function uomo_is_revslider_activated() {
	return class_exists( 'RevSlider' ) ? true : false;
}

function uomo_is_dokan_activated() {
	return class_exists( 'WeDevs_Dokan' ) ? true : false;
}

function uomo_is_woo_swatches_activated() {
	return class_exists( 'TA_WC_Variation_Swatches' ) ? true : false;
}

function uomo_is_mailchimp_activated() {
	return class_exists( 'MC4WP_Form_Manager' ) ? true : false;
}

function uomo_is_sizeguides_activated() {
	return class_exists( 'ApusSizeguides' ) ? true : false;
}

function uomo_is_ourstores_activated() {
	return class_exists( 'ApusOurstores' ) ? true : false;
}