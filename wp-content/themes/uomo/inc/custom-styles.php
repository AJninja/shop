<?php
if ( !function_exists ('uomo_custom_styles') ) {
	function uomo_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php if ( uomo_get_config('main_color') != "" ) {
				$main_color = uomo_get_config('main_color');
			} else {
				$main_color = '#C32929';
			}


			if ( uomo_get_config('main_hover_color') != "" ) {
				$main_hover_color = uomo_get_config('main_hover_color');
			} else {
				$main_hover_color = '#992020';
			}

			if ( uomo_get_config('text_color') != "" ) {
				$text_color = uomo_get_config('text_color');
			} else {
				$text_color = '#767676';
			}

			if ( uomo_get_config('link_color') != "" ) {
				$link_color = uomo_get_config('link_color');
			} else {
				$link_color = '#222222';
			}

			if ( uomo_get_config('heading_color') != "" ) {
				$heading_color = uomo_get_config('heading_color');
			} else {
				$heading_color = '#222222';
			}
			

			$main_color_rgb = uomo_hex2rgb($main_color);

			// font
			$main_font = uomo_get_config('main_font');
			$main_font_family = !empty($main_font['font-family']) ? $main_font['font-family'] : 'SofiaPro';
			$main_font_weight = !empty($main_font['font-weight']) ? $main_font['font-weight'] : 400;

			$main_font_arr = explode(',', $main_font_family);
			if ( count($main_font_arr) == 1 ) {
				$main_font_family = "'".$main_font_family."'";
			}

			$heading_font = uomo_get_config('heading_font');
			$heading_font_family = !empty($heading_font['font-family']) ? $heading_font['font-family'] : 'SofiaPro';
			$heading_font_weight = !empty($heading_font['font-weight']) ? $heading_font['font-weight'] : 600;

			$heading_font_arr = explode(',', $heading_font_family);
			if ( count($heading_font_arr) == 1 ) {
				$heading_font_family = "'".$heading_font_family."'";
			}
			?>
			:root {
			  --uomo-theme-color: <?php echo trim($main_color); ?>;
			  --uomo-text-color: <?php echo trim($text_color); ?>;
			  --uomo-link-color: <?php echo trim($link_color); ?>;
			  --uomo-heading-color: <?php echo trim($heading_color); ?>;
			  --uomo-theme-hover-color: <?php echo trim($main_hover_color); ?>;
			  --uomo-theme-color-001: <?php echo uomo_generate_rgba($main_color_rgb, 0.01); ?>
			  --uomo-theme-color-01: <?php echo uomo_generate_rgba($main_color_rgb, 0.1); ?>

			  --uomo-main-font: <?php echo trim($main_font_family); ?>;
			  --uomo-main-font-weight: <?php echo trim($main_font_weight); ?>;
			  --uomo-heading-font: <?php echo trim($heading_font_family); ?>;
			  --uomo-heading-font-weight: <?php echo trim($heading_font_weight); ?>;
			}
			
			<?php if (  uomo_get_config('header_mobile_color') != "" ) : ?>
				#apus-header-mobile {
					background-color: <?php echo esc_html( uomo_get_config('header_mobile_color') ); ?>;
				}
			<?php endif; ?>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}