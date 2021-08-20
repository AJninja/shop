<?php


add_action( 'wp_ajax_uomo_get_ajax_stores', 'uomo_get_ajax_stores' );
add_action( 'wp_ajax_nopriv_uomo_get_ajax_stores', 'uomo_get_ajax_stores' );
function uomo_get_ajax_stores() {
    global $wpdb, $wp_query;
    $location = isset($_POST['filter-location']) ? $_POST['filter-location'] : '';
    $latitude = isset($_POST['filter-latitude']) ? $_POST['filter-latitude'] : '';
    $longitude = isset($_POST['filter-longitude']) ? $_POST['filter-longitude'] : '';
    $distance = 50;
    $args = array(
        'post_type' => 'ourstores',
        'post_status' => 'publish',
        'posts_per_page' => get_option('posts_per_page'),
        'orderby' => 'name',
        'order' => 'ASC',
    );

    if ( $latitude && $longitude && $location ) {
        $earth_distance = apply_filters('uomo_filter_distance_type', 'km') == 'miles' ? 3959 : 6371;

        $sql = $wpdb->prepare( "
            SELECT $wpdb->posts.ID, 
                ( %s * acos( 
                    cos( radians(%s) ) * 
                    cos( radians( latitude.meta_value ) ) * 
                    cos( radians( longitude.meta_value ) - radians(%s) ) + 
                    sin( radians(%s) ) * 
                    sin( radians( latitude.meta_value ) ) 
                ) ) 
                AS distance, latitude.meta_value AS latitude, longitude.meta_value AS longitude
                FROM $wpdb->posts
                INNER JOIN $wpdb->postmeta AS latitude ON $wpdb->posts.ID = latitude.post_id
                INNER JOIN $wpdb->postmeta AS longitude ON $wpdb->posts.ID = longitude.post_id
                WHERE 1=1 AND ($wpdb->posts.post_status = 'publish' ) AND latitude.meta_key='_store_latitude' AND longitude.meta_key='_store_longitude'
                HAVING distance < %s
                ORDER BY $wpdb->posts.menu_order ASC, distance ASC",
            $earth_distance,
            $latitude,
            $longitude,
            $latitude,
            $distance
        );

        $post_ids = $wpdb->get_results( $sql, OBJECT_K );

        if ( empty( $post_ids ) || ! $post_ids ) {
            $post_ids = array(0);
        }

        if ( $wp_query ) {
            $wp_query->locations = $post_ids;
        }

        $args[ 'post__in' ] = array_keys( (array) $post_ids );
    }

    $loop = new WP_Query($args);
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ): $loop->the_post();
            get_template_part( 'template-parts/store-content' );
        endwhile;
        wp_reset_postdata();
    } else {
        echo esc_html__('No store found', 'uomo');
    }
    die();
}