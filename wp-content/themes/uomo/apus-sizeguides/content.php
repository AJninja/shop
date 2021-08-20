<?php
global $post;
$enable = get_post_meta($post->ID, 'apus_product_sizeguides_enable', true);

$size_guides = get_option('size_guides');
$size_guides_enable = get_option('size_guides_enable');
$size_guides_image = get_option('size_guides_image');

if ( empty($enable) ) {
	if ( $size_guides_enable !== 'on' ) {
		return;
	}
} elseif ( $enable == 'disable' ) {
	return;
}

?>
<div class="size-guide-wrapper">
	<a class="sizeguides-btn" href="#apus-sizeguides-wrapper">
	    <?php esc_html_e('Size Guides', 'uomo'); ?>
	</a>
	<div id="apus-sizeguides-wrapper" class="apus-sizeguides mfp-hide" data-effect="fadeIn">
		<h3 class="title"><?php echo esc_html__('SIZE GUIDE','uomo') ?></h3>
		<div class="content-sizeguides">
			<div class="inner clearfix">
				<?php if ( !empty($size_guides_image) ) {
					$img_url = wp_get_attachment_url($size_guides_image);
				?>
					<div class="image-inner">
			        	<img src="<?php echo esc_url($img_url); ?>" alt="<?php esc_attr_e('Image', 'uomo'); ?>"/>
			        </div>
				<?php } ?>
				<div class="inner-content">
					<?php
					if ( !empty($size_guides['section_name']) && is_array($size_guides['section_name']) ) {
						$tables = !empty($size_guides['tables']) ? $size_guides['tables'] : array();

						foreach ($size_guides['section_name'] as $key => $section_name) {
							$table = !empty($tables[$key]) ? stripslashes($tables[$key]) : '';
							$array_table = !empty($table) ? json_decode( $table, true ) : array();
							?>
							<section class="sizeguides-section">
								<?php if ( $section_name ) { ?>
									<div class="header"><?php echo esc_html($section_name); ?></div>
								<?php } ?>

								<table class="sizeguides-table">
									<?php
									foreach ( $array_table as $row => $columns ) {
										if ( 0 === $row ) {
											echo '<thead>';
										} elseif ( 1 === $row ) {
											echo '</thead><tbody>';
										}

										echo '<tr>';

										if ( 0 === $row ) {
											echo '<th>' . implode( '</th><th>', $columns ) . '</th>';
										} else {
											echo '<td>' . implode( '</td><td>', $columns ) . '</td>';
										}

										echo '</tr>';
									}
									if ( count($array_table) > 1 ) {
										echo '</tbody>';
									}
									?>
									
								</table>

							</section>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>