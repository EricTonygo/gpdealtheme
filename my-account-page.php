<?php

/*
  Template Name: My Account Page
 */
//header("Cache-Control", "no-cache, no-store, must-revalidate");

if (is_user_logged_in()) {
    get_header();

    get_template_part('content-my-account-page', get_post_format());

    get_footer();
}else{
    wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))))));
}