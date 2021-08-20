<div class="apus-search-form">
	<div class="apus-search-form-inner">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<?php
				if ( uomo_is_woocommerce_activated() ) {
					$args = array(
					    'show_count' => 0,
					    'hierarchical' => true,
					    'show_uncategorized' => 0
					);
					echo '<div class="select-category">';
						wc_product_dropdown_categories( $args );
					echo '</div>';
				}
			?>
			<div class="main-search">
				<div class="autocompleate-wrapper">
			  		<input type="text" placeholder="<?php esc_attr_e( 'What do you need?', 'uomo' ); ?>" name="s" class="apus-search form-control apus-autocompleate-input" autocomplete="off"/>
				</div>
			</div>
			<input type="hidden" name="post_type" value="product" class="post_type" />
			
			<button type="submit" class="btn btn-theme radius-0"><?php esc_html_e('SEARCH', 'uomo'); ?></button>
		</form>
	</div>
</div>