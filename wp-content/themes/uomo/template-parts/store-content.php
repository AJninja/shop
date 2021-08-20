<?php
global $post;
$address = get_post_meta($post->ID, '_store_address', true);
$phone = get_post_meta($post->ID, '_store_phone', true);
$working_hours = get_post_meta($post->ID, '_store_working_hours', true);
$latitude = get_post_meta($post->ID, '_store_latitude', true);
$longitude = get_post_meta($post->ID, '_store_longitude', true);

$img_url = '';
if ( has_post_thumbnail() ) {
    $img_url = wp_get_attachment_url(get_post_thumbnail_id());
}
?>
<div class="store-item store-item-left" data-latitude="<?php echo esc_attr($latitude); ?>" data-longitude="<?php echo esc_attr($longitude); ?>" data-img="<?php echo trim($img_url); ?>">

    <h4 class="store-title"><?php the_title(); ?></h4>
    <div class="details-store">
        <div class="details-store-inner">
            <?php if( !empty($address) ){ ?>
                <div class="address"><?php echo trim($address); ?></div>
            <?php } ?>

            <?php if( !empty($phone) ){ ?>
                <div class="phone"><?php echo trim($phone); ?></div>
            <?php } ?>

            <?php if( !empty($working_hours) ){ ?>
                <div class="working_hours"><?php echo trim($working_hours); ?></div>
            <?php } ?>
        </div>

        <a href="javascript:void(0);" class="see-on-the-map btn-banner"><?php esc_html_e('SEE ON THE MAP', 'uomo'); ?></a>
    </div>
    
</div>