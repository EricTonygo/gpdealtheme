<?php

/*
  Template Name: Resgister Page
 */
if (!is_user_logged_in()) {
    get_header();

    get_template_part('content-register-page', get_post_format());

    get_footer();
}else{
    wp_safe_redirect(get_permalink(get_page_by_path(__('my-account', 'gpdealdomain'))));
    exit;
}