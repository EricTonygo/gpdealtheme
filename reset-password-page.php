<?php

/*
  Template Name: Reset Password Page
 */
session_start();
if (is_user_logged_in()) {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        gp_reset_password();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        gp_reset_password();
    } else {
        get_header();

        get_template_part('content-reset-password-page', get_post_format());

        get_footer();
    }
} else {
    $_SESSION['redirect_to'] = get_the_permalink();
    wp_safe_redirect(get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))));
}


