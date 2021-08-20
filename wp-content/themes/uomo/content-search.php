<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Uomo
 * @since Uomo 1.0
 */
?>
<article <?php post_class('post post-layout post-list-item'); ?>>
    <div class="list-inner">

        <div class="post-layout-info">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="ti-user"></i><?php echo esc_html__('By','uomo') ?> <?php echo get_the_author(); ?></a>
            <?php uomo_post_first_categories($post); ?>
            <div class="date"><i class="ti-time"></i><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a></div>
        </div>

        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                    <div class="stick-icon text-theme"><i class="ti-pin2"></i></div>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>

        <?php if( !empty( get_the_excerpt() ) ){?>
            <div class="description"><?php echo uomo_substring( get_the_excerpt(), 20, '...' ); ?></div>
        <?php } ?>
        <a class="btn-banner hidden-xs" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue Reading', 'uomo'); ?></a>

    </div>
</article>