<?php 
    $thumbsize = !isset($thumbsize) ? uomo_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
    $thumb = uomo_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-grid v3'); ?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
            <span class="post-sticky"><?php echo esc_html__('Featured','uomo'); ?></span>
        <?php endif; ?>
        <?php if($thumb) {?>
            <div class="top-image">
                <?php
                    echo trim($thumb);
                ?>
             </div>
        <?php } ?>
        <div class="inner-bottom">
            <div class="post-layout-info">
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="ti-user"></i><?php echo esc_html__('By','uomo') ?> <?php echo get_the_author(); ?></a>
                <div class="date"><i class="ti-time"></i><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a></div>
            </div>

            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
        </div>
</article>