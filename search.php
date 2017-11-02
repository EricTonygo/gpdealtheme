<?php

session_start();
expire_session();
get_header();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['s'])) {
        $search_query = removeslashes(esc_attr(trim($_GET['s'])));
        $search_results = new WP_Query(array('post_type' => 'post', 's' => $search_query, 'posts_per_page' => 6, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC'));
        include(locate_template('content-search-page.php'));
    }
}
get_footer();
