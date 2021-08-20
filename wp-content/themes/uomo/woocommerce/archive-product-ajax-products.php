<?php
/**
 *	NM: The template for displaying AJAX loaded products
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wp_query;
if ( have_posts() ) {
		
	echo '<div class="apus-products">';

		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'product' );
		}

	echo '</div>';
			
	?>
	<div class="apus-pagination-next-link"><?php next_posts_link( '&nbsp;' ); ?></div>
	<?php

}