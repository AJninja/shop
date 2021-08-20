<div class="apus-search-form">
	<div class="apus-search-form-inner">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="inner-search">
			<div class="main-search">
				<div class="autocompleate-wrapper">
			  		<input type="text" placeholder="<?php esc_attr_e( 'Search products...', 'uomo' ); ?>" name="s" class="apus-search form-control apus-autocompleate-input" autocomplete="off"/>
				</div>
			</div>
			<button type="submit" class="btn"><i class="ti-search"></i></button>
			<input type="hidden" name="post_type" value="product" class="post_type" />
		</form>
	</div>
</div>