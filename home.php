<?php

session_start();
expire_session();
get_header();

$blog_news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC'));
include(locate_template('content-blog-page.php'));

get_footer();

