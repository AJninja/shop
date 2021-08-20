<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="wrapper-small">
        <?php if (get_the_title()) { ?>
            <h1 class="entry-title-detail">
                <?php the_title(); ?>
            </h1>
        <?php } ?>
        <div class="top-info">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="ti-user"></i><?php echo esc_html__('By','uomo') ?> <?php echo get_the_author(); ?></a>
            <?php uomo_post_categories($post); ?>
            <div class="date"><i class="ti-time"></i><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a></div>
        </div>
    </div>

    <div class="entry-thumb-detail <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
        <?php
            $thumb = uomo_post_thumbnail();
            echo trim($thumb);
        ?>
    </div>

	<div class="entry-content-detail">
        <div class="wrapper-small">
        	<div class="single-info">
                <div class="entry-description clearfix">
                    <?php
                        the_content();
                    ?>
                </div><!-- /entry-content -->
        		<?php
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'uomo' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'uomo' ) . ' </span>%',
                    'separator'   => '',
                ) );
                ?>
                <?php  
                    $posttags = get_the_tags();
                ?>
                <?php if( !empty($posttags) || uomo_get_config('show_blog_social_share', false) ){ ?>
            		<div class="tag-social clearfix text-center">
                        <?php uomo_post_tags(); ?>
            			<?php if( uomo_get_config('show_blog_social_share', false) ) {
            				get_template_part( 'template-parts/sharebox-text' );
            			} ?>
            		</div>
                <?php } ?>

                <?php 
                //Previous/next post navigation.
                the_post_navigation( array(
                    'next_text' => 
                        '<div class="inner">'.
                        '<div class="navi">'. esc_html__( 'Next Post', 'uomo' ) . '<i class="flaticon-next"></i></div>'.
                        '<span class="title-direct">%title</span></div>',
                    'prev_text' => 
                        '<div class="inner">'.
                        '<div class="navi"><i class="flaticon-back"></i>' . esc_html__( 'Previous Post', 'uomo' ) . '</div>'.
                        '<span class="title-direct">%title</span></div>',
                ) );
                ?>
        	</div>
        </div>
    </div>
</article>