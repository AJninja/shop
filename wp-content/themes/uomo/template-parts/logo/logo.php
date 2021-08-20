<?php
    $logo = uomo_get_config('media-logo');
    $logo_url = '';
    if ( !empty($logo['id']) ) {
        $img = wp_get_attachment_image_src($logo['id'], 'full');
        if ( !empty($img[0]) ) {
            $logo_url = $img[0];
        }
    }
?>
<?php if( !empty($logo_url) ): ?>
    <div class="logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php else: ?>
    <div class="logo logo-theme">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.svg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php endif; ?>