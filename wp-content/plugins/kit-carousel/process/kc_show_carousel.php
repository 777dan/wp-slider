<?php

function kc_show_carousel($content)
{
    $args = [
        'post_type' => get_option('kc_post_type') ? get_option('kc_post_type') : 'post',
        'showposts' => get_option('kc_count') ? get_option('kc_count') : 3,
        'category_name' => get_option('kc_category_name'),
        //'post_type' => 'recipe',
        // 'post_type' => 'movies',
        //'tag' => 'cooking',
        'tag' => get_option('kc_tag'),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ];

    $query = new WP_Query($args);
    $html = '';
    if ($query->have_posts()) {
        $html = '<section id="demos">
    <div class="row">
        <div class="large-12 columns">
            <div class="owl-carousel owl-theme">';
        while ($query->have_posts()) {
            $query->the_post();
            $html .= '<div class="item" style="background:grey url(' . get_the_post_thumbnail_url($query->post->ID, 'thumbnail') . '); background-size:cover;"><h5>';
            $html .= '<a href="' . get_permalink($query->post->ID) . '" style="color: white;text-decoration: none;">' . $query->post->post_title . '</a>';
            $html .= '</h5></div>';
        }
        $html .= ' </div>
    </div>
</div>
</section>';
    }
    wp_reset_postdata();
    return $content . $html;
}
