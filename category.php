<?php

session_start();
expire_session();
get_header();
$category_posts = new WP_Query(array('posts_per_page' => 6, "post_status" => 'publish', 'orderby' => 'post_date', 'category_name' => get_category(get_query_var('cat'))->slug, 'order' => 'DESC'));
include(locate_template('content-category-page.php'));
get_footer();
