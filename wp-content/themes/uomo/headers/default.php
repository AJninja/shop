<header id="apus-header" class="apus-header header-default hidden-xs hidden-sm" role="banner">
    <div class="<?php echo (uomo_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (uomo_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container">
                <div class="row flex-middle">
                    <div class="col-md-2">
                        <div class="logo-in-theme">
                            <?php get_template_part( 'template-parts/logo/logo' ); ?>
                        </div>
                    </div>
                    <div class="col-md-10 flex-middle">
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="main-menu">
                                <nav data-duration="400" class="apus-megamenu slide animate navbar p-static" role="navigation">
                                <?php
                                    $args = array(
                                        'theme_location' => 'primary',
                                        'container_class' => 'collapse navbar-collapse no-padding',
                                        'menu_class' => 'nav navbar-nav megamenu effect1',
                                        'fallback_cb' => '',
                                        'menu_id' => 'primary-menu',
                                        'walker' => new Uomo_Nav_Menu()
                                    );
                                    wp_nav_menu($args);
                                ?>
                                </nav>
                            </div>
                        <?php endif; ?>
                        <div class="header-right clearfix">
                            <?php if ( defined('UOMO_WOOCOMMERCE_ACTIVED') && uomo_get_config('show_cartbtn') && !uomo_get_config( 'enable_shop_catalog' ) ): ?>

                                <div class="pull-right">
                                    <div class="apus-topcart">
                                        <div class="cart">
                                            <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" href="#" title="<?php esc_attr_e('View your shopping cart', 'uomo'); ?>">
                                                <i class="flaticon-shopping-bag"></i>
                                                <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="widget_shopping_cart_content">
                                                    <?php woocommerce_mini_cart(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>

                            <?php if ( class_exists( 'YITH_WCWL' ) && uomo_get_config('show_wishlist_btn', true) ):
                                $wishlist_url = YITH_WCWL()->get_wishlist_url();
                            ?>
                                <div class="pull-right">
                                    <a class="wishlist-icon" href="<?php echo esc_url($wishlist_url);?>">
                                        <i class="flaticon-heart"></i>
                                        <?php if ( function_exists('yith_wcwl_count_products') ) { ?>
                                            <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                                        <?php } ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>